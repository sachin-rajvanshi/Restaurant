@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url(assets/img/page-header.jpg)">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Offer & Coupons</h1>
           <p>Consectetur adipiscing elit, sued do eiusmod tempor ididunt udfgt labore et dolore magna aliqua.</p>
           <ul class="breadcrumb-custom">
             <li><a href="index.php">Home</a></li>
             <li>Offer & Coupons</li>
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
          <a href="#">
            <div class="offer-blk">
              <img src="assets/img/offer-bg.jpg" alt="">
                <span class="offerhead">Offer</span>
                <div class="offer-cont">
                  <h3>Enjay 10% off for your first order</h3>
                  <p>Only for new Customor</p>
                </div>
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a href="#">
            <div class="offer-blk">
              <img src="assets/img/offer-bg.jpg" alt="">
                <span class="offerhead">Coupon</span>
                <div class="offer-cont">
                  <h3>GRAB 15% Off! Use coupon 'HappySell'</h3>
                  <p>Only for Registered Customor</p>
                </div>
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a href="#">
            <div class="offer-blk">
              <img src="assets/img/offer-bg.jpg" alt="">
                <span class="offerhead">Offer</span>
                <div class="offer-cont">
                  <h3>GRAB 20% Off! Use coupon 'PrimeCustomer'</h3>
                  <p>Only for Prime Customor</p>
                </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection