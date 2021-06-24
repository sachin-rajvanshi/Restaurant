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
                <li class="breadcrumb-item active">Feedback & Testimonial</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.addFeedback') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Feedback</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Feedback & Testimonial List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="feedbacks-data">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th width="170px">Date & Time</th>
                      <th width="160px">Image & Name</th>
                      <th width="160px">Contact Details</th>
                      <th width="200px">Feedback</th>
                      <th width="130px">Application</th>
                      <th width="80px">Added By</th>
                      <th width="140px">Approval Status</th>
                      <th width="110px">Action</th>
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
	  var table = $('#feedbacks-data').DataTable({
	      processing: true,
	        serverSide: true,
	        render: true,
	        searching: true,
	      ajax: "{{ route('admin.manageFeedback') }}",
	      columns: [
	        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	          {data: 'date_time', name: 'date_time'},
	          {data: 'image', name: 'image'},
	          {data: 'contact', name: 'contact'},
	          {data: 'feedback', name: 'feedback'},
	          {data: 'applications', name: 'applications'},
	          {data: 'addred_by', name: 'addred_by'},
	          {data: 'status', name: 'status'},
	          {data: 'action', name: 'action', orderable: false, searchable: false},
	      ]
	  });
	  
	});

	function changeStatus(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Change Status Of This Feedback",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	    })
	    .then((willDelete) => {
	      if (willDelete) {
	          $.ajax({
	            url: '{{ url('admin/change-status/feedback') }}',
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
	                $('#feedbacks-data').DataTable().ajax.reload();
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

	function deleteContent(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Delete This Feedback",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	    })
	    .then((willDelete) => {
	      if (willDelete) {
	          $.ajax({
	            url: '{{ url('admin/delete/feedback') }}',
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
	                $('#feedbacks-data').DataTable().ajax.reload();
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


