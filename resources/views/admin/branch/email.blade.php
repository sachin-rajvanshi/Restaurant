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
                <li class="breadcrumb-item active">Send Email</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Send Email</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/send/email') }}" method="POST">
        		@csrf
          		<input type="hidden" name="id" value="{{ $user->id }}">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Enter Subject</label>
                      <input type="text" class="form-control" name="subject" placeholder="Enter Subject" required="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Email Body</label>
                      <textarea id="description" name="message"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Send Email</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Email History</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th width="200">Date & Time</th>
                      <th>Email Subject</th>
                      <th>Email Detail</th>
                      <th width="100">Status</th>
                      <th width="50">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($user->getEmailHistory) > 0)
                  	@foreach($user->getEmailHistory as $h => $history)
	                    <tr>
	                      <td width="50">#{{ $h+1 }}</td>
	                      <td>{{ App\Helper\Helper::convertDateTime($history->created_at) }}</td>
	                      <td>{{ $history->subject }}</td>
	                      <td>{!! $history->message !!}</td>
	                      <td>
	                      	@if($history->status == 'Success')
	                      		<span class="text-success">Successful</span>
	                      	@else
	                      		<span class="text-danger">{{ $history->status }}</span>
	                      	@endif
	                      </td>
	                      <td>
	                        <a href="javascript:void(0)" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light" onclick="deleteEmail('{{ $history->id }}')"><i class="far fa-trash-alt"></i></a>
	                      </td>
	                    </tr>
	                @endforeach
                    @else
                    	<tr><td colspan="10" align="center">No any record found.</td></tr>
                    @endif
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
	function deleteEmail(id) {
		swal({
		  title: "Are you sure?",
		  text: "Delete This Email History.",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
		    $.ajax({
		      url: '{{ url('admin/delete/email/history') }}/'+id,
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
		          location.reload();
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