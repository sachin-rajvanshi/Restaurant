@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>Food Items</h1>
           <p>Lorem ipsum dolor sit amet, consecte turn se adipisicing elit, sed do eiusmod tempor ens incididunt ut labore et dolore magna aliqua.</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Food Items</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="food-items-section">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="sidebar">
            <div class="categories">
              <h3>Category</h3>
              <ul>
                <li><a href="{{ url('food/items') }}" @if(app('request')->input('category') == null) class="active" @endif) >All</a></li>
                @foreach($categories as $category)
                  <li><a href="{{ url('food/items') }}?category={{ base64_encode($category->id) }}" @if(app('request')->input('category') == base64_encode($category->id)) class="active" @endif>{{ $category->name }}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="topfilter">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" id="search" placeholder="Search..." class="form-control" onkeyup="applyFoodFilters()">
                </div>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <div class="form-group">
                  <select class="form-select" id="sort_by" onchange="applyFoodFilters()">
                    <option value="">Apply Filter</option>
                    <option value="low">Price Low to High</option>
                    <option value="high">Price High to Low</option>
                    <option value="old">Old Food Items</option>
                    <option value="new">New Food Items</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="food-list-block">
            <div class="row" id="add_foods">
				      @include('frontend.items')
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
  $(document).ready(function(){
      $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        applyFoodFilters(page);
      });
  });

  function applyFoodFilters(page) {
      var search_key = $('#search').val();
      var sort_by = $('#sort_by').val();
      $.ajax({
        url: '{{ url('food/items/filters') }}?page='+page,
        method: "POST",
        data: {
         "_token": "{{ csrf_token() }}",
         'id': '{{ app('request')->input('category') }}',
         'search_key':search_key,
         'sort_by':sort_by
        },
        beforeSend: function() {
          document.getElementById('loading').style.display = 'block';
        },
        success: function(response) {
          $('#add_foods').html(response);
        },
        error: function(response) {
          applyFoodFilters();
          document.getElementById('loading').style.display = 'none';
        },
        complete: function() {
          document.getElementById('loading').style.display = 'none';
        }
      })
    }
  
</script>
@endsection