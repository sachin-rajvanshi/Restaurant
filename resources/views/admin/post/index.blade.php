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
                <li class="breadcrumb-item active">Manage Post</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/post/create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Post</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Quantity List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="quantity-list">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Date & Time</th>
                      <th>Post Name</th>
                      <th>Remark</th>
                      <th width="100">Status</th>
                      <th width="70">Action</th>
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
		var table = $('#quantity-list').DataTable({
		  	processing: true,
		    serverSide: true,
		    render: true,
		    searching: true,
		  	ajax: "{{ url('admin/post') }}",
		  	columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'date_time', name: 'date_time'},
				{data: 'name', name: 'name'},
				{data: 'remark', name: 'remark'},
				{data: 'status', name: 'status'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
	});

	function deleteCategory(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Delete This Post",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	    })
	    .then((willDelete) => {
	      if (willDelete) {
	          $.ajax({
	            url: '{{ url('admin/post') }}/'+id,
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
	                $('#quantity-list').DataTable().ajax.reload();
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