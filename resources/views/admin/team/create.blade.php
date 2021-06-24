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
                <li class="breadcrumb-item active">Add Team Member</li>
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
            <div class="card-header">
              <h4 class="card-title">Add Team Member</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/team') }}" method="POST" enctype="multipart/form-data">
              	@csrf
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload Image</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="image" id="imgSec">
                              <img id='upload-img' class="img-upload-block" src="{{ asset('') }}/admin/images/plus-upload.jpg"/>
                                @if($errors->has('image'))
								    <div class="error">{{ $errors->first('image') }}</div>
								@endif
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" class="form-control" placeholder="Branch Name" name="name" value="{{ old('name') }}" required="" />
                       	@if($errors->has('name'))
  						    <div class="error">{{ $errors->first('name') }}</div>
  						@endif
                    </div>
                    <div class="form-group">
                      <label>Mobile Number</label>
                      <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{ old('mobile_number') }}" required="" />
                        @if($errors->has('mobile_number'))
  						    <div class="error">{{ $errors->first('mobile_number') }}</div>
  						@endif
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Email Id</label>
                      <input type="text" class="form-control" placeholder="Email ID" name="email" id="email" value="{{ old('email') }}" required="" />
                        @if($errors->has('email'))
						    <div class="error">{{ $errors->first('email') }}</div>
						@endif
                    </div>
                    <div class="form-group">
                      <div class="form-group">
                        <label>Select Gender</label>
                        <select class="form-control" name="gender" required="">
                          <option value="">Select Gender</option>
                          <option value="Male" @if(old('gender') == 'Male') selected="" @endif>Male</option>
                          <option value="Female" @if(old('gender') == 'Female') selected="" @endif>Female</option>
                        </select>
                        @if($errors->has('gender'))
						    <div class="error">{{ $errors->first('gender') }}</div>
						@endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Date of Birth</label>
                      <input type="date" class="form-control" name="dob" value="{{ old('dob') }}" placeholder="Date of Birth"/>
                        @if($errors->has('dob'))
						    <div class="error">{{ $errors->first('dob') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Full Address</label>
                      <input type="text" class="form-control" placeholder="Full Address" name="address" value="{{ old('address') }}" required="" />
                        @if($errors->has('address'))
						    <div class="error">{{ $errors->first('address') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
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
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Select State</label>
                      <select class="form-control" name="state" id="state" onchange="getCity()" required="">
                        
                      </select>
                        @if($errors->has('state'))
  						    <div class="error">{{ $errors->first('state') }}</div>
  						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>City</label>
                      <select class="form-control" name="city" id="city" required="">
                        
                      </select>
                        @if($errors->has('city'))
  						    <div class="error">{{ $errors->first('city') }}</div>
  						@endif
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    &nbsp;
                  </div>
                    <div class="col-md-6">
	                  <div class="form-group">
	                    <label>Password</label>
	                    <input type="password" class="form-control" name="password" placeholder="Password" required="" />
	                    	@if($errors->has('password'))
							    <div class="error">{{ $errors->first('password') }}</div>
							@endif
	                  </div>
	                </div>
	                <div class="col-md-6">
	                  <div class="form-group">
	                    <label>Re-Enter Password</label>
	                    <input type="password" class="form-control" placeholder="Re-Enter Password" name="password_confirmation" required="" />
	                    	@if($errors->has('password_confirmation'))
							    <div class="error">{{ $errors->first('password_confirmation') }}</div>
							@endif
	                  </div>
	                </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="customFile">Document Name & Upload Document File</label>
                      <div class="row input-wrapper">
                        <div class="inner-wrapper-upload col-md-2">
                          <input type="text" class="form-control" name="document_name[]" id="document_name1" placeholder="Document Name" onkeyup="bannerFileRequire(1)" />
                            @if($errors->has('document_name'))
            	  						    <div class="error">{{ $errors->first('document_name') }}</div>
            	  						@endif
                          <div class="custom-img-uploader">
                            <div class="input-group">
                              <span class="input-group-btn">
                                <span class="btn-file">
                                  <input type="file" name="file[]" id="file1" onchange="dynamicBranchChangeImage(1, this)">
                                  <img id='upload-img1' class="img-upload-block" src="{{ asset('') }}/admin/images/plus-upload.jpg"/>
                                </span>
                              </span>
                            </div>
                          </div>
                          <a class="add_field_button"><i class="fas fa-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="customFile">Document Name & Upload Document File</label>
                      <div class="input-wrapper">
                        <div class="inner-wrapper-upload">
                          <input type="text" name="docname1" class="form-control" placeholder="Document Name"/>
                          <div class="custom-file">
                            <input type="file" name="docup1" class="custom-file-input" id="customFile" />
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                          <a class="add_field_button"><i class="fas fa-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Add Team</button>
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
@if($errors->any())
<script type="text/javascript">
	setTimeout(function() {
		getState('{{ old('country') }}');
		getCity('{{ old('state') }}');
	}, 2000);
</script>
@endif
@endsection
@section('page-scripts')
<script type="text/javascript">
	function  bannerFileRequire(count) {
		var name = $('#document_name'+count).val();
		if(name != '') {
			$('#file'+count).attr('required', true);
		}else {
			$('#file'+count).removeAttr('required');
		}
	}
</script>
@endsection