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
                <li class="breadcrumb-item active">Team member</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/team') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="branch-buttons">
                <a href="{{ url('admin/team') }}/{{ $user->id }}/edit" class="btn btn-primary waves-effect waves-float waves-light">Edit Team</a>
                <a href="{{ url('admin/send/sms/view') }}/{{ base64_encode($user->id) }}" class="btn btn-dark waves-effect waves-float waves-light">Send SMS</a>
                <a href="{{ url('admin/send/email/view') }}/{{ base64_encode($user->id) }}" class="btn btn-dark waves-effect waves-float waves-light">Send Email</a>
                <a href="#" class="btn btn-success waves-effect waves-float waves-light">View All Deliveries</a>
                <a href="{{ url('admin/branch/update/password') }}/{{ base64_encode($user->id) }}" class="btn btn-info waves-effect waves-float waves-light">Change Password</a>
              </div>
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
                <li><b>Mobile Number:</b> <span>{{ $user->mobile_number }}</span></li>
                <li><b>Email Id:</b> <span>{{ $user->email }}</span></li>
                <li><b>DOB:</b> <span>{{ date('d M Y', strtotime($user->dob)) }}</span></li>
                <li><b>Gender:</b> <span>{{ $user->gender }}</span></li>
                <li><b>Address:</b> <span>{{ $user->address }}, {{ $user->getCity ? $user->getCity->name : 'N/A' }}, {{ $user->getState ? $user->getState->name : 'N/A' }}, {{ $user->getCountry ? $user->getCountry->name : 'N/A' }}</span></li>
                <li><b>ID:</b> <span>{{ $user->username }}</span></li>
              </ul>
            </div>
          </div>
          
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">{{ $user->name }} Documents</h4>
            </div>
            <div class="card-body">
              <div class="branch-documents">
                <div class="row">
                  @if(count($user->getDocuments) > 0)	
                  	@foreach($user->getDocuments as $document)
                    @php
                      $extension = pathinfo(storage_path('/storage/'.$document->image), PATHINFO_EXTENSION);
                    @endphp
                  		<div class="col-md-3">
  		                    <div class="documents-list">
  		                      	@if(Storage::exists($document->image))
                                @if($extension == 'pdf')
    			                      	<a href="{{ asset('storage') }}/{{ $document->image }}" target="_blank">
    			                      		<img src="{{ asset('') }}/images/pdf.png" alt="">
    			                        	<h4>{{ $document->name }}</h4>
    			                      	</a>
                                @else
                                  <a href="{{ asset('storage') }}/{{ $document->image }}" target="_blank">
                                    <img src="{{ asset('storage') }}/{{ $document->image }}" alt="">
                                    <h4>{{ $document->name }}</h4>
                                  </a>
                                @endif
  			                      @else
  			                    	  <a href="{{ asset('storage') }}/{{ $document->image }}" target="_blank">
  			                      		<img src="{{ asset('') }}/admin/images/dummy.jpg" alt="">
  			                        	<h4>{{ $document->name }}</h4>
  			                      	</a>
  		                      	@endif
  		                    </div>
  		                </div>
                  	@endforeach
                  @else
                  	<center><b>No any document uploaded.</b></center>
                  @endif 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('page-scripts')

@endsection