
  <div class="row">
    <div class="col-md-8">
      <div class="cart-productlist">
        @if(session('cart'))
        @php
          $sub_total = 0;
        @endphp
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
                    <input type="text" name="quantity" id="food_quantity" class="form-control input-number" value="{{ $details['quantity'] }}" min="1" max="10">
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
        @endif
      </div>
    </div>
    <div class="col-md-4">
      <div class="cart-sidebar">
        <h4>Cart Review</h4>
        <ul>
          <li>
            <p>Coupon Code</p>
            <div class="coupon-code"><input type="text" placeholder="Enter Code"><a href="#" class="addcode-btn">apply</a></div>
          </li>
          <li><b>Subtotal:</b> <span>$ {{ $sub_total }}</span></li>
          <li><b>Taxes (20%):</b> <span>$ 100</span></li>
          <li><b>Discount (10%):</b> <span>$ 50</span></li>
          <li><b>Total:</b> <span>$ 440</span></li>
        </ul>
        <a href="checkout.php" class="btn checkout-btn">Checkout</a>
      </div>
    </div>
  </div>