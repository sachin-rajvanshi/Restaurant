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
                <li class="breadcrumb-item active">My Profile</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.edit.profile') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Edit Profile</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">My Profile</h4>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="profile-pic">
              	@if (Storage::exists($user->profile_photo)) 
                  <img src="{{ asset('storage/'.$user->profile_photo) }}" alt="">
                @else
                	<img src="{{ asset('') }}/admin/images/dummy-user.jpg" alt="">
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <ul class="profile-content">
                <li><b>Name:</b> <span>{{ $user->name }}</span></li>
                <li><b>Mobile Number:</b> <span>+91 {{ $user->mobile_number }}</span></li>
                <li><b>Phone Number:</b> <span>{{ $user->phone_number }}</span></li>
                <li><b>Email Id:</b> <span>{{ $user->email }}</span></li>
                <li><b>DOB:</b> <span>{{ date('d M Y', strtotime($user->dob)) }}</span></li>
                <li><b>Address:</b> <span>{{ $user->address }}</span></li>
                <li><b>About Me:</b> <span>{{ $user->about_me }}</span></li>
                <li><b>Website:</b> <span><a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a></span></li>
                <li><b>Facebook:</b> <span><a href="{{ $user->facebook }}" target="_blank">{{ $user->facebook }}</a></span></li>
                <li><b>Twitter:</b> <span><a href="{{ $user->twitter }}" target="_blank">{{ $user->twitter }}</a></span></li>
                <li><b>Youtube:</b> <span><a href="{{ $user->youtube }}" target="_blank">{{ $user->youtube }}</a></span></li>
                <li><b>Linkedin:</b> <span><a href="{{ $user->linkedin }}" target="_blank">{{ $user->linkedin }}</a></span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection