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
                <li class="breadcrumb-item active">Add Category</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/category') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Add Category</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
              	@csrf
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload Category Image</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="image" id="imgSec" required="">
                              <img id='upload-img' class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg"/>
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
                      <label>Category Name</label>
                      <input type="text" class="form-control" name="name" id="slug_content" value="{{ old('name') }}" placeholder="Category Name" onkeyup="convertToSlug()" required="" />
                      	@if($errors->has('name'))
            						    <div class="error">{{ $errors->first('name') }}</div>
            						@endif
                    </div>
                    <div class="form-group">
                      <label>Slug URL</label>
                      <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" placeholder="Slug URL" readonly="" required="" />
                      	@if($errors->has('slug'))
						    <div class="error">{{ $errors->first('slug') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Parent Id</label>
                      <select class="form-control" name="parent_id">
                      	<option value="">Select Parent id</option>
                      	@foreach($categories as $category)
                          @if(request()->input('parent'))
                            @if(base64_decode(request()->input('parent')) == $category->id)
                              <option value="{{ $category->id }}" selected="" >{{ $category->name }}</option>
                            @endif
                          @else
                            @if(old('parent_id') == $category->id)
                              <option value="{{ $category->id }}" selected="">{{ $category->name }}</option>
                            @else
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                          @endif
                      	@endforeach
                      </select>
                      	@if($errors->has('parent_id'))
						    <div class="error">{{ $errors->first('parent_id') }}</div>
						@endif
                    </div>
                    <div class="form-group">
                      <label>Remark</label>
                      <input type="text" class="form-control" name="remark" value="{{ old('remark') }}" placeholder="Meta Title"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Meta Title</label>
                      <textarea class="form-control" rows="3" name="meta_title" placeholder="Meta keyword" required="">{{ old('meta_title') }}</textarea>
                      	@if($errors->has('meta_title'))
						    <div class="error">{{ $errors->first('meta_title') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Meta keywords</label>
                      <textarea class="form-control" rows="3" name="meta_keywords" placeholder="Meta keywords" required="">{{ old('meta_keywords') }}</textarea>
                      	@if($errors->has('meta_keywords'))
						    <div class="error">{{ $errors->first('meta_keywords') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Meta Description</label>
                      <textarea class="form-control" rows="3" name="meta_description" placeholder="Meta Description" required="">{{ old('meta_description') }}</textarea>
                      	@if($errors->has('meta_description'))
						    <div class="error">{{ $errors->first('meta_description') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Add Category</button>
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