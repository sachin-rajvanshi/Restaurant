@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Cart Review</h1>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Cart Review</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="custom-section">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="cart-productlist">
            <div class="cart-product">
              <div class="productimg">
                <a href="view-food.php">
                  <img src="assets/img/food-1.jpg" alt="">
                </a>
              </div>
              <div class="product-cont">
                <a href="view-food.php"><h4>Chicken Biryani</h4></a>
                <h5>Awadhi  chicken delight cooked in rich masala gravy.</h5>
                <p><span><b>Cooking level (meat):</b> medium rare</span>, <span><b>Rice:</b> White Rice</span></p>
                <p>1.5 Ounce Hot Sauce ($0.50), 8 ounce Creamy Garlic Sauce ($2.50)</p>
                <div class="qty-pro">
                  <div class="input-group custom-groupplus">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[1]">
                        <i class="fas fa-minus"></i>
                      </button>
                    </span>
                    <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                        <i class="fas fa-plus"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="product-rem-price">
                <div class="unitprice">$ 220</div>
                <a href="#" class="proremove-btn">Remove</a>
              </div>
            </div>
            <div class="cart-product">
              <div class="productimg">
                <a href="view-food.php">
                  <img src="assets/img/food-1.jpg" alt="">
                </a>
              </div>
              <div class="product-cont">
                <a href="view-food.php"><h4>Chicken Biryani</h4></a>
                <h5>Awadhi  chicken delight cooked in rich masala gravy.</h5>
                <p><span><b>Cooking level (meat):</b> medium rare</span>, <span><b>Rice:</b> White Rice</span></p>
                <p>1.5 Ounce Hot Sauce ($0.50), 8 ounce Creamy Garlic Sauce ($2.50)</p>
                <div class="qty-pro">
                  <div class="input-group custom-groupplus">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[1]">
                        <i class="fas fa-minus"></i>
                      </button>
                    </span>
                    <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                        <i class="fas fa-plus"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="product-rem-price">
                <div class="unitprice">$ 220</div>
                <a href="#" class="proremove-btn">Remove</a>
              </div>
            </div>
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
              <li><b>Subtotal:</b> <span>$ 440</span></li>
              <li><b>Taxes (20%):</b> <span>$ 100</span></li>
              <li><b>Discount (10%):</b> <span>$ 50</span></li>
              <li><b>Total:</b> <span>$ 440</span></li>
            </ul>
            <a href="checkout.php" class="btn checkout-btn">Checkout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection