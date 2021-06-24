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
                <li class="breadcrumb-item active">FAQ</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.addFaq') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add FAQ</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">FAQ List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th width="250">Question</th>
                      <th>Answer</th>
                      <th width="100">Status</th>
                      <th width="70">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(count($faqs) > 0)
                  		@foreach($faqs as $f => $faq)
	                    <tr>
	                      <td width="50">#{{ $f+1 }}</td>
	                      <td>{{ $faq->question }}</td>
	                      <td>{{ $faq->answer }}</td>
	                      <td><span class="text-success">@if($faq->status == 'Yes') Active @else Inactive @endif</span></td>
	                      <td>
	                        <a href="{{ route('admin.updateFaqView', $faq->id) }}" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
	                        <a href="javascript:void(0)" onclick="deleteFaq('{{ $faq->id }}')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>
	                      </td>
	                    </tr>
	                    @endforeach
                      {{ $faqs->links() }}
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
	function deleteFaq(id) {
		swal({
		  title: "Are you sure?",
		  text: "Delete This Faq",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
		    $.ajax({
		      url: '{{ url('admin/delete/faq') }}/'+id,
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