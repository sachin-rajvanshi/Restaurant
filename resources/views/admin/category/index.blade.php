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
                <li class="breadcrumb-item active">Manage Categories & Sub Categories</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/category/create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Category</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Manage Categories & Sub Categories List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="categories-list">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th width="130">Date & Time</th>
                      <th width="150">Category Name</th>
                      <th width="150">Parent Category Name</th>
                      <th width="110">Total Sub Categories</th>
                      <th width="150">Remark</th>
                      <th width="150">Meta Title</th>
                      <th width="150">Meta Keyword</th>
                      <th width="150">Meta Description</th>
                      <th>Status</th>
                      <th width="140">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
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
<script type="text/javascript">
	$(function () {
		var table = $('#categories-list').DataTable({
		  	processing: true,
		    serverSide: true,
		    render: true,
		    searching: true,
		  	ajax: "{{ url('admin/category') }}",
		  	columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'date_time', name: 'date_time'},
				{data: 'profile', name: 'profile'},
				{data: 'parent_name', name: 'parent_name'},
				{data: 'sub_categories_count', name: 'sub_categories_count'},
				{data: 'remark', name: 'remark'},
				{data: 'meta_title', name: 'meta_title'},
				{data: 'meta_keywords', name: 'meta_keywords'},
				{data: 'meta_description', name: 'meta_description'},
				{data: 'status', name: 'status'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
	});

	function changeStatus(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Change Status Of This Category",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	    })
	    .then((willDelete) => {
	      if (willDelete) {
	          $.ajax({
	            url: '{{ url('admin/category/change-status') }}',
	            method: "POST",
	            data: {
	              "_token": "{{ csrf_token() }}",
	              'id'    : id,
	            },
	            beforeSend: function() {
	              document.getElementById('loading').style.display = 'block';
	            },
	            success: function(response) {
	              console.log(response);
	              if(response.code === 200) {
	                swal('', response.message, 'success');
	                $('#categories-list').DataTable().ajax.reload();
	                manageLargeContent();
	              }else {
	                swal('', response.message, 'warning');
	              }
	            },
	            error: function(response) {
	              document.getElementById('loading').style.display = 'none';
	            },
	            complete: function() {
	              document.getElementById('loading').style.display = 'none';
	            }
	          })
	      }
	    });
	    
	 }

	function deleteCategory(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Delete This Category",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	    })
	    .then((willDelete) => {
	      if (willDelete) {
	          $.ajax({
	            url: '{{ url('admin/category') }}/'+id,
	            method: "DELETE",
	            data: {
	              "_token": "{{ csrf_token() }}",
	            },
	            beforeSend: function() {
	              document.getElementById('loading').style.display = 'block';
	            },
	            success: function(response) {
	              console.log(response);
	              if(response.code === 200) {
	                swal('', response.message, 'success');
	                $('#categories-list').DataTable().ajax.reload();
	                manageLargeContent();
	              }else {
	                swal('', response.message, 'warning');
	              }
	            },
	            error: function(response) {
	              document.getElementById('loading').style.display = 'none';
	            },
	            complete: function() {
	              document.getElementById('loading').style.display = 'none';
	            }
	          })
	      }
	    });
	    
	}
</script>
@endsection