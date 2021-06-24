@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Dashboard</h1>
           <p>{{ \Auth::user()->about_me }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Dashboard</li>
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
          @include('user.sidebar')
        </div>
        <div class="col-md-8">
          <div class="dashbaord-block-right">
            <div class="dashbaord-header">
              <h3>Dashboard</h3>
            </div>
            <div class="inner-block">
              <div class="purchase-order-list">
                <h3>Recent Order List</h3>
                <div class="purchase-order">
                  <div class="prchase-food-img">
                    <a href="view-food.php">
                      <img src="{{ asset('') }}assets/img/food-1.jpg" alt="">
                    </a>
                  </div>
                  <div class="purchase-food-cont">
                    <h4><a href="view-food.php">Chicken Biryani</a> <span class="pricepro">$ 120</span></h4>
                    <h5>Awadhi  chicken delight cooked in rich masala gravy.</h5>
                    <p><span><b>Cooking level (meat):</b> medium rare</span>, <span><b>Rice:</b> White Rice</span></p>
                    <p>1.5 Ounce Hot Sauce ($0.50), 8 ounce Creamy Garlic Sauce ($2.50)</p>
                    <p><b>Product Qty:</b> 1 Full</p>
                  </div>
                </div>
                <div class="purchase-order">
                  <div class="prchase-food-img">
                    <a href="view-food.php">
                      <img src="{{ asset('') }}assets/img/food-1.jpg" alt="">
                    </a>
                  </div>
                  <div class="purchase-food-cont">
                    <h4><a href="view-food.php">Chicken Biryani</a> <span class="pricepro">$ 120</span></h4>
                    <h5>Awadhi  chicken delight cooked in rich masala gravy.</h5>
                    <p><span><b>Cooking level (meat):</b> medium rare</span>, <span><b>Rice:</b> White Rice</span></p>
                    <p>1.5 Ounce Hot Sauce ($0.50), 8 ounce Creamy Garlic Sauce ($2.50)</p>
                    <p><b>Product Qty:</b> 1 Full</p>
                  </div>
                </div>
              </div>
              <div class="all-order-list">
                <h3>Purchased Order List</h3>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th width="110px">Date & Time</th>
                        <th>Order ID</th>
                        <th>Invoice Number</th>
                        <th>Billed Amount</th>
                        <th>Payment Status</th>
                        <th>Payment Mode</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>12 May 2021<br>12:33 PM</td>
                        <td><a href="#">OI76876</a></td>
                        <td><a href="#">IN7867645</a></td>
                        <td>$ 95</td>
                        <td><span class="text-success">Paid</span></td>
                        <td>Online</td>
                        <td><span class="text-success">Success</span></td>
                      </tr>
                      <tr>
                        <td>12 May 2021<br>12:33 PM</td>
                        <td><a href="#">OI76876</a></td>
                        <td><a href="#">IN7867645</a></td>
                        <td>$ 95</td>
                        <td><span class="text-danger">Unpaid</span></td>
                        <td>Offline</td>
                        <td><span class="text-danger">Failed</span></td>
                      </tr>
                      <tr>
                        <td>12 May 2021<br>12:33 PM</td>
                        <td><a href="#">OI76876</a></td>
                        <td><a href="#">IN7867645</a></td>
                        <td>$ 95</td>
                        <td><span class="text-success">Paid</span></td>
                        <td>Offline</td>
                        <td><span class="text-success">Success</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection