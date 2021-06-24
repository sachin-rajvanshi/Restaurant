@extends('layout.front.main')
@section('content')

<main>
  <div class="slider-area ">
    <div class="slider-active">
      @foreach($banners as $banner)
        <div class="single-slider slider-height d-flex align-items-center" style="background-image: url('{{ asset('storage') }}/{{ $banner->image }}')">
          <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-xl-6 col-lg-7 col-md-8">
                <div class="hero__caption">
                  <span data-animation="fadeInLeft" data-delay=".2s">{{ $banner->name }}</span>
                  {!! $banner->text !!}
                  <div class="hero__btn">
                    <a href="#" class="btn hero-btn">Get Started</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @if(count($home_categories) > 0)
    <div class="top-category-section">
      <div class="container">
        <div class="row">
          @foreach($home_categories as $h_category)
            <div class="col-md-4">
              <div class="info-box info-style5">
                <div class="rtin-item media-image">
                  <div class="rtin-content">
                    <div class="rtin-header">
                      <h3 class="rtin-title"><a href="#">{{ $h_category->name }}</a></h3>
                      <div class="rtin-button"><a class="info-button" href="javascript:void(0)"><i class="fas fa-arrow-right"></i>SEE MENU</a></div>
                    </div>
                    <div class="rtin-media">
                      <span class="rtin-img"><a href="#"><img src="{{ asset('storage') }}/{{ $h_category->image }}" class="attachment-full size-full wp-post-image"></a></span></div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  @endif

  <div class="about-us-section">
    <div class="container">
      <div class="heading-block">
        <p>{{ $about->tag_one }}</p>
        <h3>{{ $about->tag_two }}</h3>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="about-image">
            <img src="{{ asset('storage') }}/{{ $about->section_one_image }}" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="about-content">
            {!! \Illuminate\Support\Str::limit($about->section_one_description, 500);  !!}<br>
            <a href="industries.html" class="btn main-btn-yellow">See More</a>
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="about-content text-right">
            {!! \Illuminate\Support\Str::limit($about->section_two_description, 500);  !!}<br>
            <a href="industries.html" class="btn main-btn-yellow">Start Your Order</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="about-image">
            <img src="{{ asset('storage') }}/{{ $about->section_two_image }}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

@if($best_food_dish)
  <div class="best-dish-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5">
          <div class="best-dish-cont">
            <h2>{{ $best_food_setting->heading }}</h2>
            <p>{{ $best_food_setting->title }}</p>
            <a class="btn-fill-light" href="#">ORDER NOW<i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-md-7">
          <div class="best-dish-img">
            @if(Storage::exists($best_food_setting->image)) 
                <img src="{{ asset('storage/'.$best_food_setting->image) }}" alt="">
            @else
                <img src="{{ asset('') }}/admin/images/plus-upload.jpg" alt="">
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
@if(count($popular_foods))
  <div class="products-section">
    <div class="container">
      <div class="heading-block">
        <p>{{ $popular_food_setting->heading }}</p>
        <h3>{{ $popular_food_setting->title }}</h3>
      </div>
        <div class="row">
          @foreach($popular_foods as $popular_food)
            <div class="col-md-4">
              <div class="food-items">
                @if($popular_food->getGallery)
                  <a href="view-food.php"><img src="{{ asset('storage') }}/{{ $popular_food->getGallery[0]['image'] }}" alt=""></a>
                @endif
                <div class="food-cont">
                  <a href="view-food.php"><h3>{{ $popular_food->name }}</h3></a>
                  <p>{{ $popular_food->meta_title }}</p>
                  <h5>
                    @if($popular_food->getHighestStockVarient($popular_food->id)->discount)
                      <span>$ {{ $popular_food->getHighestStockVarient($popular_food->id)->final_price }}</span>
                      <span class="cutprice">$ {{ $popular_food->getHighestStockVarient($popular_food->id)->price }}</span> 
                      <span class="offprice">{{ $popular_food->getHighestStockVarient($popular_food->id)->discount }}% off</span>
                    @else
                      <span>$ {{ $popular_food->getHighestStockVarient($popular_food->id)->price }}</span>
                    @endif
                  </h5>
                  <a href="#" data-toggle="modal" data-target="#addIngredients" class="addtocart"><i class="fas fa-arrow-right"></i>Add to Cart</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
    </div>
  </div>
@endif
  @include('layout.front.static')
  @include('layout.front.testimonial')
  @include('layout.front.experience')
  @include('layout.front.blogs')

</main>

@endsection
@section('front-scripts')

@endsection