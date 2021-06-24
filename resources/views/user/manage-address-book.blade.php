@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg')  }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Address Book</h1>
           <p>{{ \Auth::user()->about_me }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Address Book</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="custom-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          @include('user.sidebar')
        </div>
        <div class="col-md-8">
          <div class="dashbaord-block-right">
            <h3 class="dashbaord-header">Manage Addresses</h3>
            <div class="inner-block">
              <div class="address-book-blk">
                <a href="#" data-toggle="modal" data-target="#addAddress" class="add-address-blk">
                  <i class="fas fa-plus"></i> Add Address
                </a>
                @foreach($address_books as $address)
	                <div class="address-block">
	                  <div class="address-details">
	                    <h5>@if($address->set_as_default == 'Yes') <span>Default</span> @endif <span>{{ $address->type }} Address</span></h5>
	                    <h4><b>{{ \Auth::user()->name }}</b> {{ $address->mobile_number }}</h4>
	                    <p>{{ $address->address }} {{ $address->getCity ? $address->getCity->name : '' }}, {{ $address->getState ? $address->getState->name : '' }}, {{ $address->getCountry ? $address->getCountry->name : '' }}</p>
	                    @if($address->set_as_default != 'Yes') <a href="javascript:void(0)" class="setdefault-btn" onclick="changeStatus('{{ $address->id }}')">Set as Default</a> @endif
	                  </div>
	                  <div class="address-action">
	                    <a href="{{ url('user/address/book') }}/{{ $address->id }}/edit" class="actionbtn editbtn"><i class="fas fa-pencil-alt"></i></a>
	                    <a href="#" class="actionbtn deletebtn"><i class="far fa-trash-alt"></i></a>
	                  </div>
	                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<div class="modal fade" id="addAddress" tabindex="-1" role="dialog" aria-labelledby="addAddressTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="addressheading">Add New Address</h3>
        <form method="post" action="{{ url('user/address/book') }}" enctype="multipart/form-data">
        	@csrf
	        <div class="addressform">
	          <div class="row">
	            <div class="col-md-12">
	              <div class="form-group">
	                <label>Address (Area or Street)</label>
	                <input type="text" class="form-control" placeholder="Address (Area or Street)" name="address" required="">
	              </div>
	            </div>
	            <div class="col-md-6">
	            	<div class="form-group">
	                <label>Select Country</label>
	                <select class="form-control" name="country" id="country" onchange="getState()" required="">
	                  <option value="">Select Country</option>
	                  @foreach($countries as $country)
	                  	@if(old('country') == $country->id)
	                  		<option value="{{ $country->id }}" selected="">{{ $country->name }}</option>
	                  	@else
	                  		<option value="{{ $country->id }}">{{ $country->name }}</option>
	                  	@endif
	                  @endforeach()
	                </select>
					@if($errors->has('country'))
					    <div class="error">{{ $errors->first('country') }}</div>
					@endif
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Select State</label>
	                <select class="form-control" name="state" id="state" onchange="getCity()" required="">
	                  
	                </select>
					@if($errors->has('state'))
					    <div class="error">{{ $errors->first('state') }}</div>
					@endif
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>City</label>
	                <select class="form-control" name="city" id="city" required="">
	                  
	                </select>
					@if($errors->has('city'))
					    <div class="error">{{ $errors->first('city') }}</div>
					@endif
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Pincode</label>
	                <input type="number" class="form-control" placeholder="Pincode" name="pincode" required="">
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Contact Number</label>
	                <input type="text" class="form-control" placeholder="Contact Number" name="mobile_number" required="">
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Address Type</label>
	                <div class="form-group">
	                  <select class="form-select" name="address_type" required="">
	                    <option value="">Address Type</option>
	                    <option value="Billing">Billing Address</option>
	                    <option value="Shipping">Shipping Address</option>
	                  </select>
	                </div>
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Set as Default</label>
	                <div class="form-group">
	                  <select class="form-select" name="set_as_default" required="">
	                    <option value="No">No</option>
	                    <option value="Yes">Yes</option>
	                  </select>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">Save Address</button>
		      </div>
	        </div>
    	</form>
      </div>
      
    </div>
  </div>
</div>

@endsection
@section('front-scripts')
<script type="text/javascript">
	function changeStatus(id) {
		swal({
			title: "Are you sure?",
			text: "Set As A Default This Address.",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
		    $.ajax({
				url: '{{ url('user/address/set-as-default') }}/'+id,
				method: "GET",
				// data: {
				// 	"_token": "{{ csrf_token() }}",
				// 	'id': id
				// },
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