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
                <li class="breadcrumb-item active">Add Promotional Banner</li>
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
              <h4 class="card-title">Add Promotional Banner</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.createPromotionalBanners') }}" method="POST" enctype="multipart/form-data">
              	@csrf
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload Banner</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="file" id="imgSec" required="">
                              <img id='upload-img' class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg"/>
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
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Select Application</label>
                      <select class="select2 form-control" name="applications[]" required="" multiple>
                        <option value="android">Android</option>
                        <option value="ios">iOS</option>
                        <option value="website">Website</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Banner Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Banner Name"  required="" />
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Banner Text</label>
                      <select class="form-control" name="text_required" id="banner-text-option" required="">
                        <option value="No">No Text</option>
                        <option value="Yes">Text Require</option>
                      </select>
                    </div>
                    <div id="banner-text" class="form-group">
                    	<label>Banner Text</label>
                      	<input type="text" class="form-control" id="banner-textbox" name="text" placeholder="Enter Text"/>
                    </div>
                    <div class="form-group">
                      <label>Remark if any</label>
                      <input type="text" class="form-control" name="remark" placeholder="Remark if any"/>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Add Banner</button>
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