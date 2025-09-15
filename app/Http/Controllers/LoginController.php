<?php

namespace App\Http\Controllers;

use App\Http\services\SmsService;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('frontend.login');
    }

    public function sendOtp(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'phone' => 'required|string',
        ]);

        $otp = rand(100000, 999999);
        $poster = Poster::where('phone', $request->country_code . $request->phone)->first();
        if(!$poster){
            $poster = new Poster();
            $poster->phone = $request->country_code . $request->phone;
            $poster->is_verified = false;
            $poster->is_active = true;
            $poster->save();
        }
        $poster->otp = $otp;
        $poster->save();

        $phone = $request->phone;
        $countryCode = $request->country_code;

        $phone = $countryCode . $phone;

        $smsService = new SmsService();

        $smsService->sendSms($phone, $otp);


        return redirect()->route('otp', ['phone' => $phone]);

        // Here you would typically send the OTP to the user's phone
        // For demonstration purposes, we'll just return a success message
    }

    public function otp()
    {
        return view('frontend.otp');
    }

    public function verifyOtp(Request $request)
    {

        $request->validate([
            'otp' => 'required',
            'phone' => 'required|string',
        ]);

        $otp = implode('', $request->otp);;
        $phone = $request->phone;
        $poster = Poster::where('phone', $phone)->where('otp', $otp)->first();
        
        if($poster){

            Auth::guard('poster')->login($poster);
                    // Double check login
            if(Auth::guard('poster')->check()){
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'otp' => 'Invalid OTP.',
        ])->onlyInput('otp');

    }

        /**
     * Logout poster.
     */
    public function logout(Request $request)
    {
        Auth::guard('poster')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
