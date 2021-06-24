<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Faq;
use App\Models\User;
use App\Models\About;
use App\Models\Header;
use App\Models\Footer;
use App\Models\Quality;
use App\Models\Feedback;
use App\Models\FoodItem;
use App\Models\Category;
use App\Models\HomeContent;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\CkEditorImage;
use App\Models\PromotionalBanner;
use App\Http\Controllers\Controller;
use App\Models\HomePageContentSetting;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class SettingsController extends Controller
{
	use GlobalTrait;

    /**
     * Manage Header Section Layout
     *
     * @return \Illuminate\Http\Response
     */
    public function manageHeader() {
    	$header = Header::first();
    	return view('admin.settings.header-setting', compact('header'));
    }

    /**
     * Update Header Content
     *
     * @return \Illuminate\Http\Response
     */
    public function updateHeader(Request $request) {
    	$request->validate(
    		[
				'title'        => 'required|max:150',
				'description'  => 'required|max:800',
				'keywords'     => 'required',
				'phone_number' => 'required|numeric|digits_between:10,15',
				'email'        => 'required|email',
				'facebook'     => 'nullable|url',
				'twitter'      => 'nullable|url',
				'youtube'      => 'nullable|url',
				'linkedin'     => 'nullable|url',
				'logo'         => 'nullable|mimes:jpg,png,jpeg,svg',
				'favicon'      => 'nullable|mimes:jpg,png,jpeg,svg',
    		]
    	);
    	$picked = Header::find($request->id);
    	if($request->hasFile('logo')){
    	    $logo_path = $request->logo->store('header');
    	    Storage::delete($picked->logo);
    	}else {
    	    $logo_path = $picked->logo;
    	}
    	if($request->hasFile('favicon')){
    	    $fav_path = $request->favicon->store('header');
    	    Storage::delete($picked->favicon);
    	}else {
    	    $fav_path = $picked->favicon;
    	}
    	$picked->update(
    		[
    			'logo'         => $logo_path,
    			'favicon'      => $fav_path,
    			'title'        => $request->title,
    			'description'  => $request->description,
    			'keywords'     => $request->keywords,
    			'phone_number' => $request->phone_number,
    			'email'        => $request->email, 
    			'facebook'     => $request->facebook,
    			'twitter'      => $request->twitter,
    			'youtube'      => $request->youtube,
    			'linkedin'     => $request->linkedin,
    		]
    	);
    	return redirect()->back()->with('success', 'Header Content Updated Sucecssfully.');
    }

    /**
     * Header Permission Updation
     *
     * @return \Illuminate\Http\Response
     */
    public function updateHeaderPermission(Request $request) {
    	$picked = Header::find($request->id);
    	$picked->update(
    		[
    			'header_permission' => $request->header_permission,
    			'email_permission'  => $request->email_permission,
    			'contact_permission'=> $request->contact_permission,
    			'social_permission' => $request->social_permission
    		]
    	);
    	return redirect()->back()->with('success', 'Header Permissions Updated Sucecssfully.');
    }

     /**
     * Manage Footer Section Layout
     *
     * @return \Illuminate\Http\Response
     */
    public function manageFooter() {
    	$footer = Footer::first();
    	return view('admin.settings.footer-setting', compact('footer'));
    }

    /**
     * Update Footer Content
     *
     * @return \Illuminate\Http\Response
     */
    public function updateFooter(Request $request) {
    	$request->validate(
    		[
				'about'             => 'required|max:800',
				'address'           => 'required|max:300',
				'social_permission' => 'required',
				'copyright'         => 'required|max:150',
    		]
    	);
    	$picked = Footer::find($request->id);
    	$picked->update(
    		[
    			'about'             => $request->about,
    			'address'           => $request->address,
    			'social_permission' => $request->social_permission,
    			'copyright'         => $request->copyright
    		]
    	);
    	return redirect()->back()->with('success', 'Footer Content Updated Sucecssfully.');
    }


    /**
     * Promotional Banners Management Functions Started Here
     *
     * @return \Illuminate\Http\Response
     */
    public function managePromotionalBanners() {
    	$banners = PromotionalBanner::orderBy('id', 'DESC')->get();
    	return view('admin.settings.promotional-banners', compact('banners'));
    }

    public function addPromotionalBanners() {    	
    	return view('admin.settings.add-promotional-banner');
    }

    public function createPromotionalBanners(Request $request) {
    	$request->validate(
    		[
				'file'          => 'required|mimes:jpg,png,jpeg,svg',
				'position'      => 'required|integer|unique:promotional_banners,position',
				'applications'  => 'required',
				'name'          => 'required|max:150',
				'text_required' => 'required',
				'text'          => 'nullable|max:800',
    		]
    	);
    	$image_url = $request->file->store('banners');
    	PromotionalBanner::create(
    		[
    			'name'           => $request->name,
    			'image'          => $image_url,
    			'position'       => $request->position,
    			'text_required'  => $request->text_required,
    			'text'           => $request->text,
    			'applications'   => implode(',', $request->applications),
    			'remark'         => $request->remark,
    		]
    	);
    	return redirect()->route('admin.managePromotionalBanners')->with('success', 'Banner Added Sucecssfully.');

    }

    public function editPromotionalBanners($id) {
    	$picked = PromotionalBanner::find($id);
    	return view('admin.settings.edit-promotional-banner', compact('picked'));
    }

    public function updatePromotionalBanners(Request $request) {
    	$request->validate(
    		[
				'file'          => 'nullable|mimes:jpg,png,jpeg,svg',
				'position'      => 'required|integer|unique:promotional_banners,position,'.$request->id,
				'applications'  => 'required',
				'name'          => 'required|max:150',
				'text_required' => 'required',
				'text'          => 'nullable|max:200',
    		]
    	);
    	$picked = PromotionalBanner::find($request->id);
    	if($request->hasFile('file')){
    	    $image_url = $request->file->store('banners');
    	    Storage::delete($picked->image);
    	}else {
    	    $image_url = $picked->image;
    	}
    	$picked->update(
    		[
    			'name'           => $request->name,
    			'image'          => $image_url,
    			'position'       => $request->position,
    			'text_required'  => $request->text_required,
    			'text'           => $request->text,
    			'applications'   => implode(',', $request->applications),
    			'remark'         => $request->remark,
    		]
    	);
    	return redirect()->route('admin.managePromotionalBanners')->with('success', 'Banner Updated Sucecssfully.');
    }

    public function chnageStatusPromotionalBanners(Request $request) {
    	try{
    		$picked = PromotionalBanner::find($request->id);
    		$status = $picked->status == 'Yes' ? 'No' : 'Yes';
    		$msg    = $picked->status == 'Yes' ? 'Banner Blocked Sucecssfully.' : 'Banner Activated Sucecssfully.';
    		$picked->update(
    			[
    				'status' => $status
    			]
    		);
    		return $this->success($msg, $picked);
    	}catch(\Exception $e) {
    		return $this->error($e, null);
    	}
    }

    public function deletePromotionalBanners(Request $request) {
    	try{
    		$picked = PromotionalBanner::find($request->id);
    		Storage::delete($picked->image);
    		$picked->delete();
    		return $this->success('Banner Deleted Sucecssfully.', null);
    	}catch(\Exception $e) {
    		return $this->error($e, null);
    	}
    }

    /**
     * Feedback Functions Started From Here
     *
     * @return \Illuminate\Http\Response
     */
    public function manageFeedback(Request $request) {
    	if ($request->ajax()) {
    		$feedbacks = Feedback::orderBy('id', 'DESC')->get();
            return Datatables::of($feedbacks)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
 					return $this->convertDateTime($row->created_at);
                })
                ->addColumn('image', function($row){
                    if (Storage::exists($row->image)) 
                      	$image = '<div class="table-image"><img src="'.asset('storage/'.$row->image).'"><span>'.$row->name.'</span></div>';
                    else
                      	$image = '<div class="table-image"><img src="'.asset('').'/admin/images/dummy.jpg"><span>'.$row->name.'</span></div>';
                    return $image;
                })
                ->addColumn('contact', function($row){
                    $contact = '+91'.$row->mobile_number.'<br>'.$row->email;
                    return $contact;
                })
                ->addColumn('feedback', function($row){
                   	$char_count = strlen($row->feedback);
                  	$content = \Illuminate\Support\Str::limit($row->feedback, 100); 
                  	if($char_count > 100){
                  		$feed = '<b style="cursor: pointer;color: blue;" data-toggle="modal" data-target="#feedback'.$row->id.'">more</b>';
                  		$feed = $content.' '.$feed;
                  		return $feed;
                  	}else {
                  		$feed = $content;
                  		return $feed;
                  	}                 		
                })
                ->addColumn('approve_status', function($row){
                    if($row->approve_status == 'Pending') 
                  		$approve_status = '<span class="text-info">Pending</span>';
                  	else
                  		$approve_status = '<span class="text-success">Approved</span>';
                  	return $approve_status;
                })
                ->addColumn('addred_by', function($row){
                    if($row->added_by == 'Admin') 
		                $addred_by = '<span class="text-info">Admin</span>';
		            else
		                $addred_by = '<span class="text-success">Customer</span>';
                  	return $addred_by;
                })
                ->addColumn('status', function($row){
                    if($row->status == 'Yes') 
		                $status = '<span class="text-info">Approved</span><div class="modal fade" id="feedback'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="feedbackTitle">Feedback Description</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>'.$row->feedback.'</p>
                          </div>
                        </div>
                      </div>
                    </div>';
		            else
		                $status = '<span class="text-danger">Pending</span><div class="modal fade" id="feedback'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="feedbackTitle">Feedback Description</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>'.$row->feedback.'</p>
                          </div>
                        </div>
                      </div>
                    </div>';
                  	return $status;
                })
                ->addColumn('action', function($row){
                	$status_route = 'admin/change-status/feedback';
                	$delete_route = 'admin/delete/feedback';
                    if($row->status == 'Yes'){
                    	$action = '
                    		<a href="javascript:void(0)" onclick="changeStatus('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-times"></i></a>
		                    <a href="'.route('admin.updateFeedbackView', $row->id).'" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
		                    <a href="javascript:void(0)" onclick="deleteContent('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    }else {
                    	$action = '
                    		<a href="javascript:void(0)" onclick="changeStatus('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-check-circle"></i></a>
		                    <a href="'.route('admin.updateFeedbackView', $row->id).'" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
		                    <a href="javascript:void(0)" onclick="deleteContent('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    }
                    return $action;
                })
                ->rawColumns(['action', 'image', 'contact', 'approve_status', 'addred_by', 'status', 'feedback'])
                ->make(true);
        }
    	return view('admin.settings.feedback');
    }

    public function addFeedback() {
    	return view('admin.settings.add-feedback');
    }

    public function createFeedback(Request $request) {
    	$request->validate(
    		[
				'name'          => 'required|max:150',
				'mobile_number' => 'required|integer|digits:10',
				'email'         => 'required|email',
				'status'        => 'required',
				'feedback'      => 'required',
				'file'          => 'nullable|mimes:jpg,png,jpeg,svg',
				'applications'  => 'required'
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
    	Feedback::create(
    		[
    			'user_id'         => $user_id,
    			'image'           => $image_url,
    			'name'            => $request->name,
    			'email'           => $request->email,
    			'mobile_number'   => $request->mobile_number,
    			'applications'    => implode(',', $request->applications),
    			'feedback'        => $request->feedback,
    			'approve_status'  => $request->status,
    			'added_by'        => $added_by,
    		]
    	);
    	return redirect()->route('admin.manageFeedback')->with('success', 'Feedback Created Sucecssfully.');
    }

    public function changeStatusFeedback(Request $request) {
    	try{
    		$picked = Feedback::find($request->id);
    		$status = $picked->status == 'Yes' ? 'No' : 'Yes';
    		$msg    = $picked->status == 'Yes' ? 'Feedback Blocked Sucecssfully.' : 'Feedback Activated Sucecssfully.';
    		$picked->update(
    			[
    				'status' => $status
    			]
    		);
    		return $this->success($msg, $picked);
    	}catch(\Exception $e) {
    		return $this->error($e, null);
    	}
    }	

    public function deleteFeedback(Request $request) {
    	try{
    		$picked = Feedback::find($request->id);
    		Storage::delete($picked->image);
    		$picked->delete();
    		return $this->success('Feedback Deleted Sucecssfully.', null);
    	}catch(\Exception $e) {
    		return $this->error($e, null);
    	}
    }

    public function updateFeedbackView($id) {
    	$picked = Feedback::find($id);
    	return view('admin.settings.update-feedback', compact('picked'));
    }

    public function updateFeedback(Request $request) {
    	$request->validate(
    		[
				'name'          => 'required|max:150',
				'mobile_number' => 'required|integer|digits:10',
				'email'         => 'required|email',
				'status'        => 'required',
				'feedback'      => 'required',
				'file'          => 'nullable|mimes:jpg,png,jpeg,svg',
				'applications'  => 'required'
    		]
    	);
    	$picked = Feedback::find($request->id);
    	if($request->hasFile('file')){
    	    $image_url = $request->file->store('feedbacks');
    	    Storage::delete($picked->image);
    	}else {
    	    $image_url = $picked->image;
    	}
    	$picked->update(
    		[
    			'image'           => $image_url,
    			'name'            => $request->name,
    			'email'           => $request->email,
    			'mobile_number'   => $request->mobile_number,
    			'applications'    => implode(',', $request->applications),
    			'feedback'        => $request->feedback,
    			'approve_status'  => $request->status,
    		]
    	);
    	return redirect()->route('admin.manageFeedback')->with('success', 'Feedback Updated Sucecssfully.');
    }

    /**
     * Manage Faq Section Functions
     *
     * @return \Illuminate\Http\Response
     */
    public function manageFaq() {
    	$faqs = Faq::orderBy('id', 'DESC')->paginate(10);
    	return view('admin.settings.manage-faq', compact('faqs'));
    }

    public function addFaq() {
    	return view('admin.settings.add-faq');
    }

    public function createFaq(Request $request) {
    	$request->validate(
    		[
    			'question' => 'required',
    			'answer'   => 'required',
    			'status'   => 'required'
    		]
    	);
    	Faq::create(
    		[
    			'question' => $request->question,
    			'answer'   => $request->answer,
    			'status'   => $request->status,
    		]
    	);
    	return redirect()->route('admin.manageFaq')->with('success', 'Faq Created Successfully.');
    }

    public function updateFaqView($id) {
    	$picked = Faq::find($id);
    	return view('admin.settings.edit-faq', compact('picked'));
    }

    public function updateFaq(Request $request) {
    	$request->validate(
    		[
    			'question' => 'required',
    			'answer'   => 'required',
    			'status'   => 'required'
    		]
    	);
    	$picked = Faq::find($request->id);
    	$picked->update(
    		[
    			'question' => $request->question,
    			'answer'   => $request->answer,
    			'status'   => $request->status,
    		]
    	);
    	return redirect()->route('admin.manageFaq')->with('success', 'Faq Updated Successfully.');
    }

    public function deleteFaq($id) {
    	try{
    		$picked = Faq::find($id);
    		$picked->delete();
    		return $this->success('Faq Deleted Sucecssfully.', null);
    	}catch(\Exception $e) {
    		return $this->error($e, null);
    	}
    }

    /**
     * Manage Quality Routes
     *
     * @return \Illuminate\Http\Response
     */
    public function manageQuality() {
    	$datas = Quality::orderBy('id', 'DESC')->paginate(10);
    	return view('admin.settings.manage-quality', compact('datas'));
    }

    public function addQuality() {
    	return view('admin.settings.add-quality');
    }

    public function createQuality(Request $request) {
    	$request->validate(
    		[
				'heading'  => 'required|max:200',
				'position' => 'required|unique:qualities,position',
				'status'   => 'required',
				'content'  => 'required',
				'image'    => 'nullable|mimes:jpg,jpeg,png,svg'
    		]
    	);
    	if($request->hasFile('file')){
    	    $image_url = $request->file->store('qualities');
    	}else {
    	    $image_url = null;
    	}
    	Quality::create(
    		[
    			'image'    => $image_url,
    			'heading'  => $request->heading,
    			'position' => $request->position,
    			'content'  => $request->content,
    			'status'   => $request->status
    		]
    	);
    	return redirect()->route('admin.manageQuality')->with('success', 'Quality Added Successfully.');

    }

    public function editQuality($id) {
    	$picked = Quality::find($id);
    	return view('admin.settings.edit-quality', compact('picked'));
    }

    public function updateQuality(Request $request) {
    	$request->validate(
    		[
				'heading'  => 'required|max:200',
				'position' => 'required|integer',
				'status'   => 'required',
				'content'  => 'required',
				'image'    => 'nullable|mimes:jpg,jpeg,png,svg'
    		]
    	);
    	$picked = Quality::find($request->id);
    	if($request->hasFile('file')){
    	    $image_url = $request->file->store('qualities');
    	    Storage::delete($picked->image);
    	}else {
    	    $image_url = $picked->image;
    	}
    	$picked_position = Quality::where('position', $request->position)->first();
    	if($picked_position) {
    		if($picked_position->position != $picked->position) {
	    		$position = $picked_position->position;
	    		$picked_position->update(
	    			[
	    				'position' => $picked->position
	    			]
	    		);
	    	}else {
	    		$position = $request->position;
	    	}
    	}else {
    		$position = $request->position;
    	}
    	
    	$picked->update(
    		[
    			'image'    => $image_url,
    			'heading'  => $request->heading,
    			'position' => $position,
    			'content'  => $request->content,
    			'status'   => $request->status
    		]
    	);
    	return redirect()->route('admin.manageQuality')->with('success', 'Quality Updated Successfully.');
    }

    public function deleteQuality($id)
    {
    	try{
    		$picked = Quality::find($id);
    		$picked->delete();
    		return $this->success('Quality Deleted Sucecssfully.', null);
    	}catch(\Exception $e) {
    		return $this->error($e, null);
    	}
    }

	/**
	* Manage Term & Conditions
	*
	* @return \Illuminate\Http\Response
	*/
	public function manageTerms() {
		$picked = HomeContent::where('slug', 'term')->first();
		return view('admin.settings.terms', compact('picked'));
	}

	public function managePolicy() {
		$picked = HomeContent::where('slug', 'policy')->first();
		return view('admin.settings.policy', compact('picked'));
	}

	public function manageRefundContent() {
		$picked = HomeContent::where('slug', 'refund')->first();
		return view('admin.settings.refund-content', compact('picked'));
	}

	public function manageCookieContent() {
		$picked = HomeContent::where('slug', 'cookie')->first();
		return view('admin.settings.cookie-content', compact('picked'));
	}

	public function updateHomeContent(Request $request) {
		$request->validate(
			[
                'heading'     => 'required|max:150',
                'title'       => 'required|max:800',
 				'description' => 'required'
			]
		);
		$picked = HomeContent::find($request->id);
		$picked->update(
			[
                'heading'     => $request->heading,
                'title'       => $request->title,
				'description' => $request->description
			]
		);
		return redirect()->back()->with('success', 'Content Updated Successfully.');
	}

	public function ckEditorImageUpload(Request $request) {
		$image_path = $request->upload->store('editor-Images');
		$data = CkEditorImage::create(
			[
				'image' => $image_path
			]
		);
		$image_url = url('public/storage').'/'.$data->image;
		return response()->json(
			[
				'url' => $image_url
			]
		);

	}

    public function sendEmail(Request $request) {
        $request->validate(
            [
                'id'      => 'required',
                'subject' => 'required|max:150',
                'message' => 'required'
            ]
        );
        $picked = User::find($request->id);
        // Get Forgot Email Template
        $_template = EmailTemplate::where('code', 'SENDEMAILBYADMIN-1678')->where('status', 'Yes')->first();
        if($_template) {
            $button_temp = null;
            if($_template->button) {
                $link        = url('');  
                $buttn_var   = array('#LINK' => $link);
                $button_temp = $this->modifyTemplateButton($_template->button_html, $buttn_var);
            }
            $replacetemplate = Array(
                '#NAME'     => $picked->name,
                '#CONTENT'  => $request->message,
                '#BUTTON'   => $button_temp
            );
            $check = $this->__sendEmail($picked, $_template->template, $request->subject, $_template->image, $replacetemplate);
            if($check) {
                $this->createEmailHistory($picked->id, $request->subject, $request->message, null, 'Success');
                return redirect()->back()->with('success', 'Email Successfully Send To User.');
            }else {
                $this->createEmailHistory($picked->id, $request->subject, $request->message, null, 'Failed');
                return redirect()->back()->with('error', 'Email Sending Failed.');
            }
        }
    }

    public function sendSMS(Request $request) {
        $request->validate(
            [
                'id'  => 'required',
                'sms' => 'required'
            ]
        );
        $picked = User::find($request->id);
        $message = $request->sms." %0aThank You.,%0aWeb Mingo IT Solutions Pvt. Ltd.%0aVisit: https://www.webmingo.in%0aWhatsApp: 7499366724";
        $check = $this->sendGlobalSMS($message, $picked->mobile_number);
        if($check) {
            $this->createSmsHistory($picked->id, $message, 'Success');
            return redirect()->back()->with('success', 'SMS Successfully Send To User.');
        }else {
            $this->createSmsHistory($picked->id, $message, 'Failed');
            return redirect()->back()->with('error', 'SMS Sending Failed.');
        }
    }

    public function updatePassword(Request $request) {
        $msg = [
            'old_pass.required' => 'Enter Your Old Password',
            'password.required' => 'Enter Your New Password',
            'password.confirmed' => 'Password does not matched.',
            'password_confirmation.required' => 'Enter Your Confirm Pasword',
        ];
        $this->validate($request, [
            'old_pass' => 'required',
            'password' => 'required|min:3|max:8|confirmed',
            'password_confirmation' => 'required| min:3'
        ], $msg);
        $picked = User::find($request->user_id);
        if(\Hash::check($request->old_pass, $picked->password)){
            $picked->update(
                [
                    'password' => \Hash::make($request->password)
                ]
            );
            if(\Auth::user()->role == 'admin') {
                $_template = EmailTemplate::where('code', 'UPDATEPASSWORD-7541')->where('status', 'Yes')->first();
                if($_template) {
                    $button_temp = null;
                    if($_template->button) {
                        $link        = url('');  
                        $buttn_var   = array('#LINK' => $link);
                        $button_temp = $this->modifyTemplateButton($_template->button_html, $buttn_var);
                    }
                    $replacetemplate = Array(
                        '#NAME'     => $picked->name,
                        '#PASSWORD'  => $request->password,
                        '#BUTTON'   => $button_temp
                    );
                    $check = $this->__sendEmail($picked, $_template->template, $_template->subject, $_template->image, $replacetemplate);
                }
                $this->createPasswordHistory($request->user_id, \Auth::id(), 'Update Password');
            }
            return redirect()->back()->with('success',"Password Updated Successfully. !!!" );
        }
        else{
            return redirect()->back()->with('error',"Old Password Not Matched !!!" );
        }
    }

    /**
     * About Section Data
     *
     * @return \Illuminate\Http\Response
     */
    public function manageAbout() {
        $about = About::first();
        return view('admin.settings.about_us', compact('about'));
    }

    public function updateAbout(Request $request) {
        $request->validate(
            [
                'heading'         => 'required|max:100',
                'title'           => 'required|max:200',
                'image_one'       => 'nullable|mimes:jpg,png,jpeg,svg',
                'description_one' => 'required',
                'image_two'       => 'nullable|mimes:jpg,png,jpeg,svg',
                'description_two' => 'required',
                'food_items'      => 'required|integer',
                'clients_daily'   => 'required|integer',
                'experience'      => 'required|integer',
                'fresh_halal'     => 'required|integer',
            ]
        );
        $picked = About::find($request->id);
        if($request->has('image_one')) {
            $one_image_url = $request->image_one->store('about');
            Storage::delete($picked->section_one_image);
        }else {
            $one_image_url = $picked->section_one_image;
        }

        if($request->has('image_two')) {
            $two_image_url = $request->image_two->store('about');
            Storage::delete($picked->section_two_image);
        }else {
            $two_image_url = $picked->section_two_image;
        }
        $picked->update(
            [
                'heading'                  => $request->heading,
                'title'                    => $request->title,
                'tag_one'                  => $request->tag_one,
                'tag_two'                  => $request->tag_two,
                'section_one_image'        => $one_image_url,
                'section_one_description'  => $request->description_one,
                'section_two_image'        => $two_image_url,
                'section_two_description'  => $request->description_two,
                'food_items'               => $request->food_items,
                'clients_daily'            => $request->clients_daily,
                'years_of_experience'      => $request->experience,
                'fresh_halal'              => $request->fresh_halal,
            ]
        );
        return redirect()->back()->with('success', 'About Content Updated Successfully.');
    }

    /**
     * Manage Home Page Content Settings
     *
     * @return \Illuminate\Http\Response
     */
    public function homePageSettings() {
        $categories      = Category::where('parent_id', null)->get();
        $s_category      = HomePageContentSetting::where('slug', 'category')->first();
        $best_dish       = HomePageContentSetting::where('slug', 'best_dish')->first();
        $popular_dishes  = HomePageContentSetting::where('slug', 'popular_foods')->first();
        $testimonial     = HomePageContentSetting::where('slug', 'testimonial')->first();
        $online          = HomePageContentSetting::where('slug', 'online')->first();
        $gallery         = HomePageContentSetting::where('slug', 'gallery')->first();
        $contact         = HomePageContentSetting::where('slug', 'contact')->first();
        $food_items = FoodItem::where('status', 'Yes')->get();
        return view('admin.settings.home_page_content_settings', compact('categories', 's_category', 'best_dish', 'food_items', 'popular_dishes', 'testimonial', 'online', 'gallery', 'contact'));
    }

    public function updateHomeCategories(Request $request) {
        $request->validate(
            [
                'cat_slug_id' => 'required|integer',
                'category.*'  => 'required'
            ]
        );
        if(count($request->category) > 3) {
            return redirect()->back()->with('warning', 'Please do not select more than 3 categories at a time.');
        }
        $picked = HomePageContentSetting::find($request->cat_slug_id);
        $picked->update(
            [
                'ids' => implode(',', $request->category)
            ]
        );
        return redirect()->back()->with('success', 'Categories Updated Successfully.');
    }

    public function updateHomeBestFood(Request $request) {
        $request->validate(
            [
                'best_dish_id' => 'required|integer',
                'food_id'      => 'required|integer',
                'heading'      => 'required|max:150',
                'title'        => 'required|max:500',
                'image'        => 'nullable|mimes:png'
            ]
        );
        $picked = HomePageContentSetting::find($request->best_dish_id);
        if($request->has('image')){
            $image_url = $request->image->store('categories');
            Storage::delete($picked->image);
        }else {
            $image_url = $picked->image;
        }
        $picked->update(
            [
                'heading' => $request->heading,
                'title'   => $request->title,
                'ids'     => $request->food_id,
                'image'   => $image_url
            ]
        );
        return redirect()->back()->with('success', 'Best Food Updated Successfully.');
    }

    public function updatePopularFoods(Request $request) {
        $request->validate(
            [
                'popular_dish_id'=> 'required|integer',
                'dishes.*'       => 'required',
                'heading'        => 'required|max:150',
                'title'          => 'required|max:500',
            ]
        );
        if(count($request->dishes) > 6) {
            return redirect()->back()->with('warning', 'Please do not select more than 6 food items at a time.');
        }
        $picked = HomePageContentSetting::find($request->popular_dish_id);
        $picked->update(
            [
                'heading' => $request->heading,
                'title'   => $request->title,
                'ids'     => implode(',', $request->dishes)
            ]
        );
        return redirect()->back()->with('success', 'Food Items Updated Successfully.');
    }

    public function updateHomePageTestimonial(Request $request) {
        $request->validate(
            [
                'testimonial_id' => 'required|integer',
                'heading'        => 'required|max:150',
                'title'          => 'required|max:500',
                'image'          => 'nullable|mimes:png,jpg,jpeg,svg'
            ]
        );
        $picked = HomePageContentSetting::find($request->testimonial_id);
        if($request->has('image')){
            $image_url = $request->image->store('feedbacks');
            Storage::delete($picked->image);
        }else {
            $image_url = $picked->image;
        }
        $picked->update(
            [
                'heading' => $request->heading,
                'title'   => $request->title,
                'image'   => $image_url
            ]
        );
        return redirect()->back()->with('success', 'Testimonial Updated Successfully.');
    }

    public function updateHomePageOnlineSection(Request $request) {
        $request->validate(
            [
                'online_id'   => 'required|integer',
                'heading'     => 'required|max:150',
                'title'       => 'required|max:500',
                'description' => 'required|max:500',
                'image'       => 'nullable|mimes:png,jpg,jpeg,svg'
            ]
        );
        $picked = HomePageContentSetting::find($request->online_id);
        if($request->has('image')){
            $image_url = $request->image->store('feedbacks');
            Storage::delete($picked->image);
        }else {
            $image_url = $picked->image;
        }
        $picked->update(
            [
                'heading'     => $request->heading,
                'title'       => $request->title,
                'image'       => $image_url,
                'description' => $request->description
            ]
        );
        return redirect()->back()->with('success', 'Online Section Updated Successfully.');
    }

    public function updateGalleryContent(Request $request) {
        $request->validate(
            [
                'gallery_id'  => 'required|integer',
                'heading'     => 'required|max:150',
                'title'       => 'required|max:500',
            ]
        );
        $picked = HomePageContentSetting::find($request->gallery_id);
        $picked->update(
            [
                'heading'     => $request->heading,
                'title'       => $request->title
            ]
        );
        return redirect()->back()->with('success', 'Gallery Header Content Updated Successfully.');
    }

    public function updateContactContent(Request $request) {
        $request->validate(
            [
                'contact_id'  => 'required|integer',
                'heading'     => 'required|max:150',
                'title'       => 'required|max:500',
                'office_time' => 'required|string|max:150',
                'map_link'    => 'required|url'
            ]
        );
        $picked = HomePageContentSetting::find($request->contact_id);
        $picked->update(
            [
                'heading'     => $request->heading,
                'title'       => $request->title,
                'image'       => $request->office_time,
                'description' => $request->map_link,
            ]
        );
        return redirect()->back()->with('success', 'Gallery Header Content Updated Successfully.');
    }
}
