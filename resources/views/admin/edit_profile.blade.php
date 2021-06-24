@extends('layout.admin.main')

@section('content')

<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Account Setting</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.profile') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">View Profile</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section id="page-account-settings">
        <div class="row">
          <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column nav-left">
              <li class="nav-item">
                <a class="nav-link @if(session()->get('type') == 'Personal') active @elseif(session()->get('type') == null) active  @endif" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                  <i data-feather="user" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">General</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link @if(session()->get('type') == 'Info') active  @endif" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                  <i data-feather="info" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">Information</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link @if(session()->get('type') == 'password') active  @endif" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                  <i data-feather="lock" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">Change Password</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link @if(session()->get('type') == 'social') active  @endif" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" aria-expanded="false">
                  <i data-feather="link" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">Social</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                  <i data-feather="bell" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">Notifications</span>
                </a>
              </li>
            </ul>
          </div>
          
          <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane @if(session()->get('type') == 'Personal') active @elseif(session()->get('type') == null) active  @endif" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                    <form class="validate-form" method="post" action="{{ route('admin.update.profile') }}" enctype="multipart/form-data">
                    @csrf
                      <div class="row">
                        <div class="col-12 col-md-2">
                          <div class="form-group">
                            <label>Change Profile Picture</label>
                            <div class="custom-img-uploader">
                              <div class="input-group">
                                <span class="input-group-btn">
                                  <span class="btn-file">
                                    <input type="file" id="imgSec" name="file">
                                    	@if (Storage::exists(\Auth::user()->profile_photo)) 
	                                        <img id='upload-img' src="{{ asset('storage/'.\Auth::user()->profile_photo) }}" class="img-upload-block">
	                                    @else
	                                      	<img id='upload-img' src="{{ asset('') }}/admin/images/dummy-user.jpg" class="img-upload-block">
	                                    @endif
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label for="account-username">Username</label>
                            <input type="text" class="form-control" id="account-username" name="username" placeholder="Username" value="{{ \Auth::user()->username }}" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-name">Name</label>
                            <input type="text" class="form-control" id="account-name" name="name" placeholder="Name" value="{{ \Auth::user()->name }}" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-e-mail">Email Id</label>
                            <input type="email" class="form-control" id="account-e-mail" name="email" placeholder="Email" value="{{ \Auth::user()->email }}" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-company">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value="{{ \Auth::user()->mobile_number }}" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-company">Company</label>
                            <input type="text" class="form-control" id="company" name="company" placeholder="Company name" value="{{ \Auth::user()->company_name }}" />
                          </div>
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  
                  <div class="tab-pane @if(session()->get('type') == 'Info') active  @endif" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                    <form class="validate-form" method="post" action="{{ route('admin.updateInfo.profile') }}">
                    @csrf
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="accountTextarea">Bio</label>
                            <textarea class="form-control" id="about_me" name="about_me" rows="4" placeholder="Your Bio data here...">{{ \Auth::user()->about_me }}</textarea>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-birth-date">Birth date</label>
                            <input type="date" class="form-control flatpickr" placeholder="Birth date" id="account-birth-date" name="dob" value="{{ \Auth::user()->dob }}" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-website">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address"  value="{{ \Auth::user()->address }}" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-website">Website</label>
                            <input type="text" class="form-control" name="website" id="account-website" placeholder="Website address" value="{{ \Auth::user()->website }}" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-phone">Phone</label>
                            <input type="text" class="form-control" id="account-phone" placeholder="Phone number" name="phone" value="{{ \Auth::user()->phone_number }}" />
                          </div>
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary mt-1 mr-1">Save changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  
                  <div class="tab-pane @if(session()->get('type') == 'password') active  @endif" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                    <form class="validate-form" method="post" action="{{ route('admin.updatePassword.profile') }}">
                    @csrf
                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-old-password">Old Password</label>
                            <input type="password" class="form-control" name="old_passowrd" placeholder="Old Password" required="" />
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-new-password">New Password</label>
                            <input type="password" name="password" class="form-control" placeholder="New Password" required="" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-retype-new-password">Retype New Password</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="New Password" required="" />
                          </div>
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary mr-1 mt-1">Update Password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                 
                  <div class="tab-pane @if(session()->get('type') == 'social') active  @endif" id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                    <form class="validate-form" method="post" action="{{ route('admin.updateSocialLinks.profile') }}">
                    @csrf
                      <div class="row">
                        <div class="col-12">
                          <div class="d-flex align-items-center mb-2">
                            <i data-feather="link" class="font-medium-3"></i>
                            <h4 class="mb-0 ml-75">Social Links</h4>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control" placeholder="Add link" name="facebook" value="{{ \Auth::user()->facebook }}" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" class="form-control" placeholder="Add link" name="twitter" value="{{ \Auth::user()->twitter }}" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label>LinkedIn</label>
                            <input type="text" class="form-control" placeholder="Add link" name="linkedin" value="{{ \Auth::user()->linkedin }}" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" class="form-control" placeholder="Add link" name="youtube" value="{{ \Auth::user()->youtube }}" />
                          </div>
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  
                  <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                    <div class="row">
                      <h6 class="section-label mx-1 mb-2">Activity</h6>
                      <div class="col-12 mb-2">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" checked id="accountSwitch1" />
                          <label class="custom-control-label" for="accountSwitch1">
                            Email me when someone registared on website
                          </label>
                        </div>
                      </div>
                      <div class="col-12 mb-2">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" checked id="accountSwitch2" />
                          <label class="custom-control-label" for="accountSwitch2">
                            Email me when someone buy order
                          </label>
                        </div>
                      </div>
                      <div class="col-12 mb-2">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="accountSwitch3" />
                          <label class="custom-control-label" for="accountSwitch3">Email me when someone cancel order</label>
                        </div>
                      </div>
                      <h6 class="section-label mx-1 mt-2">Application</h6>
                      <div class="col-12 mt-1 mb-2">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" checked id="accountSwitch4" />
                          <label class="custom-control-label" for="accountSwitch4">News and announcements</label>
                        </div>
                      </div>
                      <div class="col-12 mb-2">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" checked id="accountSwitch6" />
                          <label class="custom-control-label" for="accountSwitch6">Weekly product updates</label>
                        </div>
                      </div>
                      <div class="col-12 mb-75">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="accountSwitch5" />
                          <label class="custom-control-label" for="accountSwitch5">Weekly blog update</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

@endsection