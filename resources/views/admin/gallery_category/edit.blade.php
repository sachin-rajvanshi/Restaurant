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
                <li class="breadcrumb-item active">Update Gallery Category</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/categories/gallery') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Update Gallery Category</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/categories/gallery') }}/{{ $picked->id }}" method="POST" enctype="multipart/form-data">
              	@csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload Banner</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="image" id="imgSec">
                              <img id='upload-img' class="img-upload-block" src="{{ asset('storage') }}/{{ $picked->image }}"/>
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Banner Name" value="{{ $picked->name }}" required="" />
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status" required="">
                        <option value="Yes" @if($picked->status == 'Yes') selected="" @endif>Active</option>
                        <option value="No" @if($picked->status == 'No') selected="" @endif>Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Remark</label>
                      <input type="text" class="form-control" name="remark" value="{{ $picked->remark }}" placeholder="Remark" />
                    </div>
                  </div>
                </div>
                <div class="row"> 
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update Gallery Category</button>
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