<?php
namespace App\Helper;

use App\Models\Header;
use App\Models\Feedback;
use App\Models\HomePageContentSetting;

class Helper
{
    /*
    |--------------------------------------------------------------------------
    | Date Conversion With Local Time Zone 
    |--------------------------------------------------------------------------
    */
    public static function convertDateTime($dateTime) {
        $dt = new \DateTime($dateTime);
        $tz = new \DateTimeZone('Asia/Kolkata');
        $dt->setTimezone($tz);
        $dateTime = $dt->format('d-M-Y h:i A');
        return $dateTime;
    }

    /*
    |--------------------------------------------------------------------------
    | Get Header Content
    |--------------------------------------------------------------------------
    */
    public static function getHeaderContent() {
        $data = Header::first();
        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | Get Testimonial Data 
    |--------------------------------------------------------------------------
    */
    public static function getTestimonials() {
        $feedbacks = Feedback::where('status', 'Yes')->orderBy('id', 'DESC')->get();
        return $feedbacks;
    }

    /*
    |--------------------------------------------------------------------------
    | Get Home Page Content Data Based On slug
    |--------------------------------------------------------------------------
    */
    public static function getHomePageSection($slug) {
        $data  = HomePageContentSetting::where('slug', $slug)->first();
        return $data;
    }


}