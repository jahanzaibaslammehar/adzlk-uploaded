<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdCategory;
use App\Models\AdType;
use App\Models\Setting;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function checkout()
    {
        $pendingAdData = session('pending_ad_data');
        
        if (!$pendingAdData) {
            return redirect()->route('dashboard')->with('error', 'No pending ad data found.');
        }

        // Get category and ad type names for display
        $category = AdCategory::find($pendingAdData['category_id']);
        $adType = AdType::find($pendingAdData['ad_type']);
        $setting = Setting::first();
        
        return view('checkout', compact('pendingAdData', 'category', 'adType', 'setting'));
    }

    public function processPayment(Request $request)
    {
        $pendingAdData = session('pending_ad_data');
        
        if (!$pendingAdData) {
            return redirect()->route('dashboard')->with('error', 'No pending ad data found.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => 'ad_payment',
                        'description' => 'Payment for ad: ' . $pendingAdData['title'],
                    ],
                    'unit_amount' => $pendingAdData['total_price'] * 100, // Rs. 500 in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            'metadata' => [
                'payment_type' => 'ad_payment',
                'ad_title' => $pendingAdData['title'],
                'user_id' => auth('poster')->user()->id,
            ],
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $pendingAdData = session('pending_ad_data');
        
        if ($pendingAdData) {
            // Update user verification status
            $user = auth('poster')->user();
            
            $user->update(['is_verified' => true]);
            // Create the ad
            $ad = Ad::create([
                'poster_id' => $user->id,
                'title' => $pendingAdData['title'],
                'image' => $pendingAdData['image'],
                'thumbnail' => $pendingAdData['thumbnail'],
                'category_id' => $pendingAdData['category_id'],
                'ad_type' => $pendingAdData['ad_type'],
                'location' => $pendingAdData['location'],
                'price' => $pendingAdData['price'],
                'description' => $pendingAdData['description'],
                'is_on_whatsapp' => $pendingAdData['is_on_whatsapp'],
                'is_on_imo' => $pendingAdData['is_on_imo'],
                'is_on_viber' => $pendingAdData['is_on_viber'],
                'is_on_telegram' => $pendingAdData['is_on_telegram'],
                'is_active' => true,
            ]);

            $transaction = Transactions::create([
                'poster_id' => $user->id,
                'ad_id' => $ad->id,
                'amount' => $pendingAdData['total_price'],
                'payment_type' => $pendingAdData['payment_type'],
            ]);
            
            // Clear session data
            session()->forget('pending_ad_data');
            
            return redirect()->route('dashboard')->with('success', 'Payment successful! Your profile has been verified and ad has been created.');
        }
        
        return redirect()->route('dashboard')->with('success', 'Payment successful!');
    }

    public function cancel()
    {
        // Clear session data on cancel
        session()->forget('pending_ad_data');
        return redirect()->route('dashboard')->with('error', 'Payment was cancelled.');
    }
}
