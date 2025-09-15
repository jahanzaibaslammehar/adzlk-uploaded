<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdCategory;
use App\Models\AdType;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $category = AdCategory::orderBy('id', 'DESC')->get();
        $adType = AdType::orderBy('price', 'DESC')->get();

        $ads = Ad::with(['adType'])
        ->where('poster_id', auth('poster')->user()->id)
        ->selectRaw('ads.*,
                IF(ad_type = 3 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 3,
                IF(ad_type = 2 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 2, 1)
            ) as effective_ad_type
        ')
        ->orderBy('effective_ad_type', 'desc')   // VIP → Super → Normal
        ->orderBy('created_at', 'desc')          // newest inside each group
        ->paginate(30);

        $deletedAds = Ad::with(['adType'])
        ->where('poster_id', auth('poster')->user()->id)
        ->onlyTrashed()
        ->selectRaw('ads.*,
                IF(ad_type = 3 AND deleted_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 3,
                IF(ad_type = 2 AND deleted_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 2, 1)
            ) as effective_ad_type
        ')
        ->orderBy('effective_ad_type', 'desc')   // VIP → Super → Normal
        ->orderBy('deleted_at', 'desc')          // newest inside each group
        ->paginate(30);

        $setting = Setting::first();

        return view('frontend.dashboard', compact('category', 'adType', 'ads', 'deletedAds', 'setting'));
    }

    public function updatePhone(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required|string|min:10|max:15'
            ]);

            $user = auth('poster')->user();
            $user->phone = $request->phone;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Phone number updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update phone number: ' . $e->getMessage()
            ], 500);
        }
    }
}
