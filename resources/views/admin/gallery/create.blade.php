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
                <li class="breadcrumb-item active">Add Gallery</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/gallery') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Add Gallery</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/gallery') }}" method="POST" enctype="multipart/form-data">
              	@csrf
                <div class="add-gallery-field">
                  <div class="row ">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="customFile">Gallery Image</label>
                        <div class="row input-wrapper-food">
                          <div class="inner-wrapper-upload col-md-8">
                            <div class="custom-img-uploader">
                              <div class="input-group">
                                <span class="input-group-btn">
                                  <span class="btn-file">
                                    <input type="file" name="image[]" id="imgSec" required="">
                                    <img id='upload-img' class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg"/>
                                  </span>
                                </span>
                              </div>
                            </div>
                            <a class="add_field_button_gallery"><i class="fas fa-plus"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Category</label>
                        <select class="select2 form-control" name="category[]" required="">
                          <option value="">Select Category</option>
                          @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name[]" placeholder="Banner Name" required="" />
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Remark</label>
                        <input type="text" class="form-control" name="remark[]" placeholder="Remark"/>
                      </div>
                      <div class="form-group">
                        <label>Select Status</label>
                        <select class="form-control" name="status[]" required="">
                          <option value="Yes">Active</option>
                          <option value="No">Inactive</option>
                        </select>
                      </div>
                    </div>
                  
                  </div>
                </div>
                <div class="row"> 
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Add Gallery</button>
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
@section('page-scripts')
@endsection