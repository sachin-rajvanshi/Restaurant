@php
  $online = App\Helper\Helper::getHomePageSection('online');
@endphp
@if($online)
<div class="make-online-section" style="background-image: url('{{ asset('storage')  }}/{{ $online->image  }}');">
    <div class="container">
      <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <div class="make-online-block">
            <h6>{{ $online->heading }}</h6>
            <h3>{{ $online->title }}</h3>
            <p>{{ $online->description }}</p>
            <a href="#" class="book-order-btn">Book Your Order</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif