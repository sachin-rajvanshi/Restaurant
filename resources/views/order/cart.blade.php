@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url(assets/img/page-header.jpg)">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Cart Review</h1>
           <p></p>
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
    <div class="container" id="render-cart">
      @include('order.cart-data')
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection