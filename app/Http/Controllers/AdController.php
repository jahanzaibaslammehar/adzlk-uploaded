<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdType;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'ad_type' => 'sometimes|required',
            'location' => 'required',
            'price' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
            'profile_verification' => 'sometimes|required',
        ]);

        $user = auth('poster')->user();

        // Handle image upload and create thumbnail
        $imageName = null;
        $thumbnailName = null;
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadedImages = ImageService::uploadImageWithThumbnail($image, 'ads', 300, 300);
            $imageName = $uploadedImages['image'];
            $thumbnailName = $uploadedImages['thumbnail'];
        }

        $setting = Setting::first();

        if($setting->is_stripe_enabled){

            $adType = AdType::find($request->ad_type);

            $adPrice = $adType->price;

            $profileVerification = false;

            if($adPrice > 0){
                $totalPrice = $adPrice;

                if ($request->has('profile_verification') && !$user->is_verified) {
                    $totalPrice = $totalPrice + $setting->verify_profile_price;
                    $profileVerification = true;
                }

                $adData = [
                    'title' => $request->title,
                    'category_id' => $request->category_id,
                    'ad_type' => $request->ad_type ?? 1,
                    'location' => $request->location,
                    'price' => $request->price,
                    'description' => $request->description,
                    'image' => $imageName,
                    'thumbnail' => $thumbnailName,
                    'is_on_whatsapp' => $request->has('available_on_whatsapp'),
                    'is_on_imo' => $request->has('available_on_imo'),
                    'is_on_viber' => $request->has('available_on_viber'),
                    'is_on_telegram' => $request->has('available_on_telegram'),
                    'profile_verification' => $profileVerification,
                    'payment_type' => 'Ad Payment',
                    'total_price' => $totalPrice
                ];
                
                session(['pending_ad_data' => $adData]);

                return redirect()->route('checkout')->with('info', 'Please complete profile verification payment to create your ad.');
            }
        }

        // Create ad directly if no verification needed
        $ad = Ad::create([
            'poster_id' => $user->id,
            'title' => $request->title,
            'image' => $imageName,
            'thumbnail' => $thumbnailName,
            'category_id' => $request->category_id,
            'ad_type' => $request->ad_type ?? 1,
            'location' => $request->location,
            'price' => $request->price,
            'description' => $request->description,
            'is_on_whatsapp' => $request->has('available_on_whatsapp'),
            'is_on_imo' => $request->has('available_on_imo'),
            'is_on_viber' => $request->has('available_on_viber'),
            'is_on_telegram' => $request->has('available_on_telegram'),
            'is_active' => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Ad created successfully');
    }

    public function delete($id)
    {
        $ad = Ad::where('id', $id)
                ->where('poster_id', auth('poster')->user()->id)
                ->first();

        if (!$ad) {
            return redirect()->route('dashboard')->with('error', 'Ad not found or you do not have permission to delete it.');
        }

        // Delete the image file if it exists
        if ($ad->image && file_exists(storage_path($ad->image))) {
            unlink(storage_path($ad->image));
        }

        $ad->delete();

        return redirect()->route('dashboard')->with('success', 'Ad deleted successfully');
    }

    public function restore($id)
    {
        $ad = Ad::onlyTrashed()
                ->where('id', $id)
                ->where('poster_id', auth('poster')->user()->id)
                ->first();

        if (!$ad) {
            return redirect()->route('dashboard')->with('error', 'Deleted ad not found or you do not have permission to restore it.');
        }

        $ad->restore();

        return redirect()->route('dashboard')->with('success', 'Ad restored successfully');
    }

    public function show($id)
    {
        $ad = Ad::with(['adType', 'category', 'poster'])
            ->selectRaw('ads.*,
                IF(ad_type = 3 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 3,
                IF(ad_type = 2 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 2, 1)
            ) as effective_ad_type
        ')
            ->findOrFail($id);
        
        // Increment view count
        $ad->increment('total_views');
        
        // Get categories for the sidebar
        $categories = \App\Models\AdCategory::all();
        
        // Get settings for admin contact
        $settings = Setting::first();
        
        return view('frontend.ad-detail', compact('ad', 'categories', 'settings'));
    }

    public function toggleLike($id)
    {
        $ad = Ad::findOrFail($id);
        
        // Check if user has already liked this ad (using session or IP)
        $likedKey = 'liked_ad_' . $id;
        $hasLiked = session($likedKey, false);
        
        if ($hasLiked) {
            // User has already liked, so unlike
            $ad->decrement('total_likes');
            session([$likedKey => false]);
            $action = 'unliked';
        } else {
            // User hasn't liked, so like
            $ad->increment('total_likes');
            session([$likedKey => true]);
            $action = 'liked';
        }
        
        // Refresh the ad to get updated like count
        $ad->refresh();
        
        return response()->json([
            'success' => true,
            'action' => $action,
            'total_likes' => $ad->total_likes,
            'message' => $action === 'liked' ? 'Ad liked successfully!' : 'Ad unliked successfully!'
        ]);
    }
}
