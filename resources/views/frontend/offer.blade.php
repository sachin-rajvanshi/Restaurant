@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url(assets/img/page-header.jpg)">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Offer & Coupons</h1>
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
        @foreach($coupons as $coupon)
          <div class="col-md-4">
            <a href="{{ url('cart') }}?coupon={{ $coupon->code }}">
              <div class="offer-blk">
                <img src="assets/img/offer-bg.jpg" alt="">
                  <span class="offerhead">Coupon</span>
                  <div class="offer-cont">
                    <h3>GRAB {{ $coupon->discount }}% Off! Use coupon {{ $coupon->code }} for your first {{ $coupon->usages }} order</h3>
                    <p>Only for {{ $coupon->apply_for }} Users</p>
                  </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection