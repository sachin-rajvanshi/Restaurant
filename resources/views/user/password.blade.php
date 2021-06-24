@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Change Password</h1>
           <p>{{ \Auth::user()->about_me }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Change Password</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="custom-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          @include('user.sidebar')
        </div>
        <div class="col-md-8">
          <div class="dashbaord-block-right">
            <div class="dashbaord-header">
              <h3>Change Password</h3>
            </div>
            <div class="inner-block">
              <div class="dash-form-blk">
                <form class="form-contact contact_form" action="{{ url('update/password') }}" method="post">
                	@csrf
					<div class="row">
						<div class="col-sm-12">
						  <div class="form-group">
						    <input class="form-control" name="old_passowrd" type="password" placeholder="Enter Old Password" required="">
						  </div>
						</div>
						<div class="col-sm-12">
						  <div class="form-group">
						    <input class="form-control" name="password" type="password" placeholder="Enter New Password" required="">
						  </div>
						</div>
						<div class="col-sm-12">
						  <div class="form-group">
						    <input class="form-control" name="password_confirmation" type="password" placeholder="Enter Old Password" required="">
						  </div>
						</div>
						</div>
						<div class="form-group">
						<button type="submit" class="btn main-btn">Update Password</button>
					</div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection