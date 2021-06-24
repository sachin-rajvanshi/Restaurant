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
                <li class="breadcrumb-item"><a href="ecommerce-dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Change Password</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Change Password</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('update/password') }}" method="POST">
		        @csrf
		        @method('PUT')
		        <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Old Password</label>
                      <input type="password" class="form-control" name="old_pass" placeholder="Old Password" required="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>New Password</label>
                      <input type="password" class="form-control" name="password" placeholder="New Password" required="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Change Password</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Change Password History</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th width="200">Date & Time</th>
                      <th> Event Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(count($user->getPasswordHistory) > 0)
                  	@foreach($user->getPasswordHistory as $h => $history)
	                    <tr>
	                      <td width="50">#{{ $h+1 }}</td>
	                      <td>{{ App\Helper\Helper::convertDateTime($history->created_at) }}</td>
	                      <td>
	                      	@if($history->perform_by)
	                      		{{ $history->event }} By {{ $history->getUser($history->perform_by) ? ucfirst($history->getUser($history->perform_by)->role) : null  }}
	                      	@else
	                      		{{ $history->event }} 
	                      	@endif
	                      </td>
	                    </tr>
	                @endforeach
                    @else
                    	<tr><td colspan="10" align="center">No any record found.</td></tr>
                    @endif
                  </tbody>
                </table>
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