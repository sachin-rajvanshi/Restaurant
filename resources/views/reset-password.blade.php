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

              <h4 class="card-title mb-1">Reset Password!</h4>
              <p class="card-text mb-2">Enter your new password and login to your account.</p>

              <form class="auth-login-form mt-2" action="{{ route('updateUserPassword') }}" method="POST">
              	@csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="hidden" name="otp_id" value="{{ $check_otp->id }}">
                <div class="form-group">
                  <label class="form-label">New Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Enter Password" aria-describedby="login-email" tabindex="1" required="" autofocus/>
                </div>
                <div class="form-group">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" aria-describedby="login-email" tabindex="1" required="" autofocus/>
                </div>
                <button type="submit" class="btn btn-primary btn-block" tabindex="4">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('layout.admin.login-footer')