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
                <li class="breadcrumb-item active">Footer Setting</li>
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
              <h4 class="card-title">Footer Setting</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.updateFooter') }}" method="POST">
              	@csrf
              	@method('PUT')
                <div class="row">
                  <div class="col-md-6">
                  	<input type="hidden" name="id" value="{{ $footer->id }}">
                    <div class="form-group">
                      <label>Short About Us (Footer Block)</label>
                      <textarea name="about" rows="3" class="form-control" placeholder="Short About Us">{{ $footer->about }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Address</label>
                      <textarea name="address" rows="3" class="form-control" placeholder="Address">{{ $footer->address }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Show Social Media Icon</label>
                      <select class="form-control" name="social_permission">
                        @if($footer->social_permission == 'Yes')
                      		<option value="Yes" selected="">Yes</option>
                      		<option value="No">No</option>
                      	@elseif($footer->social_permission == 'No')
                      		<option value="Yes">Yes</option>
                      		<option value="No" selected="">No</option>
                      	@endif
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Copyright Info</label>
                      <input type="text" name="copyright" class="form-control" placeholder="Copyright Info" value="{{ $footer->copyright }}" />
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