@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url(' {{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Career</h1>
           <p>Lorem ipsum dolor sit amet, consecte turn se adipisicing elit, sed do eiusmod tempor ens incididunt ut labore et dolore magna aliqua.</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Career</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="custom-section">
    <div class="container">
      <div class="career-block">
        <form class="form-contact contact_form" action="{{ url('career/enquiry') }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Your Name</label>
                <input class="form-control" name="name" placeholder="Your Name" value="{{ old('name') }}" required="">
                @if($errors->has('name'))
				    <div class="error">{{ $errors->first('name') }}</div>
				@endif
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Contact Number</label>
                <input type="number" class="form-control" name="mobile_number" placeholder="Contact Number" value="{{ old('mobile_number') }}" name="">
                @if($errors->has('mobile_number'))
				    <div class="error">{{ $errors->first('mobile_number') }}</div>
				@endif
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Email Id</label>
                <input type="email" class="form-control" name="email" placeholder="Email Id" value="{{ old('email') }}" required="">
                @if($errors->has('email'))
				    <div class="error">{{ $errors->first('email') }}</div>
				@endif
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" class="form-control" name="dob" placeholder="Date of Birth" value="{{ old('dob') }}" required="">
                @if($errors->has('dob'))
				    <div class="error">{{ $errors->first('dob') }}</div>
				@endif
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Upload Your Photo</label>
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="customFile" name="filename">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                  	@if($errors->has('image'))
				    	<div class="error">{{ $errors->first('image') }}</div>
					@endif
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Gender</label>
                <select class="form-select" name="gender" required="">
                  <option value="">Select Gender</option>
                  <option value="Male" @if(old('gender') == 'Male') selected="" @endif>Male</option>
                  <option value="Female" @if(old('gender') == 'Female') selected="" @endif>Female</option>
                </select>
                @if($errors->has('gender'))
				    <div class="error">{{ $errors->first('gender') }}</div>
				@endif
              </div>
            </div>
            <div class="col-md-4">
            	<div class="form-group">
                <label>Select Country</label>
                <select class="form-control" name="country" id="country" onchange="getState()" required="">
                  <option value="">Select Country</option>
                  @foreach($countries as $country)
                  	@if(old('country') == $country->id)
                  		<option value="{{ $country->id }}" selected="">{{ $country->name }}</option>
                  	@else
                  		<option value="{{ $country->id }}">{{ $country->name }}</option>
                  	@endif
                  @endforeach()
                </select>
				@if($errors->has('country'))
				    <div class="error">{{ $errors->first('country') }}</div>
				@endif
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Select State</label>
                <select class="form-control" name="state" id="state" onchange="getCity()" required="">
                  
                </select>
				@if($errors->has('state'))
				    <div class="error">{{ $errors->first('state') }}</div>
				@endif
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>City</label>
                <select class="form-control" name="city" id="city" required="">
                  
                </select>
				@if($errors->has('city'))
				    <div class="error">{{ $errors->first('city') }}</div>
				@endif
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}" required="">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Select Post</label>
                <select class="form-control" name="post"  required="">
                  <option value="">Select Post</option>
                  @foreach($posts as $post)
                  	<option value="{{ $post->id }}" @if(old('post') == $post->id) selected="" @endif>{{ $post->name }}</option>
                  @endforeach
                </select>
                @if($errors->has('post'))
				    <div class="error">{{ $errors->first('post') }}</div>
				@endif
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Upload CV / Resume</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="cv" id="customFile" name="filename" required="">
                  <label class="custom-file-label" for="customFile">Choose file</label>
					@if($errors->has('cv'))
						<div class="error">{{ $errors->first('cv') }}</div>
					@endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Your Message</label>
                <textarea class="form-control" name="message" placeholder="Your Message">{{ old('message') }}</textarea>
                @if($errors->has('message'))
				    <div class="error">{{ $errors->first('message') }}</div>
				@endif
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn main-btn">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

@if($errors->any())
<script type="text/javascript">
	setTimeout(function() {
		getState('{{ old('country') }}');
		getCity('{{ old('state') }}');
	}, 2000);
</script>
@endif
@endsection
@section('front-scripts')

@endsection