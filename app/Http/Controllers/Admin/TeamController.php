<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\SmsHistory;
use App\Models\EmailHistory;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class TeamController extends Controller
{
    use GlobalTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   if ($request->ajax()) {
            $users = User::where('role', 'team')->orderBy('id', 'DESC')->get();
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
                    return $this->convertDateTime($row->created_at);
                })
                ->addColumn('profile', function($row){
                    if (Storage::exists($row->profile_photo)) 
                        $image = '<div class="d-flex align-items-center">
                                      <div class="avatar rounded">
                                        <div class="avatar-content">
                                          <img src="'.url('public/storage').'/'.$row->profile_photo.'">
                                        </div>
                                      </div>
                                      <div>
                                        <div class="font-weight-bolder">'.$row->name.'</div>
                                        <div class="font-small-2 text-muted">'.$row->email.'</div>
                                      </div>
                                </div>';
                    else
                        $image = '<div class="d-flex align-items-center">
                                  <div class="avatar rounded">
                                    <div class="avatar-content">
                                      <img src="'.url('public').'/admin/images/dummy-user.jpg">
                                    </div>
                                  </div>
                                  <div>
                                    <div class="font-weight-bolder">'.$row->name.'</div>
                                        <div class="font-small-2 text-muted">'.$row->email.'</div>
                                  </div>
                                </div>';
                    return $image;
                })
                ->addColumn('total_deliveries', function($row){
                    return 0;
                })
                ->addColumn('state', function($row){
                    $state = State::find($row->state_id);
                    return  $state ? $state->name : '';
                })
                ->addColumn('city', function($row){
                    $city = City::find($row->city_id);
                    return  $city ? $city->name : '';
                })
                ->addColumn('status', function($row){
                    if($row->user_status == 'active') 
                        $status = '<span class="text-info">Active</span><div class="modal fade" id="feedback'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle" aria-hidden="true">';
                    else
                        $status = '<span class="text-danger">Blocked</span><div class="modal fade" id="feedback'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle" aria-hidden="true">';
                    return $status;
                })
                ->addColumn('action', function($row){
                    $documents = [];
                    if(count($row->getDocuments) > 0){
                        foreach ($row->getDocuments as $key => $value) {
                            $extension = pathinfo(storage_path('/storage'.'/'.$value->image), PATHINFO_EXTENSION);
                            if($extension == 'pdf'){
                                $doc_html = '<div class="col-md-3">
                                            <div class="documents-list">
                                              <a href="'.url('public/storage').'/'.$value->image.'" target="_blank">
                                                <img src="'.url('public/images/pdf.png').'" alt="">
                                                <h4>'.$value->name.'</h4>
                                              </a>
                                            </div>
                                          </div>';
                            }else {
                                $doc_html = '<div class="col-md-3">
                                            <div class="documents-list">
                                              <a href="'.url('public/storage').'/'.$value->image.'" target="_blank">
                                                <img src="'.url('public/storage').'/'.$value->image.'" alt="">
                                                <h4>'.$value->name.'</h4>
                                              </a>
                                            </div>
                                          </div>';
                            }
                            
                            array_push($documents, $doc_html);
                        }
                    }else {
                        $doc_html = '<div class="col-md-3">
                                            <div class="documents-list">
                                              <p>No any documents found.</p>
                                            </div>
                                          </div>';
                        array_push($documents, $doc_html);
                    }
                    $action = '
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm-custom action-btn-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="'.url('admin/team').'/'.$row->id.'">View Team</a>
                              <a class="dropdown-item" href="'.url('admin/team').'/'.$row->id.'/edit">Edit Team</a>
                              <a class="dropdown-item" href="javascript:void(0)" onclick="sendSMS('.$row->id.')">Send SMS</a>
                              <a class="dropdown-item" href="javascript:void(0)" onclick="sendEmail('.$row->id.')">Send Email</a>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#documents'.$row->id.'">View All Documents</a>
                              <a class="dropdown-item" href="javascript:void(0)" onclick="updatePassword('.$row->id.')">Change Password</a>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light" onclick="deleteTeam('.$row->id.')"><i class="far fa-trash-alt"></i></a>
                            <div class="modal fade" id="documents'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="documentsTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="documentsTitle">View All Documents</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          '.implode(',', $documents).'
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                      </td>';
                    return $action;
                })
                ->rawColumns(['action', 'profile', 'status'])
                ->make(true);
        }
        return view('admin.team.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::orderBy('name', 'ASC')->get();
        return view('admin.team.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'                  => 'required|max:150',
                'gender'                => 'required',
                'dob'                   => 'required|date',
                'name'                  => 'required|max:150',
                'mobile_number'         => 'required|integer|digits:10|unique:users,mobile_number',
                'email'                 => 'required|email|unique:users',
                'address'               => 'required|max:200',
                'country'               => 'required|integer',
                'state'                 => 'required|integer',
                'city'                  => 'required|integer',
                'password'              => 'required|min:3|confirmed',
                'password_confirmation' => 'required|min:3',
                'document_name.*'       => 'nullable|max:150',
                'file.*'                => 'nullable|mimes:jpg,jpeg,png,svg,pdf',
                'image'                 => 'nullable|mimes:jpg,jpeg,png,svg',
            ]
        );
        $pass = $request->password;
        $c_name = strtoupper(substr($request->name, 0, 3));
        $c_num  = rand(1000, 9999);
        $year   = date('Y');
        $branch_id = 'TM'.$c_name.$c_num.$year;
        $profile_url = $request->has('image') ? $request->image->store('profile') : null;
        $user = User::create(
            [
                'role'             => 'team',
                'profile_photo'    => $profile_url,
                'dob'              => $request->dob,
                'gender'           => $request->gender,
                'username'         => $branch_id,
                'name'             => $request->name,
                'email'            => $request->email,
                'mobile_number'    => $request->mobile_number,
                'address'          => $request->address,
                'country_id'       => $request->country,
                'state_id'         => $request->state,
                'city_id'          => $request->city,
                'password'         => \Hash::make($request->password),
            ]
        );
        if($request->has('file')) {
            if(count($request->file) > 0) {
                for ($i = 0; $i < count($request->file); $i++) { 
                    $image_url = $request->file[$i]->store('documents');
                    UserDocument::create(
                        [
                            'user_id'  => $user->id,
                            'name'     => $request->document_name[$i],
                            'image'    => $image_url
                        ]
                    );
                }
            }
        }
        // Send Welcome Mail
        $_template = EmailTemplate::where('code', 'TEAMREGISTRATION-4284')->where('status', 'Yes')->first();
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
        return redirect('admin/team')->with('success', 'Team Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(['getDocuments'])->find($id);
        return view('admin.team.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with(['getDocuments'])->find($id);
        $countries = Country::orderBy('name', 'ASC')->get();
        $states = State::where('country_id', $user->country_id)->orderBy('name', 'ASC')->get();
        $cities = City::where('state_id', $user->state_id)->orderBy('name', 'ASC')->get();
        return view('admin.team.edit', compact('user', 'countries', 'states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name'                  => 'required|max:150',
                'gender'                => 'required',
                'dob'                   => 'required|date',
                'name'                  => 'required|max:150',
                'mobile_number'         => 'required|integer|digits:10|unique:users,mobile_number',
                'email'                 => 'required|email|unique:users',
                'address'               => 'required|max:200',
                'country'               => 'required|integer',
                'state'                 => 'required|integer',
                'city'                  => 'required|integer',
                'document_name.*'       => 'nullable|max:150',
                'file.*'                => 'nullable|mimes:jpg,jpeg,png,svg,pdf',
                'image'                 => 'nullable|mimes:jpg,jpeg,png,svg',
            ]
        );
        $picked = User::find($id);
        $old_email  = $picked->email;
        $old_mobile = $picked->mobile_number;
        if($request->image) {
            $profile_url = $request->image->store('profile');
            Storage::delete($picked->profile_photo);
        }else {
            $profile_url = $picked->profile_photo;
        }
        $picked->update(
            [
                'profile_photo'    => $profile_url,
                'dob'              => $request->dob,
                'gender'           => $request->gender,
                'name'             => $request->name,
                'email'            => $request->email,
                'mobile_number'    => $request->mobile_number,
                'address'          => $request->address,
                'country_id'       => $request->country,
                'state_id'         => $request->state,
                'city_id'          => $request->city,
            ]
        );
        if($request->has('file')) {
            if(count($request->file) > 0) {
                for ($i = 0; $i < count($request->file); $i++) { 
                    $image_url = $request->file[$i]->store('documents');
                    UserDocument::create(
                        [
                            'user_id'  => $picked->id,
                            'name'     => $request->document_name[$i],
                            'image'    => $image_url
                        ]
                    );
                }
            }
        }
        if($picked->email != $old_email){
            $_template = EmailTemplate::where('code', 'EMAILUPDATED-4516')->where('status', 'Yes')->first();
            if($_template) {
                $button_temp = null;
                if($_template->button) {
                    $link        = url('');  
                    $buttn_var   = array('#LINK' => $link);
                    $button_temp = $this->modifyTemplateButton($_template->button_html, $buttn_var);
                }
                $replacetemplate = Array(
                    '#NAME'     => $picked->name,
                    '#EMAIL'    => $picked->email,
                    '#BUTTON'   => $button_temp
                );
                $this->__sendEmail($picked, $_template->template, $_template->subject, $_template->image, $replacetemplate);
            }
        }
        if($picked->mobile_number != $old_mobile){
            $_template = EmailTemplate::where('code', 'MOBILENUMBERUPDATE-2612')->where('status', 'Yes')->first();
            if($_template) {
                $button_temp = null;
                if($_template->button) {
                    $link        = url('');  
                    $buttn_var   = array('#LINK' => $link);
                    $button_temp = $this->modifyTemplateButton($_template->button_html, $buttn_var);
                }
                $replacetemplate = Array(
                    '#NAME'     => $picked->name,
                    '#MOBILE'   => $picked->mobile_number,
                );
                $this->__sendEmail($picked, $_template->template, $_template->subject, $_template->image, $replacetemplate);
            }
        }
       
        return redirect('admin/team')->with('success', 'Team Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $picked = User::find($id);
            $picked->delete();
            return $this->success('User Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    public function sendSMSView($id) {
        $user = User::with(
            [
                'getSmsHistory' => function($q) {
                    $q->orderBy('id', 'DESC');
                }
            ])->find(base64_decode($id));
        return view('admin.branch.sms', compact('user'));
    }

    public function sendEmailView($id) {
        $user = User::with(
            [
                'getEmailHistory' => function($q) {
                    $q->orderBy('id', 'DESC');
                }
            ])->find(base64_decode($id));
        return view('admin.branch.email', compact('user'));
    }

    public function updatePasswordViewView($id) {
        $user = User::with(
            [
                'getPasswordHistory' => function($q) {
                    $q->orderBy('id', 'DESC');
                }
            ])->find(base64_decode($id));
        return view('admin.branch.update-password', compact('user'));
    }
}
