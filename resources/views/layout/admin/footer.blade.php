<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<footer class="footer footer-static footer-light">
  <p class="clearfix mb-0 text-center"><span class="d-block d-md-inline-block mt-25">Copyright  &copy; 2021<a class="ml-25" href="#" target="_blank">Restaurant</a> | <span class="d-sm-inline-block"> All rights Reserved.</span></span>
  </p>
</footer>

@include('layout.admin.custom_js')
<script>
	document.getElementById('loading').style.display = 'none';
	ClassicEditor
	    .create( document.querySelector( '#description' ), {
	        extraPlugins: [ SimpleUploadAdapterPlugin ],
	    }) 
	    .catch( error => {
	        console.error( error );
	    } );
</script>
<script type="text/javascript">

	function convertToSlug()
	{ 
		var Text = $('#slug_content').val();
	    var slug = Text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
	    document.getElementById('slug').value = slug;
	}

	//-------------------- Get state By country --------------------//

    function getState(country_id = null) {
        var country_id = $('#country').val() ? $('#country').val() : country_id;
        $("#state").html('');
        $.ajax({
            url:"{{url('get/states')}}/"+country_id,
            type: "GET",
            dataType : 'json',
            beforeSend: function() {
		        document.getElementById('loading').style.display = 'block';
		    },
		    success: function(result) {
		        $('#state').html('<option value="">Select State</option>');
                $.each(result.data,function(key,state){
                    if(parseInt('{{ old('state') }}') == parseInt(state.id)) {
                        $("#state").append('<option value="'+state.id+'" selected>'+state.name+'</option>');
                    }else {
                        $("#state").append('<option value="'+state.id+'" >'+state.name+'</option>');
                    }
                });
	      	},
	      	error: function(response) {
	        	document.getElementById('loading').style.display = 'none';
	      	},
	      	complete: function() {
	        	document.getElementById('loading').style.display = 'none';
	      	}
        });
    }

    //-------------------- Get city By state --------------------//

    function getCity(city_id = null) {
        var state_id = $('#state').val() ? $('#state').val() : city_id;
        $("#city").html('');
        $.ajax({
            url:"{{url('get/cities/')}}/"+state_id,
            type: "GET",
            dataType : 'json',
            beforeSend: function() {
		        document.getElementById('loading').style.display = 'block';
		    },
		    success: function(result) {
		        $('#city').html('<option value="">Select City</option>');
                $.each(result.data,function(key,city){
                    if(parseInt('{{ old('city') }}') == parseInt(city.id)) {
                        $("#city").append('<option value="'+city.id+'" selected>'+city.name+'</option>');
                    }else {
                        $("#city").append('<option value="'+city.id+'" >'+city.name+'</option>');
                    }
                });
	      	},
	      	error: function(response) {
	        	document.getElementById('loading').style.display = 'none';
	      	},
	      	complete: function() {
	        	document.getElementById('loading').style.display = 'none';
	      	}
        });
    }

    //-------------------- Get Sub Category --------------------//

    function getSubCategories(cat_id = null) {
        var new_cat_id = $('#category').val() ? $('#category').val() : cat_id;
        $("#sub_category").html('');
        $.ajax({
            url:"{{url('sub/categories')}}/"+new_cat_id,
            type: "GET",
            dataType : 'json',
            beforeSend: function() {
		        document.getElementById('loading').style.display = 'block';
		    },
		    success: function(result) {
		        if(result.data.length > 0) {
		        	$('#sub_category').html('<option value="">Select Sub Category</option>');
		        	$.each(result.data,function(key,sub_cat){
		        	    if(parseInt('{{ old('sub_cat') }}') == parseInt(sub_cat.id)) {
		        	        $("#sub_category").append('<option value="'+sub_cat.id+'" selected>'+sub_cat.name+'</option>');
		        	    }else {
		        	        $("#sub_category").append('<option value="'+sub_cat.id+'" >'+sub_cat.name+'</option>');
		        	    }
		        	});
		        }else {
		        	$("#sub_category").append('<option value="" >Not found.</option>');
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

    function getSubCategoriesByArray(cat_id = null) {
        var cat_ids = $('#category').val() ? $('#category').val() : cat_id;
        $("#sub_category").html('');
        $.ajax({
            url:"{{url('sub/categories')}}",
            type: "POST",
            dataType : 'json',
            data: {
            	'_token':'{{ csrf_token() }}',
            	'ids'   : cat_ids
            },
            beforeSend: function() {
		        document.getElementById('loading').style.display = 'block';
		    },
		    success: function(result) {
		        if(result.data.length > 0) {
		        	$.each(result.data,function(key,sub_cat){
		        	    if(parseInt('{{ old('sub_cat') }}') == parseInt(sub_cat.id)) {
		        	        $("#sub_category").append('<option value="'+sub_cat.id+'" selected>'+sub_cat.name+'</option>');
		        	    }else {
		        	        $("#sub_category").append('<option value="'+sub_cat.id+'" >'+sub_cat.name+'</option>');
		        	    }
		        	});
		        }else {
		        	$("#sub_category").append('<option value="" >Not found.</option>');
		        }
                getFoodItems();
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

    function getFoodItems(categories = null, sub_categories = null) {
        var categories = $('#category').val() ? $('#category').val() : categories;
        var sub_categories = $('#sub_category').val() ? $('#sub_category').val() : sub_categories;
        // console.log(categories);
        // console.log(sub_categories);
        $("#food_items").html('');
        $.ajax({
            url:"{{url('food/items')}}",
            type: "POST",
            dataType : 'json',
            data: {
            	'_token':'{{ csrf_token() }}',
            	'categories'   : categories,
            	'sub_categories'   : sub_categories,
            },
            beforeSend: function() {
		        document.getElementById('loading').style.display = 'block';
		    },
		    success: function(result) {
		        if(result.data.length > 0) {
		        	$.each(result.data,function(key,sub_cat){
		        	    if(parseInt('{{ old('sub_cat') }}') == parseInt(sub_cat.id)) {
		        	        $("#food_items").append('<option value="'+sub_cat.id+'" selected>'+sub_cat.name+'</option>');
		        	    }else {
		        	        $("#food_items").append('<option value="'+sub_cat.id+'" >'+sub_cat.name+'</option>');
		        	    }
		        	});
		        }else {
		        	$("#food_items").append('<option value="" >Not found.</option>');
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
</script>
<script>
	$(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});
		$('.btn-file :file').on('fileselect', function(event, label) {
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    if( input.length ) {
		        input.val(log);
		    }
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function (e) {
		            $('#upload-logo').attr('src', e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#imgLogo").change(function(){
		    readURL(this);
		}); 	
	});

	$(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});
		$('.btn-file :file').on('fileselect', function(event, label) {
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    if( input.length ) {
		        input.val(log);
		    }
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function (e) {
		            $('#upload-favicon').attr('src', e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#imgFav").change(function(){
		    readURL(this);
		}); 	
	});

	$(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});
		$('.btn-file :file').on('fileselect', function(event, label) {
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    if( input.length ) {
		        input.val(log);
		    }
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function (e) {
		            $('#upload-img').attr('src', e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#imgSec").change(function(){
		    readURL(this);
		});
	});

	function dynamicBranchChangeImage(count, input) {
		if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#upload-img'+count).attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	        $('#document_name'+count).attr('required', true);
	    }
	}

	$("#banner-text-option").change(function () {
	var selected_option = $('#banner-text-option').val();
	if (selected_option === 'Yes') {
		$('#banner-text').show();
		$('#banner-textbox').attr('required', true);
	}
	if (selected_option != 'Yes') {
		$("#banner-text").hide();
		$('#banner-textbox').removeAttr('required');
	}
	});

	$(document).ready(function() {
		var max_fields      = 20; //maximum input boxes allowed
		var wrapper   		= $(".input-wrapper"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID
		var counter         = 2;
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				//$(wrapper).append('<div class="inner-wrapper-upload"><input type="text" name="docname'+ counter +'" class="form-control" placeholder="Document Name"/><div class="custom-file"><input type="file"  name="docup'+ counter +'" class="custom-file-input" id="customFile" /><label class="custom-file-label" for="customFile">Choose file</label></a></div><a href="#" class="remove_field"><i class="fas fa-plus"></i></div>');
				$(wrapper).append('<div class="inner-wrapper-upload col-md-2"><input type="text" name="document_name[]" class="form-control" placeholder="Document Name" id="document_name'+x+'"/><div class="custom-img-uploader"><div class="input-group"><span class="input-group-btn"><span class="btn-file"><input type="file" name="file[]" id="file'+x+'" onchange="dynamicBranchChangeImage('+x+', this)"><img id="upload-img'+x+'" class="img-upload-block" src="{{asset('')}}/admin/images/plus-upload.jpg"/></span></span></div></div><a href="#" class="remove_field"><i class="far fa-trash-alt"></i></a></div>');
			}
		});
		
		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
	});

	$(document).ready(function() {
		var max_fields      = 20; //maximum input boxes allowed
		var wrapper   		= $(".input-wrapper-food"); //Fields wrapper
		var add_button      = $(".add_field_button_food"); //Add button ID
		var counter         = 2;
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="inner-wrapper-upload col-md-2"><div class="custom-img-uploader"><div class="input-group"><span class="input-group-btn"><span class="btn-file"><input type="file" id="imgSec" name="image[]" onchange="dynamicBranchChangeImage('+x+', this)" required><img id="upload-img'+x+'" class="img-upload-block" src="{{ asset('') }}/admin/images/plus-upload.jpg"/></span></span></div></div><a href="#" class="remove_field_food"><i class="far fa-trash-alt"></i></a></div>');
			}
		});
		
		$(wrapper).on("click",".remove_field_food", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
	});

	$(document).ready(function() {
		var max_fields      = 5; //maximum input boxes allowed
		var wrapper   		= $(".add-gallery-field"); //Fields wrapper
		var add_button      = $(".add_field_button_gallery"); //Add button ID
		var counter         = 2;
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			var options = '';
			$.ajax({
	            url:"{{url('admin/get/categories/gallery')}}",
	            type: "GET",
	            dataType : 'json',
	            beforeSend: function() {
	                document.getElementById('loading').style.display = 'block';
	            },
	            success: function(result) {
	            	options += '<option value="">Select Category</option>';
					$.each(result.data,function(key,category){
						options += '<option value="'+category.id+'">'+category.name+'</option>';
					});
					console.log(options);
					if(x < max_fields){ //max input box allowed
						x++; //text box increment
						$(wrapper).append(`                  <div class="row ">
		                    <div class="col-md-2">
		                      <div class="form-group">
		                        <label for="customFile">Gallery Image</label>
		                        <div class="row input-wrapper-food">
		                          <div class="inner-wrapper-upload col-md-8">
		                            <div class="custom-img-uploader">
		                              <div class="input-group">
		                                <span class="input-group-btn">
		                                  <span class="btn-file">
		                                    <input type="file" name="image[]" id="imgSec" required="">
		                                    <img id='upload-img${x}'  onchange="dynamicBranchChangeImage('${x}', this)" class="img-upload-block" src="{{ asset('') }}/admin/images/plus-upload.jpg"/>
		                                  </span>
		                                </span>
		                              </div>
		                            </div>
		                            <a href="javascript:void(0)" class="remove_field_food"><i class="far fa-trash-alt"></i></a>
		                          </div>
		                        </div>
		                      </div>
		                    </div>
		                    <div class="col-md-5">
		                      <div class="form-group">
		                        <label>Category</label>
		                        <select class="select2 form-control" name="category[]" required="">
		                          ${options}
		                        </select>
		                      </div>
		                      <div class="form-group">
		                        <label>Name</label>
		                        <input type="text" class="form-control" name="name[]" placeholder="Banner Name" required/>
		                      </div>
		                    </div>
		                    <div class="col-md-5">
		                      <div class="form-group">
		                        <label>Remark</label>
		                        <input type="text" class="form-control" name="remark[]" placeholder="Remark"/>
		                      </div>
		                      <div class="form-group">
		                        <label>Select Status</label>
		                        <select class="form-control" name="status[]" required="">
		                          <option value="Yes">Active</option>
		                          <option value="No">Inactive</option>
		                        </select>
		                      </div>
		                    </div>
		                  
		                  </div>`);
					}

	            },
	            error: function(response) {
	            	alert(response);
	              	document.getElementById('loading').style.display = 'none';
	            },
	            complete: function() {
	              	document.getElementById('loading').style.display = 'none';
	            }
	        });
			
		});
		
		$('#remove-gallery').on("click",".remove_field_gallery", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
	});


	$(document).ready(function() {
		var max_fields      = 20; //maximum input boxes allowed
		var wrapper   		= $(".input-wrapper-product"); //Fields wrapper
		var add_button      = $(".add_field_button_product"); //Add button ID
		var counter         = 2;
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="row align-items-end inner-wrapper-upload"><div class="col-md-3"><div class="form-group"><label>Select Product Category</label><select class="form-control"><option>Select Product Category</option><option>Spices</option><option>Dried Fruits</option><option>Nuts & Seeds</option></select></div></div><div class="col-md-3"><div class="form-group"><label>Product Name</label><input type="text" class="form-control" placeholder="Product Name"/></div></div><div class="col-md-3"><div class="form-group"><label>Product Quantity</label><input type="text" class="form-control" placeholder="Product Quantity"/></div></div><div class="col-md-1"><div class="form-group"><a href="#" class="remove_field_product"><i class="far fa-trash-alt"></i></a></div></div></div>');
			}
		});
		
		$(wrapper).on("click",".remove_field_product", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
		})
	});

	$(document).ready(function() {
		var max_fields      = 20; //maximum input boxes allowed
		var wrapper   		= $(".input-wrapper-purchase"); //Fields wrapper
		var add_button      = $(".add_field_button_purchase"); //Add button ID
		var counter         = 2;
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="row align-items-end inner-wrapper-upload"><div class="col-md-2"><div class="form-group"><label>Select Product Category</label><select class="form-control"><option>Select Product Category</option><option>Spices</option><option>Dried Fruits</option><option>Nuts & Seeds</option></select></div></div><div class="col-md-2"><div class="form-group"><label>Select Product</label><select class="form-control"><option>Select Product</option><option>Rice</option><option>Plain Flour</option><option>Wheat flour</option></select></div></div><div class="col-md-2"><div class="form-group"><label>Product Quantity</label><input type="text" class="form-control" placeholder="Product Quantity"/></div></div><div class="col-md-2"><div class="form-group"><label>Select Quantity Type</label><select class="form-control"><option>Select Quantity Type</option><option>KG</option><option>Unit</option><option>Pcs</option><option>Box</option><option>Litres</option></select></div></div><div class="col-md-1"><div class="form-group"><label>Price</label><input type="text" class="form-control" placeholder="Price"/></div></div><div class="col-md-1"><div class="form-group"><label>Discount (%)</label><input type="text" class="form-control" placeholder="Discount (%)"/></div></div><div class="col-md-1"><div class="form-group"><label>Final Price</label><input type="text" class="form-control" placeholder="Final Price"/></div></div><div class="col-md-1"><div class="form-group"><a href="#" class="remove_field_purchase"><i class="far fa-trash-alt"></i></a></div></div></div>');
			}
		});
		
		$(wrapper).on("click",".remove_field_purchase", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
		})
	});

	$(document).ready(function() {
		var max_fields      = 20; //maximum input boxes allowed
		var wrapper   		= $(".input-wrapper-supplies"); //Fields wrapper
		var add_button      = $(".add_field_button_supplies"); //Add button ID
		var counter         = 2;
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="row align-items-end inner-wrapper-upload"><div class="col-md-3"><div class="form-group"><label>Select Product</label><select class="form-control"><option>Select Product</option><option>Rice</option><option>Plain Flour</option><option>Wheat flour</option></select></div></div><div class="col-md-2"><div class="form-group"><label>Available Quantity</label><input type="text" class="form-control" placeholder="Available Quantity" readonly/></div></div><div class="col-md-2"><div class="form-group"><label>Enter Supply Qty</label><input type="text" class="form-control" placeholder="Enter Supply Qty"/></div></div><div class="col-md-2"><div class="form-group"><label>Remaining Qty</label><input type="text" class="form-control" placeholder="Remaining Qty" readonly/></div></div><div class="col-md-1"><div class="form-group"><a href="#" class="remove_field_supplies"><i class="far fa-trash-alt"></i></a></div></div></div>');
			}
		});
		
		$(wrapper).on("click",".remove_field_supplies", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
		})
	});

	$(document).ready(function() {
		var max_fields      = 20; //maximum input boxes allowed
		var wrapper   		= $(".input-wrapper-orders"); //Fields wrapper
		var add_button      = $(".add_field_button_orders"); //Add button ID
		var counter         = 2;
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="row align-items-end inner-wrapper-orders"><div class="col-md-3"><div class="form-group"><label>Search Food Item</label><input type="text" class="form-control" placeholder="Search Food Item"/></div></div><div class="col-md-2"><div class="form-group"><label>Select Quantity Type</label><select class="form-control"><option>Select Quantity Type</option><option>Full</option><option>Half</option><option>Quarter</option><option>Per Plate</option></select></div></div><div class="col-md-1"><div class="form-group"><label>Price</label><input type="text" class="form-control" placeholder="Price" readonly/></div></div><div class="col-md-1"><div class="form-group"><label>Discount</label><input type="text" class="form-control" placeholder="Discount" readonly/></div></div><div class="col-md-1"><div class="form-group"><label>Final Price</label><input type="text" class="form-control" placeholder="Final Price" readonly/></div></div><div class="col-md-1"><div class="form-group"><label>Add Qty</label><input type="text" class="form-control" placeholder="Add Qty"/></div></div><div class="col-md-1"><div class="form-group"><label>Total Price</label><input type="text" class="form-control" placeholder="Total Price" readonly/></div></div><div class="col-md-1"><div class="form-group"><a href="#" class="remove_field_orders"><i class="far fa-trash-alt"></i></a></div></div></div>');
			}
		});
		
		$(wrapper).on("click",".remove_field_orders", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
		})
	});
</script>

<script>
	manageLargeContent();
	function manageLargeContent() {
		setTimeout(function() {
		    // Configure/customize these variables.
		    var showChar = 40;  // How many characters are shown by default
		    var ellipsestext = "";
		    var moretext = "...";
		    var lesstext = "less";
		    $('.more-text').each(function() {
		        var content = $(this).html();
		        if(content.length > showChar) {
		            var c = content.substr(0, showChar);
		            var h = content.substr(showChar, content.length - showChar);
		            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
		 
		            $(this).html(html);
		        }
		 
		    });
		 
		    $(".morelink").click(function(){
		        if($(this).hasClass("less")) {
		            $(this).removeClass("less");
		            $(this).html(moretext);
		        } else {
		            $(this).addClass("less");
		            $(this).html(lesstext);
		        }
		        $(this).parent().prev().toggle();
		        $(this).prev().toggle();
		        return false;
		    });
		}, 2000);
	}

	//--------------------Price Get AfterDiscount from Amount Given by Discount. --------------------//

	function applyDiscount(id) {
		var amount = $('#price'+id).val();
        var discount = $('#discount'+id).val();
        var after_amount = amount - (amount * (discount / 100));
        $("#final_price"+id).val(parseFloat(after_amount).toFixed());
	}
    
	$('.custom-switch #stockswitch').change(function(){
	    if ($(this).is(':checked')) {
	        $('.stock-block').show();
	    }else{
	        $('.stock-block').hide();
	    }
	});

	$("#fooditems-list").on("click",".show-varient",function(e) {
	    e.preventDefault();
	    $(this).closest("tr").nextUntil(".parentvariant").toggleClass("open");
	});
</script>
</body>

</html>