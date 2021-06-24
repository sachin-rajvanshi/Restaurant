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
                <li class="breadcrumb-item active">Header Setting</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ \Auth::user()->website }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" target="_blank">View Website</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Header Info</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.updateHeader') }}" method="POST" enctype="multipart/form-data">
              	@csrf
              	@method('PATCH')
                <div class="row">
                  <input type="hidden" name="id" value="{{ $header->id }}">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Website Logo</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              	<input type="file" name="logo" id="imgLogo">
                          		  @if (Storage::exists($header->logo)) 
                                    <img id='upload-logo' src="{{ asset('storage/'.$header->logo) }}" class="img-upload-block">
                                @else
                                  	<img id='upload-logo' src="{{ asset('') }}admin/images/plus-upload.jpg" class="img-upload-block">
                                @endif
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Favicon Icon</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="favicon" id="imgFav">
                              	@if (Storage::exists($header->favicon)) 
                                    <img id='upload-favicon' src="{{ asset('storage/'.$header->favicon) }}" class="img-upload-block">
                                @else
                                  	<img id='upload-favicon' src="{{ asset('') }}admin/images/plus-upload.jpg" class="img-upload-block">
                                @endif
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Website Title</label>
                      <input type="text" class="form-control" placeholder="Website Title" name="title" value="{{ $header->title }}" />
                    </div>
                    <div class="form-group">
                      <label>Meta Description</label>
                      <input type="text" class="form-control" placeholder="Meta Description" name="description" value="{{ $header->description }}"/>
                    </div>
                    <div class="form-group">
                      <label>Keywords</label>
                      <input type="text" class="form-control" placeholder="Keywords" name="keywords" value="{{ $header->keywords }}"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" value="{{ $header->phone_number }}"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email Id</label>
                      <input type="text" class="form-control" placeholder="Email Id" name="email" value="{{ $header->email }}"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Facebook Link</label>
                      <input type="text" class="form-control" placeholder="Facebook Link" name="facebook" value="{{ $header->facebook }}"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Twitter Link</label>
                      <input type="text" class="form-control" placeholder="Twitter Link" name="twitter" value="{{ $header->twitter }}"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Youtube Link</label>
                      <input type="text" class="form-control" placeholder="Youtube Link" name="youtube" value="{{ $header->youtube }}"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Linkedin</label>
                      <input type="text" class="form-control" placeholder="Linkedin" name="linkedin" value="{{ $header->linkedin }}"/>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Manage Header</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.updateHeaderPermission') }}" method="POST">
              	@csrf
              	@method('PUT')
                <div class="row">
                  <input type="hidden" name="id" value="{{ $header->id }}">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Show Primary Header</label>
                      <select class="form-control" name="header_permission">
                      	@if($header->header_permission == 'Yes')
                      		<option value="Yes" selected="">Yes</option>
                      		<option value="No">No</option>
                      	@elseif($header->header_permission == 'No')
                      		<option value="Yes">Yes</option>
                      		<option value="No" selected="">No</option>
                      	@endif
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Show Email Id</label>
                      <select class="form-control" name="email_permission">
                        @if($header->email_permission == 'Yes')
                      		<option value="Yes" selected="">Yes</option>
                      		<option value="No">No</option>
                      	@elseif($header->email_permission == 'No')
                      		<option value="Yes">Yes</option>
                      		<option value="No" selected="">No</option>
                      	@endif
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Show Contact Number</label>
                      <select class="form-control" name="contact_permission">
                        @if($header->contact_permission == 'Yes')
                      		<option value="Yes" selected="">Yes</option>
                      		<option value="No">No</option>
                      	@elseif($header->contact_permission == 'No')
                      		<option value="Yes">Yes</option>
                      		<option value="No" selected="">No</option>
                      	@endif
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Show Social Media Icon</label>
                      <select class="form-control" name="social_permission">
                        @if($header->social_permission == 'Yes')
                      		<option value="Yes" selected="">Yes</option>
                      		<option value="No">No</option>
                      	@elseif($header->social_permission == 'No')
                      		<option value="Yes">Yes</option>
                      		<option value="No" selected="">No</option>
                      	@endif
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Save Setting</button>
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