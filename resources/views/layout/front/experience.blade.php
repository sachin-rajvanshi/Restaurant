@php
  $about = App\Models\About::first();
@endphp
<div class="counter-section">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-3 col-md-6 col-6">
        <div class="single-counter text-center">
          <i class="fas fa-hamburger"></i>
          <span class="counter">{{ $about->food_items }}</span> <span class="cr-plus"> + </span>
          <p>Food Items</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-6">
        <div class="single-counter text-center">
          <i class="far fa-user"></i>
          <span class="counter">{{ $about->clients_daily }}</span> <span class="cr-plus"> + </span>
          <p>Clients Daily</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-6">
        <div class="single-counter text-center">
          <i class="fas fa-award"></i>
          <span class="counter">{{ $about->years_of_experience }}</span> <span class="cr-plus"> + </span>
          <p>Years of Experience</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-6">
        <div class="single-counter text-center">
          <i class="fas fa-biohazard"></i>
          <span class="counter">{{ $about->fresh_halal }}</span> <span class="cr-plus"> + </span>
          <p>Fresh & Halal</p>
        </div>
      </div>
    </div>
  </div>
</div>