@if(count($foods))
	@foreach($foods as $food)
	<div class="col-md-4">
		<div class="food-items">
		  <a href="{{ url('food/detail') }}/{{ base64_encode($food->id) }}">
		  	@if(count($food->getGallery) > 0)
		  		<img src="{{ asset('storage') }}/{{ $food->getGallery[0]->image }}" alt=""></a>
		  	@else
		  		<img src="{{ asset('') }}admin/images/dummy.jpg" alt=""></a>
	        @endif
		  	
		  <div class="food-cont">
		    <a href="{{ url('food/detail') }}/{{ base64_encode($food->id) }}"><h3>{{ $food->name }}</h3></a>
		    <p>{{ $food->remark }}</p>
		    <h5>
		    	@if($food->getHighestPriceVarient($food->id))
		    		@if($food->getHighestPriceVarient($food->id)->discount)
		    			<span>$ {{ $food->getHighestPriceVarient($food->id)->final_price }}</span> 
		    			<span class="cutprice">$ {{ $food->getHighestPriceVarient($food->id)->price }}</span> 
		    			<span class="offprice">{{ $food->getHighestPriceVarient($food->id)->discount }}% off</span>
		    		@else
		    			<span>$ {{ $food->getHighestPriceVarient($food->id)->price }}</span> 
		    		@endif
		    	@endif
		    </h5>
		    <a href="javascript:void(0)" onclick="openCartModel('{{ $food->id }}')" class="addtocart"><i class="fas fa-arrow-right"></i>Add to Cart</a>
		  </div>
		</div>
	</div>
	@endforeach

	<div class="col-md-12">
      {{ $foods->links() }}
    </div>
@else
	<p style="text-align: center;">No any food items found.</p>
@endif