<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class AdminController extends Controller
{
    use GlobalTrait;

    /**
     * Go to the admin login page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }


    /**
     * Performing Admin Login Operations
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
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
            if (Auth::attempt(array('mobile_number' => $email, 'password' => $password,'role'=>'admin'))) {
                return redirect()->route('admin.dashboard');
            }else {
                return redirect()->back()->with('warning-alert', 'Invalid login credentials, please enter correctly.');
            }
        }else {
            if (Auth::attempt(array('email' => $email, 'password' => $password,'role'=>'admin'))) {
                return redirect()->route('admin.dashboard');
            }else {
                return redirect()->back()->with('warning-alert', 'Invalid login credentials, please enter correctly.');
            }

        }
    }

    /**
     * Logout Admin Operation
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        Auth::logout();
        \Session::flush();
        return redirect('admin/login')->with('success', 'Logout Successfully.');
    }

    /**
     * Go to the Admin Dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard() {
        return view('admin.dashboard');
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show Admin Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('admin.edit_profile');
    }

    /**
     * Update User Personal Info
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'username'      => 'required|max:20',
                'name'          => 'required|max:100',
                'email'         => 'required|email|unique:users,email,'.\Auth::id(),
                'mobile_number' => 'required|integer|digits:10|unique:users,mobile_number,'.\Auth::id(),
                'company'       => 'nullable',
                'file'          => 'nullable|mimes:jpg,png,jpeg'
            ]
        );
        if($request->hasFile('file')){
            $path = $request->file->store('profile');
            Storage::delete(\Auth::user()->profile_photo);
        }else {
            $path = \Auth::user()->profile_photo;
        }
        \Auth::user()->update(
            [
                'username'       => $request->username,
                'profile_photo'  => $path,
                'name'           => $request->name,
                'email'          => $request->email,
                'mobile_number'  => $request->mobile_number,
                'company_name'   => $request->company
            ]
        );
        return redirect()->back()->with(['success' => 'Profile Updated Successfully.', 'type' => 'Personal']);
    }

    /**
     * Update User Information
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(Request $request) {
        $request->validate(
            [
                'about_me' => 'required',
                'dob'      => 'required|date',
                'address'  => 'required|max:300',
                'website'  => 'required|url',
                'phone'    => 'required|numeric|digits_between:10,12'
            ]
        );
        \Auth::user()->update(
            [
                'about_me'    => $request->about_me,
                'dob'         => $request->dob,
                'address'     => $request->address,
                'website'     => $request->website,
                'phone_number'=> $request->phone,
            ]
        );
        return redirect()->back()->with(['success' => 'Profile Information Updated Successfully.', 'type' => 'Info']);
    }

    /**
     * Update Admin User Passowrd
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request) {
        $request->validate(
            [
                'old_passowrd'          => 'required',
                'password'              => 'required|confirmed',
                'password_confirmation' => 'required',
            ]
        );
        if(\Hash::check($request->old_passowrd, \Auth::user()->password)){
            \Auth::user()->update(
                [
                    'password' => \Hash::make($request->password)
                ]
            );
            return redirect()->back()->with(['success' => 'Your Password Updated Successfully.', 'type' => 'password']);
        }else {
            return redirect()->back()->with(['warning' => 'Invalid Old Password! Please Enter Correct', 'type' => 'password']);
        }
    }

    /**
     * Update Social Links
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSocialLinks(Request $request) {
        $request->validate(
            [
                'facebook' => 'nullable|url',
                'twitter'  => 'nullable|url',
                'linkedin' => 'nullable|url',
                'youtube'  => 'nullable|url',
            ]
        );
        \Auth::user()->update(
            [
                'facebook' => $request->facebook,
                'twitter'  => $request->twitter,
                'youtube'  => $request->youtube,
                'linkedin' => $request->linkedin,
            ]
        );
        return redirect()->back()->with(['success' => 'Social Links Updated Successfully.', 'type' => 'social']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
