@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg')  }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>{{ $about->heading }}</h1>
           <p>{{ $about->title }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>About Us</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="about-section">
    <div class="container">
      <div class="heading-block">
        <p>{{ $about->tag_one }}</p>
        <h3>{{ $about->tag_two }}</h3>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="about-image">
            <img src="{{ asset('storage') }}/{{ $about->section_one_image }}" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="about-content">
            {!! $about->section_one_description !!}
          </div>
        </div>
        <div class="col-md-12">
          <div class="about-content">
            {!! $about->section_two_description !!}
          </div>
        </div>
      </div>
    </div>
  </div>

   @include('layout.front.experience')
   @include('layout.front.testimonial')

</main>

@endsection
@section('front-scripts')

@endsection