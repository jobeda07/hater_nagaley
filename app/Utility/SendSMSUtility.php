<?php

namespace App\Utility;

use App\Models\SmsProvider;
use Twilio\Rest\Client;

class SendSMSUtility
{
    public static function sendSMS($to, $body)
    {
        $sms_provider   = SmsProvider::where('status',1)->first();
        if($sms_provider){
            $url = $sms_provider->url;
            $data = [
                "api_key" => $sms_provider->api_key,
                "type" => "unicode",
                "contacts" => $to,
                "senderid" => $sms_provider->sender_id,
                "msg" => $body,
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        }

        //dd("not found");
        return true;
    }
    
}
