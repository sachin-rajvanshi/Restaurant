<div class="horizontal-menu-wrapper">
  <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto">
          <a class="navbar-brand" href="index.html">
            <span class="brand-logo">
              <img src="{{ asset('') }}/admin/images/logo.png" alt="">
            </span>
          </a>
        </li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="navbar-container main-menu-content" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="dropdown nav-item active" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="{{ route('admin.dashboard') }}" data-toggle="dropdown"><span>Dashboard</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.dashboard') }}" data-toggle="dropdown"><span>eCommerce</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="analytics-dashboard.php" data-toggle="dropdown"><span>Analytics</span></a>
            </li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><span>Branch & Permission</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/branch') }}" data-toggle="dropdown"><span>Manage Branch</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/kitchen') }}" data-toggle="dropdown"><span>Manage Kitchen</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/team') }}" data-toggle="dropdown"><span>Manage Team / Delivery Boy</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/post') }}" data-toggle="dropdown"><span>Manage Posts</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="permission-setting.php" data-toggle="dropdown"><span>Permission Setting</span></a>
            </li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><span>Food Items</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/category') }}" data-toggle="dropdown"><span>Manage Categories & Sub Categories</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/quantity') }}" data-toggle="dropdown"><span>Manage Quantity</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/food/items') }}" data-toggle="dropdown"><span>Manage Food Items</span></a>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/food/items') }}" data-toggle="dropdown"><span>Manage Cooking Level & Ingredients</span></a>
            </li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><span>Offers & Coupons</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/deals') }}" data-toggle="dropdown"><span>Manage Hot Deals</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/coupons') }}" data-toggle="dropdown"><span>Manage Coupons</span></a>
            </li>
          </ul>
        </li>
        
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><span>Inventory</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-suppliers.php" data-toggle="dropdown"><span>Manage Suppliers</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-product-category.php" data-toggle="dropdown"><span>Manage Product Category</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-products.php" data-toggle="dropdown"><span>Manage Products</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-purchase-order.php" data-toggle="dropdown"><span>Manage Purchase Orders</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-inventory.php" data-toggle="dropdown"><span>Manage Inventory</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-purchasing-invoice.php" data-toggle="dropdown"><span>Manage Purchasing Invoice</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-supplies.php" data-toggle="dropdown"><span>Manage Supplies</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-payments-credits.php" data-toggle="dropdown"><span>Manage Payments & Credits</span></a>
            </li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><span>Customer & Orders</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-customer.php" data-toggle="dropdown"><span>Manage Customers</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-order.php" data-toggle="dropdown"><span>Manage Orders</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-payment-history.php" data-toggle="dropdown"><span>Manage Payment History</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="dropdown"><span>Manage Cancelled & Rejected Orders</span></a>
            </li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><span>Reports</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="dropdown"><span>Manage Periodic Reports</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="dropdown"><span>Manage Inventory Reports</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="dropdown"><span>Manage Order Reports</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="dropdown"><span>Manage Payment Reports</span></a>
            </li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><span>Support</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-complaint-type.php" data-toggle="dropdown"><span>Manage Complaint Type</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-complaints.php" data-toggle="dropdown"><span>Manage Complaints</span></a>
            </li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><span>Request Forms</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-contact-enquiry.php" data-toggle="dropdown"><span>Manage Contact Us Enquiry</span></a>
            </li>
            <li data-menu="">
              <a class="dropdown-item d-flex align-items-center" href="manage-carrer-enquiry.php" data-toggle="dropdown"><span>Manage Career Enquiry</span></a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="loading" id="loading"></div>