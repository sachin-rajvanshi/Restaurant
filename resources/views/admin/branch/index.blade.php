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
                <li class="breadcrumb-item active">Manage Branch</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/branch/create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Branch</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Branch List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="branch-users">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Brand ID</th>
                      <th>Branch Name</th>
                      <th>Manager Name</th>
                      <th width="130">Mobile Number</th>
                      <th>Email ID</th>
                      <th class="text-center">Total Orders</th>
                      <th class="text-center">Delivered Orders</th>
                      <th class="text-center">Pending Orders</th>
                      <th class="text-center">Total Order Amount</th>
                      <th>City</th>
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

<!-- Models -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordTitle">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('update/password') }}" method="POST">
        @csrf
        @method('PUT')
          <input type="hidden" name="user_id" id="user-id">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="account-old-password">Old Password</label>
                <input type="password" class="form-control" name="old_pass" placeholder="Old Password" required="" />
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="account-old-password">New Password</label>
                <input type="password" class="form-control" name="password" placeholder="New Password" required="" />
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="account-old-password">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required="" />
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="sendSMS" tabindex="-1" role="dialog" aria-labelledby="sendSMSTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendSMSTitle">Send SMS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('admin/send/sms') }}" method="POST">
        @csrf
          <input type="hidden" name="id" id="sms-user-id">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Write SMS</label>
                <textarea class="form-control" name="sms" rows="3" placeholder="Write SMS" required=""></textarea>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Send</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="sendEmailTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendEmailTitle">Send Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('admin/send/email') }}" method="POST">
        @csrf
          <input type="hidden" name="id" id="email-user-id">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Subject</label>
                <input type="text" class="form-control" name="subject" placeholder="Enter Subject" required="" />
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Write Email</label>
                <textarea class="form-control" rows="3" name="message" placeholder="Write Email" required=""></textarea>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Send</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- End Models -->

@endsection
@section('page-scripts')
<script type="text/javascript">
	$(function () {
		var table = $('#branch-users').DataTable({
		  	processing: true,
		    serverSide: true,
		    render: true,
		    searching: true,
		  	ajax: "{{ url('admin/branch') }}",
		  	columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'username', name: 'username'},
				{data: 'name', name: 'name'},
				{data: 'manager_name', name: 'manager_name'},
				{data: 'mobile_number', name: 'mobile_number'},
				{data: 'email', name: 'email'},
				{data: 'total_order', name: 'total_order'},
				{data: 'delivered_order', name: 'delivered_order'},
				{data: 'pending_order', name: 'pending_order'},
				{data: 'total_amount', name: 'total_amount'},
				{data: 'city', name: 'city'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
	});

	function sendEmail(id) {
		document.getElementById('email-user-id').value = id;
		$('#sendEmail').modal('show');
	}

	function sendSMS(id) {
		document.getElementById('sms-user-id').value = id;
		$('#sendSMS').modal('show');
	}

	function updatePassword(id) {
		document.getElementById('user-id').value = id;
		$('#changePassword').modal('show');
	}

  function deleteBranch(id) {
    swal({
      title: "Are you sure?",
      text: "Delete This Branch.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        $.ajax({
          url: '{{ url('admin/branch') }}/'+id,
          method: "DELETE",
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
              $('#branch-users').DataTable().ajax.reload();
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