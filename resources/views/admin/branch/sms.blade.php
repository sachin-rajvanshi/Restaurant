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
                <li class="breadcrumb-item active">Send SMS</li>
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
              <h4 class="card-title">Send SMS</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/send/sms') }}" method="POST">
        		@csrf
        		<input type="hidden" name="id" value="{{ $user->id }}">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Type SMS</label>
                      <textarea class="form-control" rows="3" name="sms" placeholder="Type SMS" required=""></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Send SMS</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">SMS History</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th width="200">Date & Time</th>
                      <th>SMS Detail</th>
                      <th width="100">Status</th>
                      <th width="50">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(count($user->getSmsHistory) > 0)
                  	@foreach($user->getSmsHistory as $h => $history)
	                    <tr>
	                      <td width="50">#{{ $h+1 }}</td>
	                      <td>{{ App\Helper\Helper::convertDateTime($history->created_at) }}</td>
	                      <td>{{ $history->message }}</td>
	                      <td>
	                      	@if($history->status == 'Success')
	                      		<span class="text-success">Successful</span>
	                      	@else
	                      		<span class="text-danger">{{ $history->status }}</span>
	                      	@endif
	                      </td>
	                      <td>
	                        <a href="javascript:void(0)" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light" onclick="deleteSMS('{{ $history->id }}')"><i class="far fa-trash-alt"></i></a>
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
	function deleteSMS(id) {
		swal({
		  title: "Are you sure?",
		  text: "Delete This SMS History.",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
		    $.ajax({
		      url: '{{ url('admin/delete/sms/history') }}/'+id,
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