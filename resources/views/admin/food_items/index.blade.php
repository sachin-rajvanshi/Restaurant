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
                <li class="breadcrumb-item active">Manage Food Items</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/food/items/create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Food Item</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Manage Food Items List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="fooditems-list">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th width="170">Date & Time</th>
                      <th>Category</th>
                      <th width="200">Food Name</th>
                      <th>Quantity Type</th>
                      <th class="text-center">MRP & Discount</th>
                      <th class="text-center">Stock</th>
                      <th class="text-center">Inventory</th>
                      <th class="text-center">COD</th>
                      <th class="text-center">Home Delivery</th>
                      <th class="text-center">Takeaway</th>
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
		var table = $('#fooditems-list').DataTable({
		  	processing: true,
		    serverSide: true,
		    render: true,
		    searching: true,
		  	ajax: "{{ url('admin/food/items') }}",
		  	columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'date_time', name: 'date_time'},
				{data: 'category', name: 'category'},
				{data: 'image', name: 'image'},
				{data: 'quantity_type', name: 'quantity_type'},
				{data: 'price', name: 'price'},
				{data: 'stock', name: 'stock'},
				{data: 'inventory', name: 'inventory'},
				{data: 'cod', name: 'cod'},
				{data: 'home_delivery', name: 'home_delivery'},
				{data: 'takeaway', name: 'takeaway'},
				{data: 'status', name: 'status'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
	});

	function deleteItem(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Delete This Item",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	    })
	    .then((willDelete) => {
	      if (willDelete) {
	          $.ajax({
	            url: '{{ url('admin/food/items') }}/'+id,
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
	                $('#fooditems-list').DataTable().ajax.reload();
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

	function changeStatus(id, obj) {
	    swal({
	      title: "Are you sure?",
	      text: "Change Status Of This Item.",
	      icon: "warning",
	      buttons: true,
	      dangerMode: true,
	    })
	    .then((willDelete) => {
	    if (willDelete) {
	        $.ajax({
	          url: '{{ url('admin/food/items/change-status') }}',
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
	              $('#fooditems-list').DataTable().ajax.reload();
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