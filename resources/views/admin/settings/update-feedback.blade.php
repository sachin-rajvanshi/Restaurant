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
                <li class="breadcrumb-item active">Update Feedback</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.manageFeedback') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Update Feedback</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.updateFeedback') }}" method="POST" enctype="multipart/form-data">
              	@csrf
                @method('PATCH')
                <input type="hidden" name="id" value="{{ $picked->id }}">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload Image</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="file" id="imgSec">
                              @if(Storage::exists($picked->image))
                                <img id='upload-img' class="img-upload-block" src="{{ asset('storage/'.$picked->image) }}"/>
                              @else
                                <img id='upload-img' class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg"/>
                              @endif
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Enter Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $picked->name }}" required="" />
                    </div>
                    <div class="form-group">
                      <label>Enter Mobile Number</label>
                      <input type="text" class="form-control" name="mobile_number" placeholder="Enter Mobile Number" value="{{ $picked->mobile_number }}" required="" />
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Enter Email Id</label>
                      <input type="text" class="form-control" name="email" placeholder="Enter Email Id" value="{{ $picked->email }}" required="" />
                    </div>
                    <div class="form-group">
                      <label>Select Status</label>
                      <select class="form-control" name="status" required="">
                        <option value="Pending" @if($picked->approve_status == 'Pending') selected  @endif>Pending</option>
                        <option value="Approved" @if($picked->approve_status == 'Approved') selected  @endif>Approved</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Enter Feedback</label>
                      <textarea class="form-control" rows="3" placeholder="Enter Feedback" name="feedback" required="">{{ $picked->feedback }}</textarea>
                    </div>
                  </div>
                    <div class="col-md-12">
	                  	<div class="form-group">
	                      <label>Select Application</label>
	                      <select class="select2 form-control" name="applications[]" required="" multiple>
	                        <option value="android" @if(in_array('android', explode(',', $picked->applications))) selected @endif>Android</option>
	                        <option value="ios" @if(in_array('ios', explode(',', $picked->applications))) selected @endif>iOS</option>
	                        <option value="website" @if(in_array('website', explode(',', $picked->applications))) selected @endif>Website</option>
	                      </select>
	                    </div>
	                </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update Banner</button>
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

@endsection