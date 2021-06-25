<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\City;
use App\Models\About;
use App\Models\State;
use App\Models\Career; 
use App\Models\Header; 
use App\Models\Footer; 
use App\Models\Coupon;
use App\Models\Support; 
use App\Models\Country;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Quantity;
use App\Models\Feedback;
use App\Models\FoodItem;
use App\Models\HomeContent;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\GalleryCategory;
use App\Models\OtpVerification;
use App\Models\PromotionalBanner;
use App\Models\HomePageContentSetting;
use App\Http\Controllers\Concern\GlobalTrait;

class HomeController extends Controller
{
	use GlobalTrait;

	/**
	 * Forgot Password Function's Started Form Here
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function forgotPassword() {
    	return view('admin.forgot-password');
    }

    public function sendResetPasswordLink(Request $request) {
    	$request->validate(
    		[
    			'email' => 'required|email'
    		]
    	);
    	$picked = User::where('email', $request->email)->first();
    	if(!$picked) {
    		return redirect()->back()->with('danger-alert', 'This email id does not exist in out record.');
    	}
    	$otp  = rand(100000, 999999);
    	$link = url('').'/user/reset/password/'.base64_encode($otp);
    	$otp_data = $this->storeOtpData($picked->id, $otp, $picked->email, null, 'Forgot Password');
    	// Get Forgot Email Template
    	$_template = EmailTemplate::where('code', 'FORGOTPASSWORD-9837')->where('status', 'Yes')->first();
    	if($_template) {
    		if($_template->button) {
    			$buttn_var = array('#LINK' => $link);
    			$button_temp = $this->modifyTemplateButton($_template->button_html, $buttn_var);
    		}
    		$replacetemplate = Array(
    		    '#NAME'   => $picked->name,
    		    '#BUTTON' => $button_temp ? $button_temp : null
    		);
    		$this->__sendEmail($picked, $_template->template, $_template->subject, $_template->image, $replacetemplate);
    	}
    	return redirect()->back()->with('success-alert', 'Reset password link successfully send on your registered email id.');
        
    }

    public function resetPassword($otp) {
    	$otp = base64_decode($otp);
    	$check_otp = OtpVerification::where('otp', $otp)
    		->where('created_at','>',\Carbon\Carbon::now()
    		->subMinutes(30))
    		->first();
    	if(!$check_otp) {
    		return redirect()->route('forgotPassword')->with('danger-alert', 'Your link is expired, please try again.');
    	}
    	$user = User::find($check_otp->user_id);
    	return view('reset-password', compact('user', 'check_otp'));
    }

    public function updateUserPassword(Request $request) {
    	$request->validate(
    		[
    			'password'              => 'required|min:3|confirmed',
                'password_confirmation' => 'required|min:3'
    		]
    	);
    	$user = User::find($request->id);
    	$user->update(
    		[
    			'password' => \Hash::make($request->password)
    		]
    	);
        $check_otp = OtpVerification::find($request->otp_id)->delete();
    	return redirect()->route('admin.login.view')->with('success-alert', 'Password updated successfully.please login your account.');
    }

    /**
     * Get States Based On Country
     *
     * @return \Illuminate\Http\Response
     */
    public function getStates($country_id) {
        try{
            $states = State::where('country_id', $country_id)->get();
            return $this->success('State Found Successfully', $states);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    /**
     * Get States Based On Country
     *
     * @return \Illuminate\Http\Response
     */
    public function getCities($state_id) {
        try{
            $cities = City::where('state_id', $state_id)->orderBy('name', 'ASC')->get();
            return $this->success('Cities Found Successfully', $cities);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    /**
     * Get Sub Categories
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubCategories($id) {
        try{
            $sub_categories = Category::where('parent_id', $id)->orderBy('name', 'ASC')->get();
            return $this->success('Sub Categories Found Successfully', $sub_categories);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    /**
     * Get Sub Categories Based On Multiple Categories
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubCategoriesByArray(Request $request) {
        try{
            $sub_categories = Category::whereIn('parent_id', $request->ids)->orderBy('name', 'ASC')->get();
            return $this->success('Sub Categories Found Successfully', $sub_categories);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    public function quantityList() {
        try{
            $datas = Quantity::orderBy('type', 'ASC')->where('status', 'Yes')->get();
            return $this->success('Quantities Found Successfully', $datas);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    public function foodItems(Request $request) {
        try{
            if($request->has('sub_categories')) {
                $datas = FoodItem::whereIn('sub_category_id', $request->sub_categories)->get();
            }else {
                $datas = FoodItem::whereIn('category_id', $request->categories)->get();
            }
            return $this->success('Food Items Found Successfully', $datas);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }


    /**
     * Frontend Pages Functions Started From Here
     *
     * @return \Illuminate\Http\Response
     */

    
    /**
     * Go to Home Page
     *
     * @return \Illuminate\Http\Response
     */    
    public function home() {
        $banners = PromotionalBanner::where('status', 'Yes')->orderBy('position', 'ASC')->get();
        $about   = About::first();
        $category_setting = HomePageContentSetting::where('slug', 'category')->first();
        $best_food_setting= HomePageContentSetting::where('slug', 'best_dish')->first();
        $popular_food_setting = HomePageContentSetting::where('slug', 'popular_foods')->first();
        $home_categories  = Category::whereIn('id', explode(',', $category_setting->ids))->get();
        $best_food_dish   = FoodItem::whereIn('id', explode(',', $best_food_setting->ids))->first();
        $popular_foods    = FoodItem::with(['getGallery'])->whereIn('id', explode(',', $popular_food_setting->ids))->get();
        return view('frontend.index', compact('banners', 'about', 'home_categories', 'best_food_setting', 'best_food_dish', 'popular_food_setting', 'popular_foods'));
    }

    /**
     * View Policy Page Front
     *
     * @return \Illuminate\Http\Response
     */  
    public function policy() {
        $policy = HomeContent::where('slug', 'policy')->first();
        return view('frontend.privecy', compact('policy'));
    }

    /**
     * View Term Page Front
     *
     * @return \Illuminate\Http\Response
     */  
    public function terms() {
        $term = HomeContent::where('slug', 'term')->first();
        return view('frontend.terms', compact('term'));
    }

    /**
     * View Refund Page Front
     *
     * @return \Illuminate\Http\Response
     */  
    public function refund() {
        $refund = HomeContent::where('slug', 'refund')->first();
        return view('frontend.refund-policy', compact('refund'));
    }

    /**
     * View Refund Page Front
     *
     * @return \Illuminate\Http\Response
     */  
    public function shipping() {
        $cookie = HomeContent::where('slug', 'cookie')->first();
        return view('frontend.cookie', compact('cookie'));
    }

    public function about() {
        $about = About::first();
        return view('frontend.about', compact('about'));
    }

    public function career() {
        $countries = Country::orderBy('name', 'ASC')->get();
        $posts     = Post::where('status', 'Yes')->orderBy('name', 'ASC')->get();
        return view('frontend.career', compact('countries', 'posts'));
    }

    public function gallery() {
        $categories = GalleryCategory::where('status', 'Yes')->get();
        $gallery_header    = HomePageContentSetting::where('slug', 'gallery')->first();
        return view('frontend.gallery', compact('categories', 'gallery_header'));
    }

    public function galleryImages($id) {
        $g_id = base64_decode($id);
        $category = GalleryCategory::find($g_id);
        $images = Gallery::where('category_id', $g_id)->get();
        return view('frontend.gallery-details', compact('images', 'category'));
    }

    public function guestReview() {
        $testimonial_header = HomePageContentSetting::where('slug', 'testimonial')->first();
        return view('frontend.guest-review', compact('testimonial_header'));
    }

    public function offer() {
        $coupons = Coupon::where('start_date', '<=' , date('Y-m-d'))
            ->where('end_date', '>=' , date('Y-m-d'))
            ->get();
        return view('frontend.offer', compact('coupons'));
    }

    public function foods(Request $request) {
        $categories = Category::where('parent_id', null)->where('status', 'Yes')->get();
        if($request->input('category')) {
            $foods  = FoodItem::where('category_id', base64_decode($request->input('category')))->where('status', 'Yes')->orderBy('id', 'DESC')->paginate(6)->appends(request()->query());
        }else {
            $foods  = FoodItem::where('status', 'Yes')->orderBy('id', 'DESC')->paginate(6)->appends(request()->query());
        }

        return view('frontend.food-items', compact('categories', 'foods'));
    }

    public function foodFilters(Request $request) {
        if($request->ajax())
        {
            if($request->id) {
                $foods  = FoodItem::where('category_id', base64_decode($request->id))->where('status', 'Yes');
            }else {
                $foods  = FoodItem::where('status', 'Yes')->orderBy('id', 'DESC');
            }
            if($request->search_key) {
                $foods->where('name','LIKE','%'.$request->search_key.'%');
            }
            if($request->sort_by == 'low') {
                
            }else if($request->sort_by == 'high') {
                
            }else if($request->sort_by == 'old') {
                $foods->orderBy('id', 'ASC');
            }else if($request->sort_by == 'new') {
                $foods->orderBy('id', 'DESC');
            }else {
                $foods->orderBy('id', 'DESC');
                
            }
            $foods = $foods->paginate(2);
            return view('frontend.items', compact('foods'))->render();
        }
    }

    public function foodDetails($id)
    {
        $picked = FoodItem::with(['getGallery', 'getVarients', 'getCategory', 'getSubCategory'])->find(base64_decode($id));
        return view('frontend.food-details', compact('picked'));
    }

    public function addFavourite(Request $request) {
        try{
            $picked = FoodItem::find($request->id);
            $picked->update(
                [
                    'favourite' => \Auth::id()
                ]
            );
            return $this->success('Food Items Successfully Added As A Favourite.', $picked);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    public function createGuestReview(Request $request) {
        $request->validate(
            [
                'name'          => 'required|max:150',
                'mobile_number' => 'required|integer|digits_between:10, 15',
                'email'         => 'required|email',
                'feedback'      => 'required',
                'file'          => 'nullable|mimes:jpg,png,jpeg,svg'
            ]
        );
        if(\Auth::user()) {
            $added_by = \Auth::user()->role == 'admin' ? 'Admin' : 'Customer';
            $user_id  = \Auth::id();
        }else {
            $added_by = 'Customer';
            $user_id  = null;
        }
        if($request->hasFile('file')){
            $image_url = $request->file->store('feedbacks');
        }else {
            $image_url = null;
        }
        $data = Feedback::create(
            [
                'user_id'         => $user_id,
                'image'           => $image_url,
                'name'            => $request->name,
                'email'           => $request->email,
                'mobile_number'   => $request->mobile_number,
                'feedback'        => $request->feedback,
                'added_by'        => $added_by,
            ]
        );
        $admin_msg = 'A new feedback generated by '.$data->name;
        $this->_sendAdminDbNotifications('feedback-front', $admin_msg, $data);
        return redirect()->back()->with('success', 'Your Feedback Sucecssfully Submitted.');
    }

    public function contact() {
        $header_details = Header::first();
        $footer_details = Footer::first();
        $contact_info   = HomePageContentSetting::where('slug', 'contact')->first();
        return view('frontend.contact', compact('header_details', 'footer_details', 'contact_info'));
    }

    public function contactEnquiry(Request $request) {
        $request->validate(
            [
                'name'          => 'required|max:150',
                'mobile_number' => 'required|integer|digits_between:10, 15',
                'email'         => 'required|email',
                'subject'       => 'required|max:190',
                'message'       => 'required'
            ]
        );
        $c_name = strtoupper(substr($request->name, 0, 3));
        $c_num  = rand(1000, 9999);
        $year   = date('Y');
        $support_id = 'SUPPORT'.$c_name.$c_num.$year;
        $data = Support::create(
            [
                'support_id'     => $support_id,
                'name'           => $request->name,
                'email'          => $request->email,
                'mobile_number'  => $request->mobile_number,
                'subject'        => $request->subject,
                'message'        => $request->message,
            ]
        );
        // Send User Career Mail
        $_template = EmailTemplate::where('code', 'USERCONTACTSUPPORT-9285')->where('status', 'Yes')->first();
        if($_template) {
            $button_temp = null;
            if($_template->button) {
                $link        = url('');  
                $buttn_var   = array('#LINK' => $link);
                $button_temp = $this->modifyTemplateButton($_template->button_html, $buttn_var);
            }
            $replacetemplate = Array(
                '#NAME'       => $data->name,
                '#ENQUIRY-ID' => $data->support_id,
                '#BUTTON'     => $button_temp
            );
            $check = $this->__sendEmail($data, $_template->template, $_template->subject, $_template->image, $replacetemplate);
        }
        // Send Database Admin Notifications
        $admin_msg = 'New Support Enquiry Generated By '.$data->name;
        $check = $this->_sendAdminDbNotifications('support-request', $data, $data);
        return redirect()->back()->with('success', 'Your Support Enquiry Request Submitted Successfully.');
    }

    public function careerEnquiry(Request $request) {
        $request->validate(
            [
                'name'           => 'required|max:150',
                'mobile_number'  => 'required|numeric|digits_between:10, 15',
                'email'          => 'required|email',
                'dob'            => 'required|date',
                'image'          => 'required|mimes:jpg,jpeg,png,svg',
                'gender'         => 'required',
                'country'        => 'required|integer',
                'state'          => 'required|integer',
                'city'           => 'required|integer',
                'address'        => 'required',
                'post'           => 'required|integer',
                'cv'             => 'required|mimes:jpg,jpeg,png,pdf',
                'message'        => 'nullable'
            ]
        );
        $c_name = strtoupper(substr($request->name, 0, 3));
        $c_num  = rand(1000, 9999);
        $year   = date('Y');
        $enquiry_id = 'JOB'.$c_name.$c_num.$year;
        $image_url  = $request->image->store('profile');
        $cv_url     = $request->image->store('cv');
        $career = Career::create(
            [
                'enquiry_id'     => $enquiry_id,
                'name'           => $request->name,
                'email'          => $request->email,
                'mobile_number'  => $request->mobile_number,
                'dob'            => $request->dob,
                'image'          => $image_url,
                'gender'         => $request->gender,
                'country_id'     => $request->country,
                'state_id'       => $request->state,
                'city_id'        => $request->city,
                'address'        => $request->address,
                'post_id'        => $request->post,
                'cv'             => $cv_url,
                'message'        => $request->message,
            ]
        );
        // Send User Career Mail
        $_template = EmailTemplate::where('code', 'USERCAREERENQUIRY-9059')->where('status', 'Yes')->first();
        if($_template) {
            $button_temp = null;
            if($_template->button) {
                $link        = url('');  
                $buttn_var   = array('#LINK' => $link);
                $button_temp = $this->modifyTemplateButton($_template->button_html, $buttn_var);
            }
            $replacetemplate = Array(
                '#NAME'       => $career->name,
                '#ENQUIRY-ID' => $career->enquiry_id,
                '#BUTTON'     => $button_temp
            );
            $check = $this->__sendEmail($career, $_template->template, $_template->subject, $_template->image, $replacetemplate);
        }

        // Send Career Email To Admin
        $admin = User::where('role', 'admin')->first();
        $a_template = EmailTemplate::where('code', 'ADMINCAREERREQUEST-5606')->where('status', 'Yes')->first();
        if($a_template) {
            $button_temp = null;
            if($a_template->button) {
                $link        = url('');  
                $buttn_var   = array('#LINK' => $link);
                $button_temp = $this->modifyTemplateButton($a_template->button_html, $buttn_var);
            }
            $replacetemplate = Array(
                '#NAME'       => $admin->name,
                '#USERNAME'   => $career->name,
                '#ENQUIRY-ID' => $career->enquiry_id,
                '#BUTTON'     => $button_temp
            );
            $this->__sendEmail($admin, $a_template->template, $a_template->subject, $a_template->image, $replacetemplate);
        }
        // Send Database Admin Notifications
        $admin_msg = 'New career request is generated by '.$career->name;
        $check = $this->_sendAdminDbNotifications('career-request', $admin_msg, $career);
        return redirect()->back()->with('success', 'Thank You, Your request has been registered in our system, please wait you will be contacted from our office.');
    }

    public function emailVerification($otp) {
        $p_otp  = base64_decode($otp);
        $picked = OtpVerification::where('otp', $p_otp)
            ->where('created_at','>',\Carbon\Carbon::now()
            ->subMinutes(30))
            ->first();
        if(!$picked) {
            return redirect('user/login')->with('error', 'Link Expired Or Please Try Again.');
        }
        $user   = User::find($picked->user_id);
        $user->update(
            [
                'email_verified_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ]
        );
        $picked->delete();
        return redirect('user/login')->with('success', 'Your Email Successfully Verified');
    }
}
