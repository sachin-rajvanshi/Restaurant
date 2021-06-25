@php
  $header_content = App\Helper\Helper::getHeaderContent();
@endphp
<!doctype html>
<html class="no-js" lang="zxx">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Restaurant</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage') }}/{{ $header_content->favicon }}">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/slicknav.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/slick.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/toasts/dist/toast.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>

  <body>
    <header>
      <div class="header-area">
        <div class="main-header ">
          <div class="header-top">
            <div class="container">
              <div class="col-xl-12">
                <div class="row d-flex justify-content-between align-items-center">
                  <div class="header-info-left">
                    <ul>
                      <li>@if($header_content->email_permission == 'Yes') {{ $header_content->email }} @endif</li>
                      <li>@if($header_content->contact_permission == 'Yes') {{ $header_content->phone_number }} @endif</li>
                    </ul>
                  </div>
                  <div class="header-info-right">
                    @if(!\Auth::user())
                      <ul>
                        <li><a href="{{ url('user/login') }}"><i class="ti-user"></i>Login</a></li>
                        <li><a href="{{ url('user/registration') }}"><i class="ti-lock"></i>Register</a></li>
                      </ul>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="header-bottom header-sticky">
            <div class="container">
              <div class="menu-wrapper">
                <div class="logo logo2">
                  <a href="{{ url('/') }}"><img src="{{ asset('storage') }}/{{ $header_content->favicon }}" alt=""></a>
                </div>
                <div class="cart-account">
                  <a href="cart.php"><i class="ti-shopping-cart"></i><span class="cart-number">2</span></a>
                  <a href="#"><i class="ti-user"></i></a>
                </div>
                <div class="main-menu d-none d-lg-block">
                  <nav>
                    <ul id="navigation">
                      <li><a href="{{ url('/') }}">Home</a></li>
                      <li><a href="javascript:void(0)">About <i class="ti-angle-down menuarrow"></i></a>
                        <ul class="submenu">
                          <li><a href="{{ url('about') }}">Our Story</a></li>
                          <li><a href="{{ url('career') }}">Careers</a></li>
                          <li><a href="{{ url('gallery') }}">Photo Galleries</a></li>
                          <li><a href="media-reviews.php">Media Reviews</a></li>
                          <li><a href="{{ url('guest/review') }}">Guest Reviews</a></li>
                        </ul>
                      </li>
                      <li><a href="{{ url('all/food/items') }}">Food Items</a></li>
                      <li><a href="{{ url('offer') }}">Offers</a></li>
                      <li><a href="{{ url('contact') }}">Contact</a></li>
                      @if(\Auth::user())
                        <li><a href="#">My Account <i class="ti-angle-down menuarrow"></i></a>
                          <ul class="submenu">
                            <li><a href="{{ route('user.profile') }}">Profile</a></li>
                            <li><a href="#">Orders</a></li>
                            <li><a href="#">Favourites</a></li>
                            <li><a href="user.logout">Logout</a></li>
                          </ul>
                        </li>
                      @endif
                      <li class="desktop-cart"><a href="{{ url('cart') }}"><i class="ti-shopping-cart cartmenu"></i><span class="cart-number" id="cart_number">{{ count((array) session('cart')) }}</span></a></li>
                    </ul>
                  </nav>
                </div>
                <div class="header-search d-none d-lg-block">
                  <form action="#" class="form-box f-right ">
                    <input type="text" name="Search" placeholder="Search here...">
                    <div class="search-icon">
                      <i class="fas fa-search special-tag"></i>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-12">
                <div class="mobile_menu d-block d-lg-none"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="loading" id="loading"></div>