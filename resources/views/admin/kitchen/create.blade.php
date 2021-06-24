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
                <li class="breadcrumb-item active">Add Kitchen</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/kitchen') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Add Kitchen</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/kitchen') }}" method="POST">
              @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Select Branch</label>
                      <select class="form-control" name="branch" required="">
                        <option value="">Select Branch</option>
                        @foreach($branches as $branch)
                        	<option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kitchen Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Kitchen Name" required="" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Chef Name</label>
                      <input type="text" class="form-control" name="chef_name" placeholder="Chef Name" required="" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Select Status</label>
                      <select class="form-control" name="status" required="">
                        <option value="Yes">Active</option>
                        <option value="No">Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Add Kitchen</button>
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