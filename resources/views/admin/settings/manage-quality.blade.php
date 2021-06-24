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
                <li class="breadcrumb-item active">Our Quality</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.addQuality') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Quality</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Our Quality List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th width="40px">ID</th>
                      <th width="170px">Date & Time</th>
                      <th width="70px">Image</th>
                      <th width="200px">Heading</th>
                      <th>Content</th>
                      <th width="70px">Position</th>
                      <th width="70px">Status</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(count($datas) > 0)
                  		@foreach($datas as $key => $quality)
	                    <tr>
	                      <td>#{{ $key + 1 }}</td>
	                      <td>{{ App\Helper\Helper::convertDateTime($quality->created_at) }}</td>
	                      <td>
	                        <div class="table-image">
	                        	@if(Storage::exists($quality->image))
	                        		<img src="{{ asset('storage') }}/{{ $quality->image }}" alt="">
	                        	@else
	                        		<img src="{{ asset('') }}admin/images/dummy.jpg" alt="">
	                        	@endif
	                        </div>
	                      </td>
	                      <td>{{ $quality->heading }}</td>
	                      <td>{{ $quality->content }}</td>
	                      <td>{{ $quality->position }}</td>
	                      <td>
	                      	@if($quality->status == 'Yes')
	                      		<span class="text-success">Active</span>
	                      	@else
	                      		<span class="text-dander">Inactive</span>
	                      	@endif
	                      </td>
	                      <td>
	                        <a href="{{ route('admin.editQuality', $quality->id) }}" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
	                        <a href="javascript:void(0)" onclick="deleteQuality('{{ $quality->id }}')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>
	                      </td>
	                    </tr>
	                    @endforeach
	                    {{ $datas->links() }}
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
	function deleteQuality(id) {
		swal({
		  title: "Are you sure?",
		  text: "Delete This Quality",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
		    $.ajax({
		      url: '{{ url('admin/delete/quality') }}/'+id,
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