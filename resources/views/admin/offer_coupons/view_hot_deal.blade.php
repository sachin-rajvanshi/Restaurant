@extends('layout.admin.main')
@section('content')

<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">View Hot Deal</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/deals') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <ul class="profile-content offer-block">
                <li class="branchname"><b>Name:</b> <span>{{ $picked->name }}</span></li>
                <li><b>Category:</b> <span>{{ $picked->getCategories($picked->category) }}</span></li>
                <li><b>Sub Category:</b> <span>{{ $picked->getSubCategories($picked->sub_category) }}</span></li>
                <li><b>Food Items:</b> <span>{{ $picked->getFoodItems($picked->food_items) }}</span></li>
                <li><b>Discount (%):</b> <span>{{ $picked->discount }} %</span></li>
                <li><b>Max Discount Value:</b> <span>$ {{ $picked->max_discount }}</span></li>
                <li><b>Min Order Value:</b> <span>$ {{ $picked->min_order }}</span></li>
                <li><b>Applied For:</b> <span>{{ $picked->apply_for }}</span></li>
                <li><b>Offer Start:</b> <span>{{ date('d M Y', strtotime($picked->start_date)) }}</span></li>
                <li><b>Offer End:</b> <span>{{ date('d M Y', strtotime($picked->end_date)) }}</span></li>
                <li><b>Per User Usage:</b> <span>{{ $picked->usages }} Time</span></li>
              </ul>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="branch-buttons">
                <a href="{{ url('admin/deals') }}/{{ $picked->id }}/edit" class="btn btn-primary waves-effect waves-float waves-light">Edit Hot Deal</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Offer History</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Customer Name</th>
                      <th>Category</th>
                      <th>Food Item Name</th>
                      <th>Quantity Type</th>
                      <th>QTY</th>
                      <th>Order Price</th>
                      <th>Discount</th>
                      <th>Usage</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td width="50">#1</td>
                      <td>John Methue</td>
                      <td>Chicken Dishes</td>
                      <td>Chicken Nuggets</td>
                      <td>Full</td>
                      <td>2</td>
                      <td>$ 200</td>
                      <td>$ 50</td>
                      <td>1 Time</td>
                    </tr>
                    <tr>
                      <td>#2</td>
                      <td>Alen Mask</td>
                      <td>Chicken Dishes</td>
                      <td>Chicken Nuggets</td>
                      <td>Full</td>
                      <td>2</td>
                      <td>$ 200</td>
                      <td>$ 50</td>
                      <td>1 Time</td>
                    </tr>
                    <tr>
                      <td>#3</td>
                      <td>Wanda</td>
                      <td>Chicken Dishes</td>
                      <td>Chicken Nuggets</td>
                      <td>Full</td>
                      <td>2</td>
                      <td>$ 200</td>
                      <td>$ 50</td>
                      <td>1 Time</td>
                    </tr>
                    <tr>
                      <td>#4</td>
                      <td>Ali Robert</td>
                      <td>Chicken Dishes</td>
                      <td>Chicken Nuggets</td>
                      <td>Full</td>
                      <td>2</td>
                      <td>$ 200</td>
                      <td>$ 50</td>
                      <td>1 Time</td>
                    </tr>
                    <tr>
                      <td>#5</td>
                      <td>John Robert</td>
                      <td>Chicken Dishes</td>
                      <td>Chicken Nuggets</td>
                      <td>Full</td>
                      <td>2</td>
                      <td>$ 200</td>
                      <td>$ 50</td>
                      <td>1 Time</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('page-scripts')

@endsection