@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>{{ $category->name }} Photo Gallery</h1>
           <p>{{ $category->remark }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Tradition Photo Gallery</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="photo-section">
    <div class="container">
      <div class="heading-block">
        <p>Our Best Photos</p>
        <h3>{{ $category->name }} Photo Gallery</h3>
      </div>
      <div class="row">
      	@foreach($images as $image)
        <div class="col-md-3">
          <div class="photo-gallery">
            <a href="{{ asset('storage') }}/{{ $image->image }}" class="img-pop-up">
              <img src="{{ asset('storage') }}/{{ $image->image }}" alt="">
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection