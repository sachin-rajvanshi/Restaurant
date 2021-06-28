<script src="{{ asset('') }}assets/js/modernizr-3.5.0.min.js"></script>
<script src="{{ asset('') }}assets/js/jquery-1.12.4.min.js"></script>
<script src="{{ asset('') }}assets/js/popper.min.js"></script>
<script src="{{ asset('') }}assets/js/bootstrap.min.js"></script>
<script src="{{ asset('') }}assets/js/jquery.slicknav.min.js"></script>
<script src="{{ asset('') }}assets/js/owl.carousel.min.js"></script>
<script src="{{ asset('') }}assets/js/slick.min.js"></script>
<script src="{{ asset('') }}assets/js/wow.min.js"></script>
<script src="{{ asset('') }}assets/js/jquery.magnific-popup.js"></script>
<script src="{{ asset('') }}assets/js/gijgo.min.js"></script>
<script src="{{ asset('') }}assets/js/jquery.sticky.js"></script>
<script src="{{ asset('') }}assets/js/jquery.counterup.min.js"></script>
<script src="{{ asset('') }}assets/js/jquery.ajaxchimp.min.js"></script>
<script src="{{ asset('') }}assets/js/main.js"></script>
<script src="{{ asset('') }}admin/toasts/dist/toast.min.js"></script>
<script type="text/javascript">
    function quantityIncrement() {
        var quantity = $('#food_quantity').val();
        var price    = $('#old_price').val();
        var ingredient_total = $('#ingredient_total').val();
        var total_qty = parseInt(quantity) + 1;
        var total_price = (parseInt(total_qty) * parseInt(price)) + parseInt(ingredient_total) ;
        document.getElementById('food_quantity').value = parseInt(total_qty);
        document.getElementById('cart_final_price').value = parseInt(total_price);
        var final    = $('#cart_final_price').val();
        document.getElementById('show_order_total_price').innerHTML = parseInt(final);
    } 

    function quantityDecrease() {
        var quantity = $('#food_quantity').val();
        var price    = $('#old_price').val();
        var ingredient_total = $('#ingredient_total').val();
        if(parseInt(quantity) == 1) {
            var total_price = parseInt(quantity) * parseInt(price);
            document.getElementById('cart_final_price').value = parseInt(total_price) + parseInt(ingredient_total);
            var final    = $('#cart_final_price').val();
            document.getElementById('show_order_total_price').innerHTML = parseInt(final);
            return false;
        }
        var total_qty = parseInt(quantity) - 1;
        var total_price = parseInt(total_qty) * parseInt(price);
        document.getElementById('food_quantity').value = parseInt(total_qty);
        document.getElementById('cart_final_price').value = parseInt(total_price) + parseInt(ingredient_total);
        var final    = $('#cart_final_price').val();
        document.getElementById('show_order_total_price').innerHTML = parseInt(final);
    }


    function managePriceByQuantityIncrement(id) {
        var quantity = $('#food_quantity'+id).val();
        var total_qty = parseInt(quantity) + 1;
        updateFoodQuantity(id, parseInt(total_qty));
    } 

    function managePriceByQuantityDecrement(id) {
        var quantity = $('#food_quantity'+id).val();
        var total_qty = parseInt(quantity) == 1 ? quantity : parseInt(quantity) - 1;
        updateFoodQuantity(id, parseInt(total_qty));
    }

    function  manageVarientType(amount) {
        var varient_price = $("#varient_type").find(':selected').attr('price');
        document.getElementById('old_price').value = varient_price;
        document.getElementById('show_old_cart_price').innerHTML = varient_price;
        var quantity = $('#food_quantity').val();
        var price    = $('#old_price').val();
        var ingredient_total = $('#ingredient_total').val();
        var total_price = parseInt(quantity) * parseInt(price);
        document.getElementById('cart_final_price').value = total_price + parseInt(ingredient_total);
        var final    = $('#cart_final_price').val();
        document.getElementById('show_order_total_price').innerHTML = final;
    }

    function addIngredientsAmount(id, price) {
        var ingredient_total = $('#ingredient_total').val();
        var checkbox = document.getElementById('ingredient'+id);
        var final    = $('#cart_final_price').val();
        var total; 
        if(checkbox.checked == true) {
            total = parseInt(ingredient_total) + parseInt(price);
            final = parseInt(final) + parseInt(price);

        }else {
            total = parseInt(ingredient_total) - parseInt(price);
            final = parseInt(final) - parseInt(price);
        }
        document.getElementById('ingredient_total').value = total;
        document.getElementById('cart_final_price').value = parseInt(final);
        document.getElementById('show_order_total_price').innerHTML = parseInt(final);
    }   

    function openCartModel(id) {
      $.ajax({
        url: '{{ url('food/cart/model') }}',
        method: "POST",
        data: {
         "_token": "{{ csrf_token() }}",
         'id': id,
        },
        beforeSend: function() {
          document.getElementById('loading').style.display = 'block';
        },
        success: function(response) {
          $('#cart-model-data').html(response);
          setTimeout(function() {
              $('#addIngredients').modal('show');
          }, 1000);
        },
        error: function(response) {
          alert(response);
          document.getElementById('loading').style.display = 'none';
        },
        complete: function() {
          document.getElementById('loading').style.display = 'none';
        }
      })
    }

    function foodAddOncart(id) {
        var food_id         = $('#food_id').val();
        var varient_type_id = $('#varient_type').val();
        var food_price      = $('#old_price').val();
        var addon_price     = $('#ingredient_total').val();
        var total_price     = $('#cart_final_price').val();
        var quantity        = $('#food_quantity').val();
        var food_request    = $('#food_request').val();
        var level           = null;
        var ingredients_ids     = new Array();
        $("[name='addon_varients']").each(function (index, data) {
            if (data.checked) {
                ingredients_ids.push(data.value);
            }
        }); 
        $("[name='level']").each(function (index, data) {
            if (data.checked) {
                level = data.value;
            }
        }); 
        if(food_id == '' || food_id == null) {
            swal('', 'Invalid Selected Food Item.', 'error');
            location.reload();
            return false;
        }
        if(varient_type_id == '' || varient_type_id == null) {
            swal('', 'Invalid Selected Food Varient.', 'error');
            location.reload();
            return false;
        }
        if(food_price == '' || food_price == null) {
            swal('', 'Food Price Not Found.', 'error');
            location.reload();
            return false;
        }
        if(total_price == '' || total_price == null) {
            swal('', 'Invalid Total Price, Please Check Your Added Food Item.', 'error');
            location.reload();
            return false;
        }
        if(quantity == '' || quantity == null) {
            swal('', 'Quantity Must Be Required.', 'error');
            location.reload();
            return false;
        }
        console.log(level);
        swal({
            title: "Are you sure?",
            text: "Add This Food Item To Cart.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '{{ url('add-food/cart') }}',
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'food_id': food_id,
                    'varient_type_id': varient_type_id,
                    'food_price': food_price,
                    'addon_price': addon_price,
                    'total_price': total_price,
                    'quantity': quantity,
                    'food_request': food_request,
                    'ingredients_ids': ingredients_ids,
                    'level_id': level,
                },
                beforeSend: function() {
                    document.getElementById('loading').style.display = 'block';
                },
                success: function(data) {
                    swal('', data.msg, data.type);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(error) {
                    alert('Something happned wrong.');
                    document.getElementById('loading').style.display = 'none';
                },
                complete: function() {
                    document.getElementById('loading').style.display = 'none';
                }
            })
        }
        });
    }

    function removeFoodItemsFromCart(id) {
        
        swal({
            title: "Are you sure?",
            text: "Remove This Food Item From Cart.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '{{ url('remove/cart/quantity') }}',
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'food_id': id,
                },
                beforeSend: function() {
                    document.getElementById('loading').style.display = 'block';
                },
                success: function(data) {
                    document.getElementById('cart_number').innerHTML = '{{ count((array) session('cart')) }}';
                    $('#render-cart').html(data);
                },
                error: function(error) {
                    alert('Something happned wrong.');
                    document.getElementById('loading').style.display = 'none';
                },
                complete: function() {
                    document.getElementById('loading').style.display = 'none';
                }
            })
        }
        });
    }

    function updateFoodQuantity(id, qty) {
        $('#decrement'+id).attr('disabled', true);
        $('#increment'+id).attr('disabled', true);
        $.ajax({
            url: '{{ url('update/cart/quantity') }}',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'food_id': id,
                'quantity': qty,
            },
            beforeSend: function() {
                document.getElementById('loading').style.display = 'block';
            },
            success: function(data) {
                document.getElementById('cart_number').innerHTML = '{{ count((array) session('cart')) }}';
                $('#render-cart').html(data);
            },
            error: function(error) {
                alert('Something happned wrong.');
                document.getElementById('loading').style.display = 'none';
                // setTimeout(function() {
                //     location.reload();
                // }, 2000);
            },
            complete: function() {
                $('#decrement'+id).removeAttr('disabled');
                $('#increment'+id).removeAttr('disabled');
                document.getElementById('loading').style.display = 'none';
            }
        })
    }
</script>
<!-- toastr message -->
<div class="toaster-sec">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session()->get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Faild!</strong> {{ session()->get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session()->has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> {{ session()->get('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
</div>
