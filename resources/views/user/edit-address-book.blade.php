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
            <h3 class="dashbaord-header">Update Addresses</h3>
                        <div class="inner-block">
              <div class="dash-form-blk">
                <form class="form-contact contact_form" action="{{ url('user/address/book') }}/{{ $picked->id }}" method="post" >
                	@csrf
                	@method('PUT')
	                  <div class="row">       
	                    <div class="col-md-12">
	                      <div class="form-group">
	                        <label>Address (Area or Street)</label>
	                        <input type="text" class="form-control" placeholder="Address (Area or Street)" name="address" value="{{ $picked->address }}" required="">
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                    	<div class="form-group">
	                        <label>Select Country</label>
	                        <select class="form-control" name="country" id="country" onchange="getState()" required="">
	                          <option value="">Select Country</option>
	                          @foreach($countries as $country)
	                          	@if($picked->country_id == $country->id)
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
	                          	@foreach($states as $state)
	                              	@if($picked->state_id == $state->id)
	                              		<option value="{{ $state->id }}" selected="">{{ $state->name }}</option>
	                              	@else
	                              		<option value="{{ $state->id }}">{{ $state->name }}</option>
	                              	@endif
	                            @endforeach()
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
	                          	@foreach($cities as $city)
	                              	@if($picked->city_id == $city->id)
	                              		<option value="{{ $city->id }}" selected="">{{ $city->name }}</option>
	                              	@else
	                              		<option value="{{ $city->id }}">{{ $city->name }}</option>
	                              	@endif
	                            @endforeach()
	                        </select>
	                    	@if($errors->has('city'))
	                    	    <div class="error">{{ $errors->first('city') }}</div>
	                    	@endif
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Pincode</label>
	                        <input type="number" class="form-control" placeholder="Pincode" name="pincode" value="{{ $picked->pincode }}" required="">
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Contact Number</label>
	                        <input type="text" class="form-control" placeholder="Contact Number" name="mobile_number" value="{{ $picked->mobile_number }}" required="">
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Address Type</label>
	                        <div class="form-group">
	                          <select class="form-select" name="address_type" required="">
	                            <option value="">Address Type</option>
	                            <option value="Billing" @if($picked->type == 'Billing') selected @endif>Billing Address</option>
	                            <option value="Shipping" @if($picked->type == 'Shipping') selected @endif>Shipping Address</option>
	                          </select>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Set as Default</label>
	                        <div class="form-group">
	                          <select class="form-select" name="set_as_default" required="">
	                            <option value="No" @if($picked->set_as_default == 'No') selected @endif>No</option>
	                            <option value="Yes" @if($picked->set_as_default == 'Yes') selected @endif>Yes</option>
	                          </select>
	                        </div>
	                      </div>
	                    </div>
	                    
	                    <div class="col-md-12">
	                      <div class="form_btn">
	                        <button class="btn main-btn" type="submit">Update Profile</button>
	                      </div>
	                    </div>
                  	</div>
                </form>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</main>


@endsection
@section('front-scripts')

@endsection