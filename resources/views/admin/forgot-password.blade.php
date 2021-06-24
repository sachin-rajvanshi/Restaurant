@include('layout.admin.login-header')
@include('layout.admin.alert')

<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <div class="auth-wrapper auth-v1 px-2">
        <div class="auth-inner py-2">
          <div class="card mb-0">
            <div class="card-body"> 
              <a href="javascript:void(0);" class="brand-logo"><img src="{{ asset('') }}/admin/images/logo.png" width="150" alt=""></a>

              <h4 class="card-title mb-1">Forgot Password?</h4>
              <p class="card-text mb-2">Enter your email and we'll send you instructions to reset your password</p>

              <form class="auth-login-form mt-2" action="{{ route('sendResetPasswordLink') }}" method="POST">
              	@csrf
                <div class="form-group">
                  <label class="form-label">Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Enter Email Id" aria-describedby="login-email" tabindex="1" required="" autofocus/>
                </div>
                <button type="submit" class="btn btn-primary btn-block" tabindex="4">Send Reset Link</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('layout.admin.login-footer')