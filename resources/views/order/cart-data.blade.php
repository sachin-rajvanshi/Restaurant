@php
  $sub_total = 0;
  $offer_amount = app('request')->input('o_m') != null ? base64_decode(app('request')->input('o_m')) : 0;
  $discount_amount = app('request')->input('d_a') != null ? base64_decode(app('request')->input('d_a')) : 0;
  $discount = app('request')->input('dis') != null ? base64_decode(app('request')->input('dis')) : 0;
  $coupon_id = app('request')->input('c_id') != null ? base64_decode(app('request')->input('c_id')) : 0;
  $tax             = App\Models\HomePageContentSetting::where('slug', 'tax')->first();
@endphp
  <div class="row">
    <div class="col-md-8">
      <div class="cart-productlist">
        @if(session('cart'))
        @foreach(session('cart') as $id => $details)
        @php
          $food = App\Models\FoodItem::find($details['id']);
          $level = App\Models\Ingredient::find($details['level_id']);
          $ingredients = $details['ingredients_ids'] != null ? App\Models\Ingredient::whereIn('id', $details['ingredients_ids'])->get() : [];
          $sub_total = $sub_total + $details['total_price'];
          
        @endphp
            <div class="cart-product">
              <div class="productimg">
                <a href="{{ url('food/detail') }}/{{ base64_encode($details['id']) }}">
                  <img src="{{ asset('storage') }}/{{ $details['image'] }}" alt="">
                </a>
              </div>
              <div class="product-cont">
                <a href="{{ url('food/detail') }}/{{ base64_encode($details['id']) }}"><h4>{{ $details['name'] }}</h4></a>
                <h5>{{ $food->remark }}</h5>
                <p>@if($level) <span><b>Cooking level (meat):</b> {{ $level->name }}</span> @endif</p>
                <p>
                  @foreach($ingredients as $ingredient)
                    {{ $ingredient->name }} (${{ $ingredient->price }}), 
                  @endforeach
                </p>
                <div class="qty-pro">
                  <div class="input-group custom-groupplus">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" id="decrement{{ $details['id'] }}" onclick="managePriceByQuantityDecrement('{{ $details['id'] }}')" data-type="minus" data-field="quant[1]">
                        <i class="fas fa-minus"></i>
                      </button>
                    </span>
                    <input type="text" name="quantity" id="food_quantity{{ $details['id'] }}" class="form-control input-number" value="{{ $details['quantity'] }}" min="1" max="10">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" id="increment{{ $details['id'] }}" onclick="managePriceByQuantityIncrement('{{ $details['id'] }}')" data-type="plus" data-field="quant[1]">
                        <i class="fas fa-plus"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="product-rem-price">
                <div class="unitprice">$ {{ $details['price'] }}</div>
                <a href="javascript:void(0)" onclick="removeFoodItemsFromCart('{{ $details['id'] }}')" class="proremove-btn">Remove</a>
              </div>
          </div>
        @endforeach

        @else
        <h4>Cart is empty</4>
        @endif
      </div>
    </div>
    @php
      $tax_amount = App\Helper\Helper::getAmountByPercent($sub_total, $tax->title); 
      $product_total      = $sub_total + $tax_amount;
      $total      = $sub_total + $tax_amount - $discount_amount;
    @endphp
    <input type="hidden" name="sub_total_amount" id="sub_total_amount" value="{{ $sub_total }}">
    <input type="hidden" name="final_total_amount" id="final_total_amount" value="{{ $total }}">
    <input type="hidden" name="discounted_amount" id="discounted_amount" value="{{ $offer_amount }}">
    <input type="hidden" name="applied_discount" id="applied_discount" value="{{ $discount_amount }}">
    <div class="col-md-4">
      <div class="cart-sidebar">
        <h4>Cart Review</h4>
        <ul>
          @if($discount == 0)
          <li>
            <form method="post" action="{{ url('apply/coupon') }}">
            @csrf
              <input type="hidden" name="amount" value="{{ $total }}" required="">
             
                <p>Coupon Code</p>
                <div class="coupon-code">
                  @if(app('request')->input('coupon'))
                    <input type="text" placeholder="Enter Code" name="coupon" id="coupon_code" value="{{ app('request')->input('coupon') }}" required="">
                  @else
                    <input type="text" placeholder="Enter Code" name="coupon" id="coupon_code" required="">
                  @endif
                  <button type="submit" class="addcode-btn">apply</button>
                </div>
            </form>
          </li>
          @else
          <form method="post" action="{{ url('remove/coupon') }}">
            @csrf
            <input type="hidden" name="coupon_id" value="{{ $coupon_id }}">
            <h4 style="color: green;">Coupon Applied Successfully.</h4>
            <button type="submit" class="addcode-btn">Remove</button>
          </form>
          @endif
          <li><b>Subtotal:</b> <span>$ {{ $sub_total }}</span></li>
          <li><b>{{ $tax->heading }} ({{ $tax->title }}%):</b> <span>$ {{ $tax_amount }}</span></li>
          <li><b id="view_discount">Discount ({{ $discount }}%):</b> <span id="view_discount_price">$ {{ $discount_amount }}</span></li>
          <li><b>Total:</b> <span>$ {{ $total }}</span></li>
        </ul>
        @if(\Auth::id())
          <a href="{{ url('checkout') }}/{{ base64_encode($coupon_id) }}/{{ base64_encode($product_total) }}/{{ base64_encode($total) }}/{{ base64_encode($discount) }}/{{ base64_encode($sub_total) }}/{{ base64_encode($tax_amount) }}/{{ base64_encode($discount_amount) }}/{{ base64_encode($tax->title) }}"><button type="button" class="btn checkout-btn">Checkout</button></a>
        @else
          <a href="{{ url('user/login') }}?type=Cart"><button type="button" class="btn btn-primary">Login</button></a>
        @endif
      </div>
    </div>
  </div>