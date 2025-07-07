<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class SmsHelper
{
    public static function sendSms($to, $message)
    {
        $apiKey = env('SMS_API_KEY');  // .env ফাইল থেকে API KEY
        $response = Http::get("https://api.sms.net.bd/sendsms", [
            'api_key' => $apiKey,
            'msg' => $message,
            'to' => $to,
        ]);

        return $response->json(); // রেসপন্স JSON আকারে ফেরত দিবে
    }
}
