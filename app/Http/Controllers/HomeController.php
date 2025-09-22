<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdCategory;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $ads = Ad::with(['adType', 'poster'])
        ->selectRaw('ads.*,
                IF(ad_type = 3 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 3,
                IF(ad_type = 2 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 2, 1)
            ) as effective_ad_type
        ')
        ->orderBy('effective_ad_type', 'desc')   // VIP → Super → Normal
        ->orderBy('created_at', 'desc')          // newest inside each group
        ->paginate(50);

        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();

        return view('frontend.main', compact('ads', 'category', 'settings'));
    }

    public function category($id)
    {
        $selectedCategory = AdCategory::findOrFail($id);
        $ads = Ad::with(['adType', 'poster'])
        ->selectRaw('ads.*,
                IF(ad_type = 3 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 3,
                IF(ad_type = 2 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 2, 1)
            ) as effective_ad_type
        ')
        ->orderBy('effective_ad_type', 'desc')   // VIP → Super → Normal
        ->orderBy('created_at', 'desc')          // newest inside each group
        ->paginate(30);

        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();

        return view('frontend.main', compact('ads', 'category', 'selectedCategory', 'settings'));
    }

    public function savedAds()
    {
        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();
        
        return view('frontend.saved-ads', compact('category', 'settings'));
    }

    public function getSavedAdsData(Request $request)
    {
        $request->validate([
            'adIds' => 'required|array',
            'adIds.*' => 'integer'
        ]);

        $adIds = $request->input('adIds');
        
        $ads = Ad::with(['adType', 'poster'])
        ->whereIn('id', $adIds)
        ->selectRaw('ads.*,
                IF(ad_type = 3 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 3,
                IF(ad_type = 2 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 2, 1)
            ) as effective_ad_type
        ')
        ->orderBy('effective_ad_type', 'desc')   // VIP → Super → Normal
        ->orderBy('created_at', 'desc')          // newest inside each group
        ->get();

        return response()->json($ads);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return redirect()->route('home');
        }

        $ads = Ad::with(['adType', 'poster'])
        ->where('title', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->selectRaw('ads.*,
                IF(ad_type = 3 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 3,
                IF(ad_type = 2 AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY), 2, 1)
            ) as effective_ad_type
        ')
        ->orderBy('effective_ad_type', 'desc')   // VIP → Super → Normal
        ->orderBy('created_at', 'desc')          // newest inside each group
        ->paginate(30);

        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();

        return view('frontend.main', compact('ads', 'category', 'settings', 'query'));
    }

    public function termsConditions()
    {
        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();
        return view('frontend.terms-conditions', compact('category', 'settings'));
    }

    public function privacyPolicy()
    {
        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();
        return view('frontend.privacy-policy', compact('category', 'settings'));
    }

    public function aboutUs()
    {
        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();
        return view('frontend.about-us', compact('category', 'settings'));
    }

    public function faqs()
    {
        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();
        return view('frontend.faqs', compact('category', 'settings'));
    }

    public function services()
    {
        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();
        return view('frontend.services', compact('category', 'settings'));
    }

    public function returnPolicy()
    {
        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();
        return view('frontend.return-policy', compact('category', 'settings'));
    }

    public function howToPublish()
    {
        $category = AdCategory::orderBy('id', 'DESC')->get();
        $settings = Setting::first();
        return view('frontend.how-to-publish', compact('category', 'settings'));
    }
}
