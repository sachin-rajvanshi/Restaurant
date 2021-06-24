@php
  $header_content = App\Helper\Helper::getHeaderContent();
@endphp
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Restaurant Admin">
    <meta name="keywords" content="Restaurant Admin">
    <title>Restaurant Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage') }}/{{ $header_content->favicon }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/chart-apex.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/form-flat-pickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/css/alert.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/toasts/dist/toast.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="{{ asset('') }}admin/js/tree.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  </head>

  <body class="horizontal-layout horizontal-menu  navbar-floating footer-static" data-open="hover" data-menu="horizontal-menu" data-col="">
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-brand-center" data-nav="brand-center">
      <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav">
          <li class="nav-item">
            <a class="navbar-brand" href="{{ route('home') }}">
              <span class="brand-logo">
              <img src="{{ asset('storage') }}/{{ $header_content->favicon }}" alt="">
            </span>
            </a>
          </li>
        </ul>
      </div>
      <div class="navbar-container d-flex content align-items-center">
        <div class="bookmark-wrapper d-flex align-items-center">
          <ul class="nav navbar-nav d-xl-none">
            <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
          </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
          <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
            <div class="search-input">
              <div class="search-input-icon"><i data-feather="search"></i></div>
              <input class="form-control input" type="text" placeholder="Search..." tabindex="-1" data-search="search">
              <div class="search-input-close"><i data-feather="x"></i></div>
              <ul class="search-list search-list-main"></ul>
            </div>
          </li>

          <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <div class="dropdown-header d-flex">
                  <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                  <div class="badge badge-pill badge-light-primary">6 New</div>
                </div>
              </li>
              <li class="scrollable-container media-list">
                <a class="d-flex" href="javascript:void(0)">
                  <div class="media d-flex align-items-start">
                    <div class="media-left">
                      <div class="avatar"><img src="{{ asset('') }}/admin/images/avtar.png" alt="avatar" width="32" height="32"></div>
                    </div>
                    <div class="media-body">
                      <p class="media-heading"><span class="font-weight-bolder">Congratulation Sam </span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                    </div>
                  </div>
                </a>
                <a class="d-flex" href="javascript:void(0)">
                  <div class="media d-flex align-items-start">
                    <div class="media-left">
                      <div class="avatar"><img src="{{ asset('') }}/admin/images/avtar.png" alt="avatar" width="32" height="32"></div>
                    </div>
                    <div class="media-body">
                      <p class="media-heading"><span class="font-weight-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                    </div>
                  </div>
                </a>
                <a class="d-flex" href="javascript:void(0)">
                  <div class="media d-flex align-items-start">
                    <div class="media-left">
                      <div class="avatar bg-light-danger">
                        <div class="avatar-content">MD</div>
                      </div>
                    </div>
                    <div class="media-body">
                      <p class="media-heading"><span class="font-weight-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                    </div>
                  </div>
                </a>
                <a class="d-flex" href="javascript:void(0)">
                  <div class="media d-flex align-items-start">
                    <div class="media-left">
                      <div class="avatar bg-light-danger">
                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                      </div>
                    </div>
                    <div class="media-body">
                      <p class="media-heading"><span class="font-weight-bolder">Server down</span>&nbsp;registered</p><small class="notification-text"> USA Server is down due to hight CPU usage</small>
                    </div>
                  </div>
                </a>
                <a class="d-flex" href="javascript:void(0)">
                  <div class="media d-flex align-items-start">
                    <div class="media-left">
                      <div class="avatar bg-light-success">
                        <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i></div>
                      </div>
                    </div>
                    <div class="media-body">
                      <p class="media-heading"><span class="font-weight-bolder">Sales report</span>&nbsp;generated</p><small class="notification-text"> Last month sales report generated</small>
                    </div>
                  </div>
                </a>
                <a class="d-flex" href="javascript:void(0)">
                  <div class="media d-flex align-items-start">
                    <div class="media-left">
                      <div class="avatar bg-light-warning">
                        <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                      </div>
                    </div>
                    <div class="media-body">
                      <p class="media-heading"><span class="font-weight-bolder">High memory</span>&nbsp;usage</p><small class="notification-text"> BLR Server using high memory</small>
                    </div>
                  </div>
                </a>
              </li>
              <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="all-notifications.php">Read all notifications</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown dropdown-user">
            <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ficon" data-feather="settings"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
              <h4 class="setting-head">Web & App Setting</h4>
              <a class="dropdown-item" href="{{ route('admin.manageHeader') }}">Header Setting</a>
              <a class="dropdown-item" href="{{ route('admin.manageFooter') }}">Footer Setting</a>
              <a class="dropdown-item" href="{{ route('admin.managePromotionalBanners') }}">Promotional Banners</a>
              <a class="dropdown-item" href="{{ route('admin.manageFeedback') }}">Feedback & Testimonial</a>
              <a class="dropdown-item" href="{{ route('admin.manageFaq') }}">Manage FAQ</a>
              <h4 class="setting-head">Company Profile</h4>
              <a class="dropdown-item" href="{{ route('admin.manageAbout') }}">About Us</a>
              <a class="dropdown-item" href="{{ route('admin.manageQuality') }}">Our Quality</a>
              <a class="dropdown-item" href="{{ route('admin.manageTerms') }}">Terms & Conditions</a>
              <a class="dropdown-item" href="{{ route('admin.managePolicy') }}">Privacy Policy</a>
              <a class="dropdown-item" href="{{ route('admin.manageRefundContent') }}">Refunds & Cancellation</a>
              <a class="dropdown-item" href="{{ route('admin.manageCookieContent') }}">Cookies Policy</a>
              <a class="dropdown-item" href="{{ url('admin/categories/gallery') }}">Gallery Category</a>
              <a class="dropdown-item" href="{{ url('admin/gallery') }}">Gallery</a>
              <a class="dropdown-item" href="{{ url('admin/email/template') }}">Email Templates</a>
              <a class="dropdown-item" href="{{ route('admin.homePageSettings') }}">Home Page Content Settings</a>
            </div>
          </li>
          <li class="nav-item dropdown dropdown-user">
            <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ficon" data-feather="mail"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
              <a class="dropdown-item" href="email-templates.php">Manage Email Templates</a>
              <a class="dropdown-item" href="sms-templates.php">Manage SMS Templates</a>
            </div>
          </li>
          <li class="nav-item dropdown dropdown-user">
            <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name font-weight-bolder">{{ \Auth::user()->name }}</span>
                <span class="user-status">{{ ucfirst(\Auth::user()->role) }}</span>
              </div>
              <span class="avatar">
                @if (Storage::exists(\Auth::user()->profile_photo)) 
                  <img class="round" src="{{ asset('storage/'.\Auth::user()->profile_photo) }}" alt="{{ \Auth::user()->name }}" height="40" width="40">
                @else
                  <img class="round" src="{{ asset('') }}/admin/images/dummy-user.jpg" alt="{{ \Auth::user()->name }}" height="40" width="40">
                @endif
                <span class="avatar-status-online"></span>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
              <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="mr-50" data-feather="user"></i> Profile</a>
              <a class="dropdown-item" href="{{ route('admin.edit.profile') }}"><i class="mr-50" data-feather="settings"></i> Settings</a>
              <a class="dropdown-item" onclick="adminLogout()"><i class="mr-50" data-feather="power"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    @include('layout.admin.menu')