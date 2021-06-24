<?php
namespace App\Http\Controllers\Concern;

use App\Models\User;
use App\Models\Header;
use App\Models\SmsHistory;
use App\Models\EmailHistory;
use App\Events\SendEmailEvent;
use App\Models\OtpVerification;
use App\Models\PasswordHistory;
use Illuminate\Support\Facades\Storage;
use App\Notifications\DatabaseNotification;

Trait GlobalTrait {

	/*
	|--------------------------------------------------------------------------
	| Get Login Type Key Like Email Or Mobile Number
	|--------------------------------------------------------------------------
	*/
	protected function checkKeyType($key) {
      $data = is_numeric($key) ? 'mobile' : 'email';
      return $data;
    }
 
    /*
    |--------------------------------------------------------------------------
    | Date Conversion With Local Time Zone 
    |--------------------------------------------------------------------------
    */
    public static function convertDateTime($dateTime) {
        $dt = new \DateTime($dateTime);
        $tz = new \DateTimeZone('Asia/Kolkata');
        $dt->setTimezone($tz);
        $dateTime = $dt->format('d.m.Y h:i A');
        return $dateTime;
    }

    /*
    |--------------------------------------------------------------------------
    | API Success Response 
    |--------------------------------------------------------------------------
    */
    protected function success($msg, $data) {
        return response()->json(
            [
                'status'  => true,
                'code'    => 200,
                'message' => $msg,
                'data'    => $data
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | API Error Response 
    |--------------------------------------------------------------------------
    */
    protected function error($e = null, $msg = null) {
        return response()->json(
            [
                'status'  => false,
                'status'  => 500,
                'message' => $e ? ['error' =>$e->getMessage()] : ['error' =>$msg],
                'data'    => null
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Modify Template Message
    |--------------------------------------------------------------------------
    */
    protected function modifyMessageTemplate($message, $variable) {
        $replaceMessage = $variable;
        foreach($replaceMessage as $agr_key => $agr_text) {
            $message = str_replace($agr_key, $agr_text, $message);
        }
        $new_message = $message;
        return $new_message;
    }

    protected function modifyTemplateButton($message, $variable) {
        $replaceMessage = $variable;
        foreach($replaceMessage as $agr_key => $agr_text) {
            $message = str_replace($agr_key, $agr_text, $message);
        }
        $new_message = $message;
        return $new_message;
    }

    /*
    |--------------------------------------------------------------------------
    | Send Email For Based On Template
    |--------------------------------------------------------------------------
    */
    protected function __sendEmail($user, $template, $subject, $image, $variable) {
        try{
            $header_content      = Header::first();
            $_template           = $this->modifyMessageTemplate($template, $variable);
            $data['notify_user'] = $user;
            $data['template']    = $_template;
            $data['subject']     = $subject;
            $data['image']       = url('public/storage').'/'.$image;
            $data['logo']        = url('public/storage').'/'.$header_content->logo;
            event(New SendEmailEvent($data));
            return true;
        }catch(\Exception $e) {
            return false;
        }
        
    }

    /*
    |--------------------------------------------------------------------------
    | Send SMS Globally
    |--------------------------------------------------------------------------
    */
    protected function sendGlobalSMS($message, $mobile_number) {
        $request_parameter = array(
            'authkey'=>'133780A1osFTuQv5f76e450P1',
            'mobiles'=>$mobile_number,
            'message'=>urlencode($message),
            'sender'=>'WMINGO',
            'route'=>'4',
            'country'=>'91',
        );
        $url = "http://sms.webmingo.in/api/sendhttp.php?";
        foreach($request_parameter as $key=>$val)
        {
            $url.=$key.'='.$val.'&';
        }
        $url=rtrim($url , "&");
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //get response
            $output = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (\Exception $e) {
           return false;
        }
    } 

    protected function _sendUserDbNotifications($type, $user, $message, $data = null) {
        try {
            $user->notify(New DatabaseNotification($type, $user, $message, $data));
            return true;
        } catch (\Exception $e) {
           return false;
        }
    }

    protected function _sendAdminDbNotifications($type, $message, $data = null) {
        try {
            $admin = User::where('role', 'admin')->first();
            $admin->notify(New DatabaseNotification($type, $admin, $message, $data));
            return true;
        } catch (\Exception $e) {
           return false;
        }
        
    }

    /*
    |--------------------------------------------------------------------------
    | Store OTP Data
    |--------------------------------------------------------------------------
    */
    protected function storeOtpData($user_id = null, $otp, $email = null, $mobile_number = null, $use_for) {
        $data = OtpVerification::create(
            [
                'user_id'        => $user_id,
                'otp'            => $otp,
                'email'          => $email,
                'mobile_number'  => $mobile_number,
                'use_for'        => $use_for
            ]
        );
        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | Create Email History
    |--------------------------------------------------------------------------
    */
    protected function createEmailHistory($user_id, $subject, $message, $file = null, $status) {
        EmailHistory::create(
            [
                'user_id'  => $user_id,
                'subject'  => $subject,
                'message'  => $message,
                'file'     => $file,
                'status'   => $status
            ]
        );
        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | Create SMS History
    |--------------------------------------------------------------------------
    */
    protected function createSmsHistory($user_id, $message, $status) {
        SmsHistory::create(
            [
                'user_id'  => $user_id,
                'message'  => $message,
                'status'   => $status
            ]
        );
        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | Create SMS History
    |--------------------------------------------------------------------------
    */
    protected function createPasswordHistory($user_id, $perform_by, $event) {
        PasswordHistory::create(
            [
                'user_id'     => $user_id,
                'perform_by'  => $perform_by,
                'event'       => $event
            ]
        );
        return true;
    }
}