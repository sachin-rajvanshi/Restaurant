@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url('{{ asset('assets/img/page-header.jpg') }}')">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>{{ $testimonial_header->heading }}</h1>
           <p>{{ $testimonial_header->title }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="{{ url('/') }}">Home</a></li>
             <li>Testimonials</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="custom-section">
    <div class="container">
      @include('layout.front.testimonial')
      <div class="write-review">
        <h4>Write Review</h4>
        <form method="POST" action="{{ url('guest/review') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Profile Photo</label>
                <input type="file" class="form-control" name="file"/>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" required="" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Email Id</label>
                <input type="text" class="form-control" name="email" placeholder="Email Id" required="" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="mobile_number" placeholder="Phone Number" required="" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Review</label>
                <textarea  class="form-control" rows="3" name="feedback" placeholder="Write Review" required=""></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn main-btn">Submit Your Review</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection