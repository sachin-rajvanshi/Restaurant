@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Checkout</h1>
           <p></p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Checkout</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="custom-section">
    <div class="container">
      	<form method="post" action="{{ url('create/order') }}" id="create_order">
      	<div class="row">
      		@csrf
      		<input type="hidden" name="total_price" value="{{ $total_price }}">
      		<input type="hidden" name="offer_price" value="{{ $offer_price }}">
      		<input type="hidden" name="discount" value="{{ $discount }}">
      		<input type="hidden" name="discount_amount" value="{{ $discount_amount }}">
      		<input type="hidden" name="tax_amount" value="{{ $tax }}">
      		<input type="hidden" name="tax_percent" value="{{ $tax_discount }}">
      		<input type="hidden" name="coupon_id" value="{{ $coupon_id }}">
      		<input type="hidden" name="payment_mode" id="render_payment_mode">
	        <div class="col-md-8">
	          <div class="address-info-block">
	            <h4 class="checkout-heading">Shipping & Billing Info</h4>
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
							<label class="label label-control">Select Address</label>
							<select class="form-control" id="address-book" onchange="showAddressInfo()">
							  <option value="">Choose Address</option>
							  @foreach($address_books as $book)
							  <option value="{{ $book->id }}">{{ $book->address }}</option>
							  @endforeach
							</select>
						</div>
	                </div>
					<div class="col-md-12">
						<div class="form-group">
						  <label>Name</label>
						  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Name" required="" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label>Email Id</label>
						  <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email Id"/>
						</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
					  <label>Phone Number</label>
					  <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}" placeholder="Phone Number"/>
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
		                  <label>Address</label>
		                  <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" placeholder="Address"/>
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                  <label>Pincode</label>
		                  <input type="text" class="form-control" name="pincode" id="pincode" value="{{ old('pincode') }}" placeholder="Pincode"/>
		                </div>
		              </div>
		              <div class="col-md-12" id="address_save">
		                <div class="form-group">
		                  <div class="custom-control custom-checkbox">
		                    <input type="checkbox" class="custom-control-input" name="address_save"  />
		                    <label class="custom-control-label" for="cardinfosave">Save address to my addresses</label>
		                  </div>
		                </div>
		              </div>
	            </div>
	          </div>
	          <div class="checkout-payments collapse-icon">
	            <h4 class="checkout-heading">Payment Method</h4>
	            <div class="collapse-margin" id="accordionExample">
	              <div class="card">
	                <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><span class="headingaccor">PayPal <img src="{{ asset('') }}assets/img/paypal.png" alt=""></span></div>
	                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
	                  <div class="card-body">
	                    <div class="custom-control custom-radio">
	                      <input type="radio" id="payment-paypal" name="payment" class="custom-control-input"/>
	                      <label class="custom-control-label" for="payment-paypal">Pay with Paypal</label>
	                    </div>
	                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
	                    <div class="payment-button">
	                      <button class="btn btn-success waves-effect waves-float waves-light" type="submit">Proceed to PayPal</button>
	                    </div>
	                  </div>
	                </div>
	              </div>
	              <div class="card">
	                <div class="card-header" id="headingTwo" data-toggle="collapse" role="button" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><span class="headingaccor">Payments <img src="{{ asset('') }}assets/img/payment.png" alt=""></span></div>
	                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
	                  <div class="card-body">
	                    <div class="row">
	                      <div class="col-md-12">
	                        <div class="form-group">
	                          <div class="custom-control custom-radio">
	                            <input type="radio" id="payment-card" name="payment" class="custom-control-input"/>
	                            <label class="custom-control-label" for="payment-card">Pay with Credit / Debit Card</label>
	                          </div>
	                        </div>
	                      </div>
	                      <div class="col-md-6">
	                        <div class="form-group">
	                          <label>Enter Card Number</label>
	                          <input type="text" class="form-control" placeholder="Enter Card Number"/>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="row">
	                      <div class="col-md-3">
	                        <div class="form-group">
	                          <label>Expire Date</label>
	                          <input type="text" class="form-control" placeholder="MM/YY"/>
	                        </div>
	                      </div>
	                      <div class="col-md-3">
	                        <div class="form-group">
	                          <label>Enter CVV</label>
	                          <input type="text" class="form-control" placeholder="CVV"/>
	                        </div>
	                      </div>
	                      <div class="col-md-12" id=>
	                        <div class="form-group">
	                          <div class="custom-control custom-checkbox">
	                            <input type="checkbox" class="custom-control-input" id="cardinfosave" />
	                            <label class="custom-control-label" for="cardinfosave">Save payment information to my account for future purchases.</label>
	                          </div>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="payment-button">
	                      <button class="btn btn-success waves-effect waves-float waves-light" type="submit">Place Order</button>
	                    </div>
	                  </div>
	                </div>
	              </div>
	              <div class="card">
	                <div class="card-header" id="headingThree" data-toggle="collapse" role="button" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><span class="headingaccor">Payment Getway <img src="{{ asset('') }}assets/img/stripe.png" alt=""></span></div>
	                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
	                  <div class="card-body">
	                    <div class="form-group">
	                      <div class="custom-control custom-radio">
	                        <input type="radio" id="payment-rozorpay" name="payment" class="custom-control-input"/>
	                        <label class="custom-control-label" for="payment-rozorpay">Pay with Stripe</label>
	                      </div>
	                    </div>
	                    <div class="payment-button">
	                      <button class="btn btn-success waves-effect waves-float waves-light" type="submit">Proceed with Stripe</button>
	                    </div>
	                  </div>
	                </div>
	              </div>
	              <div class="card">
	                <div class="card-header" id="headingFour" data-toggle="collapse" role="button" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><span class="headingaccor">UPI Payments</span></div>
	                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
	                  <div class="card-body">
	                    <div class="row">
	                      <div class="col-md-12">
	                        <div class="form-group">
	                          <div class="custom-control custom-radio">
	                            <input type="radio" id="payment-upi" name="payment" class="custom-control-input"/>
	                            <label class="custom-control-label" for="payment-upi">Pay with UPI</label>
	                          </div>
	                        </div>
	                      </div>
	                      <div class="col-md-6">
	                        <div class="form-group">
	                          <label>Enter UPI Id</label>
	                          <input type="text" class="form-control" placeholder="Enter UPI Id"/>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="payment-button">
	                      <button class="btn btn-success waves-effect waves-float waves-light" type="submit">Proceed with UPI</button>
	                    </div>
	                  </div>
	                </div>
	              </div>
	              <div class="card">
	                <div class="card-header" id="headingFive" data-toggle="collapse" role="button" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><span class="headingaccor">Pay Offline</span></div>
	                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
	                  <div class="card-body">
	                    <div class="row">
	                      <div class="col-md-12">
	                        <div class="form-group">
	                          <div class="custom-control custom-radio">
	                            <input type="radio" id="payment-banktransfer" name="offline_payment" class="custom-control-input" value="bank-transfer" />
	                            <label class="custom-control-label" for="payment-banktransfer">Bank Transfer</label>
	                          </div>
	                        </div>
	                      </div>
	                      <div class="col-md-12">
	                        <div class="form-group">
	                          <div class="custom-control custom-radio">
	                            <input type="radio" id="payment-cash" name="offline_payment" value="cash" class="custom-control-input"/>
	                            <label class="custom-control-label" for="payment-cash">Cash</label>
	                          </div>
	                        </div>
	                      </div>
	                      <div class="col-md-12">
	                        <div class="form-group">
	                          <div class="custom-control custom-radio">
	                            <input type="radio" id="payment-cheque" name="offline_payment" value="cheque" class="custom-control-input"/>
	                            <label class="custom-control-label" for="payment-cheque">Cheque / DD</label>
	                          </div>
	                        </div>
	                      </div>
	                      <div class="col-md-12">
	                        <div class="form-group">
	                          <div class="custom-control custom-radio">
	                            <input type="radio" id="payment-pos" name="offline_payment" value="pos" class="custom-control-input"/>
	                            <label class="custom-control-label" for="payment-pos">POS</label>
	                          </div>
	                        </div>
	                      </div>
	                      <div class="col-md-12">
	                        <div class="form-group">
	                          <div class="custom-control custom-radio">
	                            <input type="radio" id="payment-wallet" name="offline_payment" value="wallet" class="custom-control-input"/>
	                            <label class="custom-control-label" for="payment-wallet">Wallet</label>
	                          </div>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="payment-button">
	                      <button class="btn btn-success waves-effect waves-float waves-light" type="button" id="offline_payment">Place Order</button>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	    </form>
        <div class="col-md-4">
          <div class="cart-sidebar">
            <h4>Cart Review</h4>
            <ul>
              <li><b>Subtotal:</b> <span>$ {{ $sub_total }}</span></li>
              <li><b>Taxes ({{ $tax_discount }}%):</b> <span>$ {{ $tax }}</span></li>
              <li><b>Discount ({{ $discount }}%):</b> <span>$ {{ $discount_amount }}</span></li>
              <li><b>Total:</b> <span>$ {{ $offer_price }}</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript">
	setTimeout(function() {
		getState('{{ old('country') }}');
		getCity('{{ old('state') }}');
	}, 2000);
</script>
@endsection
@section('front-scripts')
<script type="text/javascript">
	$(document).ready(function(){
        $("#offline_payment").click(function(){
            var offline_payment_mode = $("input[name='offline_payment']:checked").val();
            console.log(offline_payment_mode);
            if(offline_payment_mode == '' || typeof offline_payment_mode === 'undefined') {
            	swal('', 'Payment mode must be required.', 'warning');
            	return false;
            }
            if(offline_payment_mode != 'cash') {
            	swal('', 'Please select cash method only, other payment mode are in under process.', 'warning');
            	return false;
            }
            var check = checkOutFormValidation();
            if(check) {
            	document.getElementById('render_payment_mode').value = offline_payment_mode;
            	document.getElementById('create_order').submit();
            }
            
        });
    });

    function checkOutFormValidation() {
    	var name = $('#name').val();
    	var email = $('#email').val();
    	var mobile_number = $('#mobile_number').val();
    	var country = $('#country').val();
    	var state = $('#state').val();
    	var city = $('#city').val();
    	var address = $('#address').val();
    	var pincode = $('#pincode').val();
    	if(name == '') {
    		swal('', 'Name field must be required.', 'warning');
    		return false;
    	}
    	if(email == '') {
    		swal('', 'Email field must be required.', 'warning');
    		return false;
    	}
    	if(mobile_number == '') {
    		swal('', 'Mobile number field must be required.', 'warning');
    		return false;
    	}
    	if(country == '') {
    		swal('', 'Country field must be required.', 'warning');
    		return false;
    	}
    	if(state == '') {
    		swal('', 'State field must be required.', 'warning');
    		return false;
    	}
    	if(city == '') {
    		swal('', 'City field must be required.', 'warning');
    		return false;
    	}
    	if(address == '') {
    		swal('', 'Address field must be required.', 'warning');
    		return false;
    	}
    	if(pincode == '') {
    		swal('', 'Pincode field must be required.', 'warning');
    		return false;
    	}
    	return true;
    }

    function showAddressInfo() {
        var id = $('#address-book').val();
        document.getElementById('address_save').style.display = 'none';
        if(id) {
          $.ajax({
            url:"{{url('user/address/book')}}/"+id,
            type: "GET",
            dataType : 'json',
            success: function(result){
				document.getElementById('address').value = result.address;
				document.getElementById('pincode').value = result.pincode;
				document.getElementById('mobile_number').value = result.mobile_number;
              	getCountry(result.country_id);
              	getState(result.country_id, result.state_id);
				getCity(result.state_id, result.city_id);
            }
          });
        }else {
          	document.getElementById('address').value = '';
			document.getElementById('pincode').value = '';
			document.getElementById('mobile_number').value = '';
          $("select#country").val('0'); 
          $("select#state").val('0'); 
          $("select#city").val('0'); 
           document.getElementById('address_save').style.display = 'block';
        }
      }
</script>
@endsection