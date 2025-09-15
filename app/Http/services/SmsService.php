<?php

namespace App\Http\services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public function sendSms($phone, $otp)
    {
        if (strpos($phone, '+') === 0) {
            $phone = substr($phone, 1);
        }

        $client_id       = "110648";       // Replace with your client ID
        $api_key         = "fxHnhiK0RDxOoU6";     // Replace with your API key
        $sender_id       = "adzlk.com";   // Replace with your sender id
        $message         = "Hello. Your OTP is " . $otp;        // Message
        $rec_contact_no  = $phone;    // Recipient contact no

        Log::info($otp);

        $response = Http::withOptions([
            'verify' => false, // disable SSL verification if needed
        ])->get('https://api.ozonesender.com/v1/send/', [
            'user_id'              => $client_id,
            'api_key'              => $api_key,
            'sender_id'            => $sender_id,
            'message'              => $message,
            'recipient_contact_no' => $rec_contact_no,
        ]);

        return $response->body(); // return API response
    }
}
