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
                <li class="breadcrumb-item active">Edit Promotional Banner</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.managePromotionalBanners') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Edit Promotional Banner</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.updatePromotionalBanners') }}" method="POST" enctype="multipart/form-data">
              	@csrf
              	<input type="hidden" name="id" value="{{ $picked->id }}">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload Banner</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="file" id="imgSec">
                              @if (Storage::exists($picked->image)) 
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
                      <label>Select Banner Position</label>
                      <select class="form-control" name="position" required="">
                        <option value="1" @if($picked->position == 1) selected @endif>1</option>
                        <option value="2" @if($picked->position == 2) selected @endif>2</option>
                        <option value="3" @if($picked->position == 3) selected @endif>3</option>
                        <option value="4" @if($picked->position == 4) selected @endif>4</option>
                        <option value="5" @if($picked->position == 5) selected @endif>5</option>
                        <option value="6" @if($picked->position == 6) selected @endif>6</option>
                        <option value="7" @if($picked->position == 7) selected @endif>7</option>
                        <option value="8" @if($picked->position == 8) selected @endif>8</option>
                        <option value="9" @if($picked->position == 9) selected @endif>9</option>
                        <option value="10" @if($picked->position == 10) selected @endif>10</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Select Application</label>
                      <select class="select2 form-control" name="applications[]" required="" multiple>
                        <option value="android" @if(in_array('android', explode(',', $picked->applications))) selected @endif>Android</option>
                        <option value="ios" @if(in_array('ios', explode(',', $picked->applications))) selected @endif>iOS</option>
                        <option value="website" @if(in_array('website', explode(',', $picked->applications))) selected @endif>Website</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Banner Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Banner Name" value="{{ $picked->name }}"  required="" />
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Banner Text</label>
                      <select class="form-control" name="text_required" id="banner-text-option" required="">
                        <option value="No" @if($picked->text_required == 'No') selected @endif>No Text</option>
                        <option value="Yes" @if($picked->text_required == 'Yes') selected @endif>Text Require</option>
                      </select>
                    </div>
                    @if($picked->text_required == 'Yes')
	                    <div id="banner-text" class="form-group" style="display: block;">
	                    	<label>Banner Text</label>
	                      	<input type="text" class="form-control" id="banner-textbox" name="text" value="{{ $picked->text }}" placeholder="Enter Text"/>
	                    </div>
	                @else
	                	<div id="banner-text" class="form-group" style="display: none;">
	                    	<label>Banner Text</label>
	                      	<input type="text" class="form-control" id="banner-textbox" name="text" value="{{ $picked->text }}" placeholder="Enter Text"/>
	                    </div>
                    @endif
                    <div class="form-group">
                      <label>Remark if any</label>
                      <input type="text" class="form-control" name="remark" value="{{ $picked->remark }}" placeholder="Remark if any"/>
                    </div>
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