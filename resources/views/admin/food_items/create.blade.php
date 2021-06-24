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
                <li class="breadcrumb-item active">Add Food Item</li>
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
              <h4 class="card-title">Add Food Item</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/food/items') }}" method="POST" enctype="multipart/form-data">
              	@csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="customFile">Add Food Images</label>
                      <div class="row input-wrapper-food">
                        <div class="inner-wrapper-upload col-md-2">
                          <div class="custom-img-uploader">
                            <div class="input-group">
                              <span class="input-group-btn">
                                <span class="btn-file">
                                  <input type="file" name="image[]" id="imgSec" onchange="dynamicBranchChangeImage(1, this)" required="">
                                  <img id='upload-img1' class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg"/>
                                  	@if($errors->has('image'))
    								    <div class="error">{{ $errors->first('image') }}</div>
    								@endif
                                </span>
                              </span>
                            </div>
                          </div>
                          <a class="add_field_button_food"><i class="fas fa-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Category</label>
                      <select class="form-control" name="category" id="category" onchange="getSubCategories()" required="">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        	<option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                      @if($errors->has('category'))
					    <div class="error">{{ $errors->first('category') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Sub Category</label>
                      <select class="form-control" name="sub_category" id="sub_category">
                      </select>
                      @if($errors->has('sub_category'))
						    <div class="error">{{ $errors->first('sub_category') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Food Item Name</label>
                      <input type="text" class="form-control" name="name" id="slug_content" value="{{ old('name') }}" placeholder="Food Item Name" onkeyup="convertToSlug()" required="" />
                      @if($errors->has('name'))
						    <div class="error">{{ $errors->first('name') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>URL Slug</label>
                      <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" placeholder="URL Slug" readonly="" />
                      @if($errors->has('slug'))
						    <div class="error">{{ $errors->first('slug') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Remark</label>
                      <input type="text" class="form-control" name="remark" value="{{ old('remark') }}" placeholder="Remark"/>
                      @if($errors->has('remark'))
					    <div class="error">{{ $errors->first('remark') }}</div>
					@endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Meta Title</label>
                      <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="Meta Title" required="" />
                    	@if($errors->has('meta_title'))
						    <div class="error">{{ $errors->first('meta_title') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Meta keyword</label>
                      <textarea class="form-control" rows="3" placeholder="Meta keyword" name="keyword" required="">{{ old('keyword') }}</textarea>
                        @if($errors->has('keyword'))
						    <div class="error">{{ $errors->first('keyword') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Meta Description</label>
                      <textarea class="form-control" rows="3" placeholder="Meta Description" name="description" required="">{{ old('description') }}</textarea>
                      @if($errors->has('description'))
						    <div class="error">{{ $errors->first('description') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <div class="custom-control custom-control-primary custom-switch">
                        <p class="mb-50">Enable Stock</p>
                        <input type="checkbox" class="custom-control-input" name="stock" id="stockswitch" />
                        <label class="custom-control-label" for="stockswitch"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <div class="custom-control custom-control-primary custom-switch">
                        <p class="mb-50">Enable Inventory</p>
                        <input type="checkbox" class="custom-control-input" name="inventory" id="inventory" />
                        <label class="custom-control-label" for="inventory"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <div class="custom-control custom-control-primary custom-switch">
                        <p class="mb-50">Enable COD</p>
                        <input type="checkbox" class="custom-control-input" name="cod" id="cod" />
                        <label class="custom-control-label" for="cod"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <div class="custom-control custom-control-primary custom-switch">
                        <p class="mb-50">Enable Home Delivery</p>
                        <input type="checkbox" class="custom-control-input" name="home_delivery" id="homedelivery" />
                        <label class="custom-control-label" for="homedelivery"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <div class="custom-control custom-control-primary custom-switch">
                        <p class="mb-50">Enable Takeaway</p>
                        <input type="checkbox" class="custom-control-input" name="takeaway" id="takeaway" />
                        <label class="custom-control-label" for="takeaway"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Delivery Time</label>
                      <input type="text" class="form-control" name="delivery_time" value="{{ old('delivery_time') }}" placeholder="Delivery Time" required="" />
                      @if($errors->has('delivery_time'))
                          <div class="error">{{ $errors->first('delivery_time') }}</div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="input-wrapper-varient">
                  <h5>Create Food Variant</h5>
                  <div class="row align-items-end inner-wrapper-upload">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Select Quantity Type</label>
                        <select class="form-control" name="quantity[]" required="">
                        	<option value="">Select Quantity</option>
                          @foreach($quantities as $quantity)
                          	<option value="{{ $quantity->id }}">{{ $quantity->type }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>MRP</label>
                        <input type="number" class="form-control" name="price[]" id="price1" placeholder="MRP" onkeyup="applyDiscount(1)" required="" />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Discount (%)</label>
                        <input type="text" class="form-control" name="discount[]" id="discount1" onkeyup="applyDiscount(1)" placeholder="Discount (%)"/>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Offer Price</label>
                        <input type="text" class="form-control" name="final_price[]" id="final_price1" placeholder="Offer Price"/>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="stock-block">
                        <div class="form-group">
                          <label>Enter Stock Quantity</label>
                          <input type="text" class="form-control" name="stock_quantity[]" placeholder="Enter Stock Quantity"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                        <a class="add_field_button_varient"><i class="fas fa-plus"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Add Food Item</button>
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
@if($errors->any())
	<script type="text/javascript">
		setTimeout(function() {
			getSubCategories('{{ old('category') }}');
		}, 2000);
	</script>
@endif
@endsection
@section('page-scripts')
<script type="text/javascript">
	$(document).ready(function() {
		var max_fields      = 20; //maximum input boxes allowed
		var wrapper   		= $(".input-wrapper-varient"); //Fields wrapper
		var add_button      = $(".add_field_button_varient"); //Add button ID
		var counter         = 2;
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){
				x++;
				var option;
		        $.ajax({
		            url:"{{url('quantity/list')}}",
		            type: "GET",
		            dataType : 'json',
		            beforeSend: function() {
				        document.getElementById('loading').style.display = 'block';
				    },
				    success: function(result) {
				        if(result.data.length > 0) {
	        				$.each(result.data,function(key,quantity){
	        	        	    option += '<option value="'+quantity.id+'">'+quantity.type+'</option>'
	        	        	});
	        	        	$(wrapper).append('<div class="row align-items-end inner-wrapper-upload"><div class="col-md-2">  <div class="form-group"><label>Select Quantity Type</label><select class="form-control" name="quantity[]" required><option value="">Select Quantity Type</option>'+option+'</select></div></div><div class="col-md-2"><div class="form-group"><label>MRP</label><input type="number" class="form-control" placeholder="MRP" name="price[]" id="price'+x+'" onkeyup="applyDiscount('+x+')" required/></div></div><div class="col-md-2"><div class="form-group"><label>Discount (%)</label><input type="text" class="form-control" placeholder="Discount (%)" name="discount[]" id="discount'+x+'" onkeyup="applyDiscount('+x+')" /></div></div><div class="col-md-2"><div class="form-group"><label>Offer Price</label><input type="text" class="form-control" placeholder="Offer Price" name="final_price[]" id="final_price'+x+'" required/></div></div><div class="col-md-2"><div class="stock-block"><div class="form-group"><label>Enter Stock Quantity</label><input type="text" class="form-control" placeholder="Enter Stock Quantity" name="stock_quantity[]" /></div></div></div><div class="col-md-1"><div class="form-group"><a href="#" class="remove_field_varient"><i class="far fa-trash-alt"></i></a></div></div></div>');
				        }else {
				        	swal('', 'Quantities not found.', 'error');
				        }
		                
			      	},
			      	error: function(response) {
			        	document.getElementById('loading').style.display = 'none';
			        	swal('', response, 'error');
			      	},
			      	complete: function() {
			        	document.getElementById('loading').style.display = 'none';
			      	}
		        });
			}
		});
		
		$(wrapper).on("click",".remove_field_varient", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
		})
	});
</script>
@endsection