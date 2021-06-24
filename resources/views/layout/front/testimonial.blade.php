@php
  $testimonials = App\Helper\Helper::getTestimonials();
  $testimonial_setting  = App\Models\HomePageContentSetting::where('slug', 'testimonial')->first();
@endphp
@if(count($testimonials) > 0)
  <div class="testimonial-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="testi-img">
            @if(Storage::exists($testimonial_setting->image)) 
                <img src="{{ asset('storage/'.$testimonial_setting->image) }}" alt="">
            @else
                <img src="{{ asset('') }}/admin/images/dummy.jpg" alt="">
            @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="heading-block heading-left">
            <p>{{ $testimonial_setting->heading }}</p>
            <h3>{{ $testimonial_setting->title }}</h3>
          </div>
          <div class="testimonial-block">
            <div class="owl-carousel owl-theme" id="testimonial">
            @foreach($testimonials as $testi) 
              <div class="item">
                <div class="testicont">
                  <div class="test-content">
                    <p>{{ $testi->feedback }}</p>
                  </div>
                  <div class="test-cust">
                    @if(Storage::exists($testi->image)) 
                        <img src="{{ asset('storage/'.$testi->image) }}" alt="">
                    @else
                        <img src="{{ asset('') }}/admin/images/dummy.jpg" alt="">
                    @endif
                    <div class="cust-details">
                      <h3>{{ $testi->name }}</h3>
                      <!-- <p>CEO, PsdBoss</p> -->
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif