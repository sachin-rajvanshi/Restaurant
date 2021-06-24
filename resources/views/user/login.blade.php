@extends('layout.front.main')
@section('content')

<main>

  <div class="login-block section-padding">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="innerblock">
            <div class="log-reg-blk">
              <h4>Login with</h4>
              <div class="social-login">
                <div class="fb-login slogin-btn">
                  <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                </div>
                <div class="google-login slogin-btn">
                  <a href="#"><i class="fab fa-google"></i> Google</a>
                </div>
              </div>
              <div class="orspave"><span>OR</span></div>
              <form class="form-contact contact_form" action="{{ url('user/login') }}" method="post" id="contactForm" novalidate="novalidate">
                @csrf
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input class="form-control" name="email" type="email" placeholder="Enter Email" required="">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input class="form-control" name="password" type="password" placeholder="Enter Password" required="">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <button href="index.php" class="btn main-btn">Log In</button>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <a href="forgot-password.php" class="forgottext">Forgot Password?</a>
                  </div>
                </div>
              </form>
              <p class="logreg-text">New to Restaurant? <a href="{{ url('user/registration') }}">Create Account</a></p>
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