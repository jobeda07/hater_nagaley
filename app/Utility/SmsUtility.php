<?php
namespace App\Utility;

use App\Models\SmsTemplate;
use App\Models\User;
use App\Utility\SendSMSUtility;
use Illuminate\Support\Facades\Session;

class SmsUtility
{
    public static function phone_number_verification($phone)
    {
        $sms_template   = SmsTemplate::where('name','registration_verification')->where('status',1)->first();
        if($sms_template){
            $sms_body       = $sms_template->body;
            $verification_code = rand(100000, 999999);
            Session::put('registration_verification_code', $verification_code);
            $sms_body       = str_replace('[[code]]', $verification_code, $sms_body);
            $sms_body       = str_replace('[[site_name]]', env('APP_NAME'), $sms_body);

            if(substr($phone,0,3)=="+88"){
                $phone = $phone;
            }elseif(substr($phone,0,2)=="88"){
                $phone = '+'.$phone;
            }else{
                $phone = '+88'.$phone;
            }

            SendSMSUtility::sendSMS($phone, $sms_body);
        }
    }

    public static function login_verification($phone)
    {
        
        $sms_template = SmsTemplate::where('name','login_verification')->where('status',1)->first();
        if($sms_template){
            $sms_body       = $sms_template->body;
            $verification_code = rand(100000, 999999);
            Session::put('login_verification_code', $verification_code);
            $sms_body       = str_replace('[[code]]', $verification_code, $sms_body);
            $sms_body       = str_replace('[[site_name]]', env('APP_NAME'), $sms_body);

            if(substr($phone,0,3)=="+88"){
                $phone = $phone;
            }elseif(substr($phone,0,2)=="88"){
                $phone = '+'.$phone;
            }else{
                $phone = '+88'.$phone;
            }

            SendSMSUtility::sendSMS($phone, $sms_body);
        }
    }

    public static function password_reset($phone, $password)
    {
        $sms_template = SmsTemplate::where('name','password_reset')->where('status',1)->first();

        //$new_password = rand(100000, 999999);
        $sms_body       = $sms_template->body;
        $sms_body       = str_replace('[[code]]', $password, $sms_body);
        
        if(substr($phone,0,3)=="+88"){
            $phone = $phone;
        }elseif(substr($phone,0,2)=="88"){
            $phone = '+'.$phone;
        }else{
            $phone = '+88'.$phone;
        }
        $response = SendSMSUtility::sendSMS($phone, $sms_body);
        //dd($response);

        return  $response;
    }

    public static function order_placement($phone='', $order='')
    {
        $sms_template   = SmsTemplate::where('identifier','order_placement')->first();
        $sms_body       = $sms_template->sms_body;
        $sms_body       = str_replace('[[order_code]]', $order->code, $sms_body);
        $sms_body       = str_replace('[[order_amount]]', $order->grand_total, $sms_body);
        $sms_body       = str_replace('[[site_name]]', env('APP_NAME'), $sms_body);
        $template_id    = $sms_template->template_id;
        try {
            sendSMS($phone, env('APP_NAME'), $sms_body, $template_id);
        } catch (\Exception $e) {

        }
    }

    public static function delivery_status_change($phone='', $order)
    {
        $sms_template   = SmsTemplate::where('identifier','delivery_status_change')->first();
        $sms_body       = $sms_template->sms_body;
        $delivery_status = translate(ucfirst(str_replace('_', ' ', $order->delivery_status)));

        $sms_body       = str_replace('[[delivery_status]]', $delivery_status, $sms_body);
        $sms_body       = str_replace('[[order_code]]', $order->code, $sms_body);
        $template_id    = $sms_template->template_id;

        try {
            sendSMS($phone, env('APP_NAME'), $sms_body, $template_id);
        } catch (\Exception $e) {

        }
    }

    public static function payment_status_change($phone='', $order='')
    {
        $sms_template   = SmsTemplate::where('identifier','payment_status_change')->first();
        $sms_body       = $sms_template->sms_body;
        $sms_body       = str_replace('[[payment_status]]', $order->payment_status, $sms_body);
        $sms_body       = str_replace('[[order_code]]', $order->code, $sms_body);
        $template_id    = $sms_template->template_id;
        try {
            sendSMS($phone, env('APP_NAME'), $sms_body, $template_id);
        } catch (\Exception $e) {

        }
    }

    public static function assign_delivery_boy($phone='', $code='')
    {
        $sms_template   = SmsTemplate::where('identifier','assign_delivery_boy')->first();
        $sms_body       = $sms_template->sms_body;
        $sms_body       = str_replace('[[order_code]]', $code, $sms_body);
        $template_id    = $sms_template->template_id;
        try {
            sendSMS($phone, env('APP_NAME'), $sms_body, $template_id);
        } catch (\Exception $e) {

        }
    }


}

?>
