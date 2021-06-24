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
                <li class="breadcrumb-item active">Email Templates</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/email/template/create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Template</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Email Template List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Banner ID</th>
                      <th>Date & Time</th>
                      <th>Title Image</th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Subject</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(count($templates) > 0)
                  		@foreach($templates as $t => $template)
		                    <tr>
		                      <td>#{{ $t+1 }}</td>
		                      <td>{{ App\Helper\Helper::convertDateTime($template->created_at) }}</td>
		                      <td>
		                        <div class="table-image">
		                        	@if(Storage::exists($template->image))
		                        		<img src="{{ asset('storage') }}/{{ $template->image }}" alt="">
		                        	@else
		                        		<img src="{{ asset('') }}/admin/images/dummy.jpg" alt="">
		                        	@endif
		                        </div>
		                      </td>
		                      <td>{{ $template->name }}</td>
                          <td>{{ $template->code }}</td>
                          <td>{{ $template->subject }}</td>
		                      <td>
		                      	@if($template->status == 'Yes')
		                      		<span class="text-success">Active</span>
		                      	@else
		                      		<span class="text-danger">Inactive</span>
		                      	@endif
		                      </td>
		                      <td>
		                        <a href="{{ url('admin/email/template') }}/{{ $template->id }}/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
		                      </td>
		                    </tr>
		                @endforeach
                    @else
                    	<tr><td colspan="10" align="center">No any record found.</td></tr>
                    @endif
                  </tbody>
                </table>
                {{ $templates->links() }}
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