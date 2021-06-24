@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg')  }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Account Setting</h1>
           <p>{{ \Auth::user()->about_me }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Account Setting</li>
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
              <h3>Account Setting</h3>
            </div>
            <div class="inner-block">
              <div class="dash-form-blk">
                <form class="form-contact contact_form" action="{{ route('user.updateProfile') }}" method="post" enctype="multipart/form-data">
                	@csrf
                	@method('PATCH')
	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Name</label>
	                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ \Auth::user()->name }}" required="">
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Mobile Number</label>
	                        <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{ \Auth::user()->mobile_number }}">
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Email Id</label>
	                        <input type="text" class="form-control" placeholder="Email Id" name="email" value="{{ \Auth::user()->email }}">
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Select Gender</label>
	                        <select class="form-select" name="gender" required="">
	                          <option value="">Select Gender</option>
	                          <option value="Male" @if(\Auth::user()->gender == 'Male') selected @endif>Male</option>
	                          <option value="Female" @if(\Auth::user()->gender == 'Female') selected @endif>Female</option>
	                          <option value="Transgender" @if(\Auth::user()->gender == 'Transgender') selected @endif>Transgender</option>
	                        </select>
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Marital Status</label>
	                        <select class="form-select" name="marital_status">
	                          <option value="">Select Status</option>
	                          <option value="Married" @if(\Auth::user()->marital_status == 'Married') selected @endif>Married</option>
	                          <option value="Unmarried" @if(\Auth::user()->marital_status == 'Unmarried') selected @endif>Unmarried</option>
	                        </select>
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Date of Birth</label>
	                        <input type="date" class="form-control" id="datetimepicker2" name="dob" value="{{ \Auth::user()->dob }}">
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Upload Your Profile Picture</label>
	                        <div class="custom-file">
	                          <input type="file" name="image" class="custom-file-input" id="customFile" name="filename">
	                          <label class="custom-file-label" for="customFile">Upload Profile Picture</label>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="col-md-12">
	                      <div class="form-group">
	                        <label>About Me</label>
	                        <textarea class="form-control" cols="30" name="about_me" rows="4" placeholder="About Me">{{ \Auth::user()->about_me }}</textarea>
	                      </div>
	                    </div>
	                    <div class="col-md-12">
	                      <div class="form_btn">
	                        <button class="btn main-btn" type="submit">Update Profile</button>
	                      </div>
	                    </div>
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