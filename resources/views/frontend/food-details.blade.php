@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>{{ $picked->name }}</h1>
           <p>{{ $picked->remark }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Chicken Biryani</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="food-view-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="food-photos">
            <div class="owl-carousel owl-theme" id="foodphotos">
            	@if(count($picked->getGallery) > 0)
            		@foreach($picked->getGallery as $image)
            			@if(Storage::exists($image->image))
            				<div class="item">
            				  <img src="{{ asset('storage') }}/{{ $image->image }}" alt="">
            				</div>
            			@endif
            		@endforeach
            	@endif
              
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="food-description">
            <h3>{{ $picked->name }}</h3>
            <h6><b>Categories:</b> <a href="{{ url('food/items') }}?category={{ base64_encode($picked->category_id) }}">{{ $picked->getCategory ? $picked->getCategory->name : '' }}  {{ $picked->getSubCategory ? '/ '.$picked->getSubCategory->name : '' }}</a></h6>
            <p>{{ $picked->remark }}</p>
            <div class="rating-price-time">
              <div class="rating-blk">
                <p><i class="fas fa-star"></i> 4.5 <span>500+ Rating</span></p>
              </div>
              <div class="time-blk">
                <p>{{ $picked->delivery_time }} <span>Delivery Time</span></p>
              </div>
              <div class="price-blk">
              	@if($picked->getHighestPriceVarient($picked->id))
                <p>$ {{ $picked->getHighestPriceVarient($picked->id)->final_price }} @if($picked->getHighestPriceVarient($picked->id)->discount) <span>{{ $picked->getHighestPriceVarient($picked->id)->discount }}% off</span> @endif</p>
                @endif
              </div>
            </div>
            <div class="offer-block">
              <h4>Offer</h4>
              <p>20% off up to ₹300 on orders above ₹1000 | Use code <b>PARTY</b></p>
              <p>15% off upto ₹100 with SBI credit cards, once per week | Use code <b>100SBI</b></p>
            </div>
            <div class="main-buttons">
              <a href="javascript:void(0)" onclick="openCartModel('{{ $picked->id }}')" class="btn main-btn">Add to Cart</a>
              <a href="javascript:void(0)" onclick="addFavourite('{{ $picked->id }}')" class="btn fav-btn"><i class="far fa-heart"></i> Favourite</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')
<script type="text/javascript">
  
    function addFavourite(id) {
      var user_id = '{{ \Auth::id() }}';
      swal({
          title: "Are you sure?",
          text: "Add Favourite Of This Food.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            if(user_id == null || user_id == ''){
              swal('', 'To perform this action you must first login', 'warning');
              return false;
            }
            $.ajax({
              url: '{{ url('add/favourite') }}',
              method: "POST",
              data: {
                "_token": "{{ csrf_token() }}",
                'id'    : id
              },
              beforeSend: function() {
                document.getElementById('loading').style.display = 'block';
              },
              success: function(response) {
                console.log(response);
                if(response.code === 200) {
                  swal('', response.message, 'success');
                  $('#gallery-list').DataTable().ajax.reload();
                }else {
                  swal('', response.message, 'warning');
                }
              },
              error: function(response) {
                document.getElementById('loading').style.display = 'none';
              },
              complete: function() {
                document.getElementById('loading').style.display = 'none';
              }
            })
        }
      });
      
  }
</script>
@endsection