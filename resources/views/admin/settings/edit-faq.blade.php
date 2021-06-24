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
                <li class="breadcrumb-item active">Update FAQ</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.manageFaq') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Update FAQ</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.updateFaq') }}" method="post">
              	@csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $picked->id }}">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Enter FAQ Question</label>
                      <input type="text" class="form-control" name="question" placeholder="Enter FAQ Question" value="{{ $picked->question }}" required="" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Select Status</label>
                      <select class="form-control" name="status">
                        <option value="Yes" @if($picked->status == 'Yes') selected @endif>Active</option>
                        <option value="No" @if($picked->status == 'No') selected @endif>Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Enter Answer</label>
                      <textarea class="form-control" rows="3" name="answer" placeholder="Enter Answer" required="">value="{{ $picked->answer }}"</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update FAQ</button>
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