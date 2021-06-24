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
                <li class="breadcrumb-item active">View Category</li>
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
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="profile-pic">
              	@if (Storage::exists($category->image)) 
              		<img src="{{ asset('storage/'.$category->image) }}" alt="">
                @else
                	<img src="{{ asset('') }}admin/images/dummy.jpg" alt="">
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <ul class="profile-content">
                <li><b>Category Name:</b> <span>{{ $category->name }}</span></li>
                <li><b>Child Category:</b> 
                	<span>
                	@if(count($category->getSubCategories($category->id)) > 0)
                	@foreach($category->getSubCategories($category->id) as $sub_cat)
                		<a href="{{ url('admin/category') }}/{{ $sub_cat->slug }}" class="badge badge-primary custom-badge">{{ $sub_cat->name }}</a> 
                	@endforeach
                	</span>
                	@else
                		<b>No any sub categories found.</b>
                	@endif
                </li>
                <li><b>URL:</b> <span><a href="#">{{ url('') }}/admin/category/{{ $category->slug }}</a></span></li>
                <li><b>Remark:</b> <span>{{ $category->remark }}</span></li>
                <li><b>Meta Title:</b> <span>{{ $category->meta_title }}</span></li>
                <li><b>Meta Keyword:</b> <span>{{ $category->meta_keywords }}</span></li>
                <li><b>Meta Description:</b> <span>{{ $category->meta_Description }}</span></li>
              </ul>
            </div>
          </div>
          
          <div class="card">
            <div class="card-body">
              <div class="branch-buttons">
                <a href="{{ url('admin/category') }}/{{ $category->slug }}/edit" class="btn btn-primary waves-effect waves-float waves-light">Edit Category</a>
                <a href="{{ url('admin/category/create') }}?parent={{ base64_encode($category->id) }}" class="btn btn-info waves-effect waves-float waves-light">Add Child Category</a>
              </div>
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