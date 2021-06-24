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
                <li class="breadcrumb-item active">Addon Setting</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/food/items') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Addon Setting</h4>
            </div>
            <div class="card-body">
              <div class="addon-block">
              <div class="container"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="new_data" value="{{ $data }}">
@endsection
@section('page-scripts')

<script>
	let new_data = JSON.parse($('#new_data').val());	
	let data = new_data;
	let tree = new Tree('.container', {
		data: [{ id: '-1', text: '{{ $root_category->name }}', children: data }],
		closeDepth: 4,
		onChange: function() {
			var ids = this.values;
	  	    $.ajax({
	  			url: '{{ url('admin/food/addons') }}',
	  			method: "POST",
	  			data: {
	  				"_token": "{{ csrf_token() }}",
	  				'ids': ids,
	  				'food_id': '{{ $food->id }}',
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
	})
</script>

@endsection