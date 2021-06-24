@extends('layout.front.main')
@section('content')

<main>

  <div class="login-block section-padding">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="innerblock">
            <div class="log-reg-blk">
              <h4>Signup with</h4>
              <div class="social-login">
                <div class="fb-login slogin-btn">
                  <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                </div>
                <div class="google-login slogin-btn">
                  <a href="#"><i class="fab fa-google"></i> Google</a>
                </div>
              </div>
              <div class="orspave"><span>OR</span></div>
              <form class="form-contact contact_form" action="{{ url('user/signup') }}" method="post" id="contactForm" novalidate="novalidate">
                @csrf
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input class="form-control" name="name" type="text" placeholder="Enter Name" value="{{ old('name') }}" required="">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input class="form-control" name="email" type="email" placeholder="Enter Email" value="{{ old('email') }}" required="">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input class="form-control" name="mobile_number" type="text" placeholder="Enter Mobile Number" value="{{ old('mobile_number') }}" required="">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input class="form-control" name="password" type="password" placeholder="Enter Password" required="">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" type="password" placeholder="Confirm Password" required="">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <button type="submit" class="btn main-btn">Sign Up</button>
                    </div>
                  </div>
                </div>
              </form>
              <p class="logreg-text">Already have an account? <a href="{{ url('user/login') }}">Login</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

@endsection
@section('front-scripts')

@endsection