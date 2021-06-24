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
                <li class="breadcrumb-item active">Cookies Policy</li>
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
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Cookies Policy</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.updateHomeContent') }}" method="post">
              	@csrf
              	@method('PUT')
              	<input type="hidden" name="id" value="{{ $picked->id }}">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Heading</label>
                        <input type="text" name="heading" class="form-control" value="{{ $picked->heading }}" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $picked->title }}" required="">
                    </div>
                  </div>
                  <div class="col-md-12" style="margin-top: 20px;">
                    <div class="form-group">
                      <textarea id="description" name="description" required="">{{ $picked->description }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Save</button>
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