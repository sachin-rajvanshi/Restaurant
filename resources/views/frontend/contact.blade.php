@extends('layout.front.main')
@section('content')

<main>
 <div class="page-header-section" style="background:url(assets/img/page-header.jpg)">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-7">
         <div class="page-header-block">
           <h1>{{ $contact_info->heading }}</h1>
           <p>{{ $contact_info->title }}</p>
           <ul class="breadcrumb-custom">
             <li><a href="index.php">Home</a></li>
             <li>Contact Us</li>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

  <div class="custom-section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Get in Touch</h2>
        </div>
        <div class="col-lg-8">
          <form class="form-contact contact_form" action="{{ url('contact/enquiry') }}" method="post">
          	@csrf
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control valid" name="mobile_number" id="mobile" type="phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter phone number'" placeholder="Phone Number" required="">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject" required="">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message" required=""></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn main-btn">Submit</button>
            </div>
          </form>
        </div>
        <div class="col-lg-3 offset-lg-1">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>{{ $footer_details->address }}</h3>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3>{{ $header_details->phone_number }}</h3>
              <p>{{ $contact_info->image }}</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3>{{ $header_details->email }}</h3>
              <p>Send us your query anytime!</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="map-block">
            <iframe src="{{ $contact_info->description }}" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
@section('front-scripts')

@endsection