@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>{{ $gallery_header->heading }}</h1>
           <p>{{ $gallery_header->title }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Photo Galleries</li>
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
        <h3>Photo Galleries</h3>
      </div>
      <div class="row">
        @foreach($categories as $category)
          <div class="col-md-3">
            <div class="photo-gallery">
              @if(Storage::exists($category->image))
                  <a href="{{ url('gallery/images') }}/{{ base64_encode($category->id) }}"><img src="{{ asset('storage') }}/{{ $category->image }}" alt=""></a>
              @else
                  <a href="{{ url('gallery/images') }}/{{ base64_encode($category->id) }}"><img src="{{ asset('') }}/admin/images/dummy.jpg" alt=""></a>
              @endif
              <div class="cont-photo">
                <h4>{{ $category->name }}</h4>
                <a href="{{ url('gallery/images') }}/{{ base64_encode($category->id) }}">View all photos</a>
              </div>
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