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

              <h4 class="card-title mb-1">Login Your Account!</h4>
              <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>

              <form class="auth-login-form mt-2" action="{{ url('admin/login') }}" method="POST">
              @csrf
                <div class="form-group">
                  <label class="form-label">Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Mobile Number or Email Id" aria-describedby="login-email" value="{{ old('email') }}" tabindex="1" autofocus required="" />
                </div>
                <div class="form-group">
                  <div class="d-flex justify-content-between">
                    <label for="login-password">Password</label>
                    <a href="{{ route('forgotPassword') }}">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="Password" aria-describedby="login-password" required="" />
                    <div class="input-group-append">
                      <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="remember-me" tabindex="3" />
                    <label class="custom-control-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('layout.admin.login-footer')