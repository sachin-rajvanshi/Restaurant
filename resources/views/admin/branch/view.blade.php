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
                <li class="breadcrumb-item active">View Branch</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/branch') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
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
                <a href="{{ url('admin/branch') }}/{{ $user->id }}/edit" class="btn btn-primary waves-effect waves-float waves-light">Edit Branch</a>
                <a href="{{ url('admin/send/sms/view') }}/{{ base64_encode($user->id) }}" class="btn btn-dark waves-effect waves-float waves-light">Send SMS</a>
                <a href="{{ url('admin/send/email/view') }}/{{ base64_encode($user->id) }}" class="btn btn-dark waves-effect waves-float waves-light">Send Email</a>
                <a href="view-all-orders.php" class="btn btn-success waves-effect waves-float waves-light">View All Orders</a>
                <a href="{{ url('admin/branch/update/password') }}/{{ base64_encode($user->id) }}" class="btn btn-info waves-effect waves-float waves-light">Change Password</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="branch-block">
                <p class="branchname"><b>Name:</b> <span>{{ $user->name }}</span></p>
                <p><b>Address:</b> <span>{{ $user->address }}, {{ $user->getCountry ? $user->getCountry->name : 'N/A' }}, {{ $user->getState ? $user->getState->name : 'N/A' }}, {{ $user->getCity ? $user->getCity->name : 'N/A' }}</span></p>
                <p><b>Manager:</b> <span>{{ $user->manager_name }}</span></p>
                <p><b>Tel:</b> <span>{{ $user->mobile_number }}</span></p>
                <p><b>Email:</b> <span>{{ $user->email }}</span></p>
                <p><b>Open In:</b> <span>{{ date('d M Y', strtotime($user->date_of_open)) }}</span></p>
                <p><b>ID:</b> <span>{{ $user->username }}</span></p>
              </div>
            </div>
          </div>
          
        </div>
        <div class="col-md-7">
          <div class="card">
            <div class="card-body">
              <div class="branch-Orders">
                <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                    <div class="media">
                      <div class="avatar bg-light-primary mr-2">
                        <div class="avatar-content">
                          <i class="fas fa-satellite-dish"></i>
                        </div>
                      </div>
                      <div class="media-body my-auto">
                        <h4 class="font-weight-bolder mb-0">20</h4>
                        <p class="card-text font-small-3 mb-0">Total Orders</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                    <div class="media">
                      <div class="avatar bg-light-info mr-2">
                        <div class="avatar-content">
                          <i class="fas fa-truck"></i>
                        </div>
                      </div>
                      <div class="media-body my-auto">
                        <h4 class="font-weight-bolder mb-0">40</h4>
                        <p class="card-text font-small-3 mb-0">Delivered Orders</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                    <div class="media">
                      <div class="avatar bg-light-danger mr-2">
                        <div class="avatar-content">
                          <i class="fab fa-audible"></i>
                        </div>
                      </div>
                      <div class="media-body my-auto">
                        <h4 class="font-weight-bolder mb-0">10</h4>
                        <p class="card-text font-small-3 mb-0">Pending Orders</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="media">
                      <div class="avatar bg-light-success mr-2">
                        <div class="avatar-content">
                          <i class="fas fa-dollar-sign"></i>
                        </div>
                      </div>
                      <div class="media-body my-auto">
                        <h4 class="font-weight-bolder mb-0">$ 194875</h4>
                        <p class="card-text font-small-3 mb-0">Total Order Amount</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Branch Documents</h4>
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
			                      		<img src="{{ asset('') }}admin/images/dummy.jpg" alt="">
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