<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\OtpVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class UserController extends Controller
{
    use GlobalTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    }

     public function login() {
        return view('user.login');
    }

    public function registration() {
        return view('user.registration');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate(
            [
                'name'                  => 'required|max:150',
                'mobile_number'         => 'required|integer|digits:10|unique:users,mobile_number',
                'email'                 => 'required|email|unique:users',
                'password'              => 'required|min:3|confirmed',
                'password_confirmation' => 'required|min:3'
            ]
        );
        $pass = $request->password;
        $c_name = strtoupper(substr($request->name, 0, 3));
        $c_num  = rand(1000, 9999);
        $year   = date('Y');
        $user_unique_id = 'U'.$c_name.$c_num.$year;
        $user = User::create(
            [
                'role'             => 'user',
                'username'         => $user_unique_id,
                'name'             => $request->name,
                'email'            => $request->email,
                'mobile_number'    => $request->mobile_number,
                'password'         => \Hash::make($request->password),
            ]
        );
        // Send Welcome Mail
        $_template = EmailTemplate::where('code', 'USERREGISTRATION-1513')->where('status', 'Yes')->first();
        if($_template) {
            $button_temp = null;
            if($_template->button) {
                $link        = url('');  
                $buttn_var   = array('#LINK' => $link);
                $button_temp = $this->modifyTemplateButton($_template->button_html, $buttn_var);
            }
            $replacetemplate = Array(
                '#NAME'     => $user->name,
                '#EMAIL'    => $user->email,
                '#PASSWORD' => $pass,
                '#BUTTON'   => $button_temp
            );
            $this->__sendEmail($user, $_template->template, $_template->subject, $_template->image, $replacetemplate);
        }

        // Send Email Verification Link
        $_template = EmailTemplate::where('code', 'EMAILVERIFICATION-8685')->where('status', 'Yes')->first();
        $otp = rand(100000, 999999);
        $this->storeOtpData($user->id, $otp, $user->email, null, 'Email Verification');
        if($_template) {
            $button_temp = null;
            if($_template->button) {
                $link        = url('').'/email/verify/'.base64_encode($otp);  
                $buttn_var   = array('#LINK' => $link);
                $button_temp = $this->modifyTemplateButton($_template->button_html, $buttn_var);
            }
            $replacetemplate = Array(
                '#NAME'     => $user->name,
                '#EMAIL'    => $user->email,
                '#PASSWORD' => $pass,
                '#BUTTON'   => $button_temp
            );
            $this->__sendEmail($user, $_template->template, $_template->subject, $_template->image, $replacetemplate);
        }
        // Send Database Notifications
        $user_msg = 'Welcome '.$user->name.', your account successfully created.';
        $admin_msg = 'Now '.$user->name.', is Joined with us.';
        $this->_sendUserDbNotifications('user-registration', $user, $user_msg);
        $this->_sendAdminDbNotifications('user-registration', $admin_msg);
        return redirect('user/login')->with('success', 'Your Account Successfully Created, Please verify your e-mail ID The verification link has been sent to the e-mail you entered on registration.');
    }

    public function userLogin(Request $request) {
        $request->validate(
            [
                'email'    => 'required',
                'password' => 'required'
            ],
            [
            ],
            [
                'email.required' => 'Email or mobile number field must be required.'
            ]
        );
        $check = $this->checkKeyType($request->email);
        $email    = $request->email;
        $password = $request->password;
        if($check == 'mobile') {
            if (Auth::attempt(array('mobile_number' => $email, 'password' => $password,'role'=>'user'))) {
                if($request->input('type') == 'Cart'){
                    return redirect('cart');
                }else{
                    return redirect()->route('user.dashboard');
                }
            }else {
                return redirect()->back()->with('warning', 'Invalid login credentials, please enter correctly.');
            }
        }else {
            if (Auth::attempt(array('email' => $email, 'password' => $password,'role'=>'user'))) {
                if($request->input('type') == 'Cart'){
                    return redirect('cart');
                }else{
                    return redirect()->route('user.dashboard');
                }
            }else {
                return redirect()->back()->with('warning', 'Invalid login credentials, please enter correctly.');
            }

        }
    }


    /**
     * Display the User Dashboard.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function profile() {
        return view('user.profile');
    }

    public function editProfile() {
        return view('user.edit-profile');
    }

    public function setting() {
        return view('user.settings');
    }

    public function updateProfile(Request $request) {
        $request->validate(
            [
                'name'            => 'required|max:150',
                'mobile_number'   => 'required|integer|digits:10|unique:users,mobile_number,'.Auth::id(),
                'email'           => 'required|email|unique:users,email,'.Auth::id(),
                'dob'             => 'required|date|before:today',   
                'image'           => 'nullable|mimes:jpg,jpeg,png'         
            ]
        );
        $profile_url = $request->has('image') ? $request->image->store('profile') : Auth::user()->profile_photo;
        Auth::user()->update(
            [
                'profile_photo'    => $profile_url,
                'dob'              => $request->dob,
                'gender'           => $request->gender,
                'name'             => $request->name,
                'email'            => $request->email,
                'mobile_number'    => $request->mobile_number,
                'marital_status'   => $request->marital_status,
                'about_me'         => $request->about_me,
            ]
        );
        return redirect()->back()->with('success', 'Profile Updated Successfully.');
    }

    public function managePassword() {
        return view('user.password');
    }

    /**
     * Logout User Operation
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        Auth::user()->update(
            [
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        );
        Auth::logout();
        \Session::flush();
        return redirect('user/login')->with('success', 'Logout Successfully.');
    }

}
