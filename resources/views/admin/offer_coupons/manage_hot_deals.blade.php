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
                <li class="breadcrumb-item active">Manage Hot Deals</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/deals/create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Hot Deals</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Hot Deals List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="deals-list">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th width="100">Date & Time</th>
                      <th>Offer Name</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Food Item</th>
                      <th width="70" class="text-center">Discount (%)</th>
                      <th width="110" class="text-center">Max Discount Value</th>
                      <th width="110" class="text-center">Min Order Value</th>
                      <th>Applied For</th>
                      <th>Offer Start</th>
                      <th>Offer End</th>
                      <th width="80">Per User Usage</th>
                      <th>Status</th>
                      <th width="110">Action</th>
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
    var table = $('#deals-list').DataTable({
        processing: true,
        serverSide: true,
        render: true,
        searching: true,
        ajax: "{{ url('admin/deals') }}",
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'date_time', name: 'date_time'},
        {data: 'name', name: 'name'},
        {data: 'category', name: 'category'},
        {data: 'sub_category_data', name: 'sub_category_data'},
        {data: 'food_items', name: 'food_items'},
        {data: 'discount', name: 'discount'},
        {data: 'max_discount', name: 'max_discount'},
        {data: 'min_order', name: 'min_order'},
        {data: 'apply_for', name: 'apply_for'},
        {data: 'start_date', name: 'start_date'},
        {data: 'end_date', name: 'end_date'},
        {data: 'usages', name: 'usages'},
        {data: 'status', name: 'status'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    });
  });

  function changeStatus(id) {
      swal({
          title: "Are you sure?",
          text: "Change Status Of This Deal.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
              url: '{{ url('admin/deals/change-status') }}',
              method: "POST",
              data: {
                "_token": "{{ csrf_token() }}",
                'id': id
              },
              beforeSend: function() {
                document.getElementById('loading').style.display = 'block';
              },
              success: function(response) {
                console.log(response);
                if(response.code === 200) {
                  swal('', response.message, 'success');
                  $('#deals-list').DataTable().ajax.reload();
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

  function deleteDeal(id) {
      swal({
          title: "Are you sure?",
          text: "Delete This Deal",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
              url: '{{ url('admin/deals') }}/'+id,
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
                  $('#deals-list').DataTable().ajax.reload();
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