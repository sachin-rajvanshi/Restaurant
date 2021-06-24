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
                <li class="breadcrumb-item active">View Food Item</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/food/items') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="profile-pic">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner" role="listbox">
                  	@if(count($picked->getGallery) > 0)
                  		@foreach($picked->getGallery as $i => $image)
                  			@if($i == 0)
                  				<div class="carousel-item active">
                  				  <img class="img-fluid" src="{{ asset('storage') }}/{{ $image->image }}" alt="{{ $picked->name }}" />
                  				</div>
                  			@else
                  				<div class="carousel-item">
                  				  <img class="img-fluid" src="{{ asset('storage') }}/{{ $image->image }}" alt="{{ $picked->name }}" />
                  				</div>
                  			@endif
	                    @endforeach
                    @endif
                  </div>
                  <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="branch-buttons">
                <a href="{{ url('admin/food/items') }}/{{ $picked->id }}/edit" class="btn btn-primary waves-effect waves-float waves-light">Edit Food Item</a>
                <a href="#" class="btn btn-info waves-effect waves-float waves-light">Set Addon</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <ul class="profile-content">
                <li><b>Food Iten Name:</b> <span>{{ $picked->name }}</span></li>
                <li><b>Category:</b> <span>{{ $picked->getCategory ? $picked->getCategory->name : '' }}</span></li>
                <li><b>Sub Category:</b> <span>{{ $picked->getSubCategory ? $picked->getSubCategory->name : '' }}</span></li>
                <li><b>MRP:</b> <span>$ {{ $picked->getHighestPriceVarient($picked->id) ? $picked->getHighestPriceVarient($picked->id)->price : '' }}</span></li>
                <li><b>Discount (%):</b> <span>{{ $picked->getHighestPriceVarient($picked->id) ? $picked->getHighestPriceVarient($picked->id)->discount : 0 }} %</span></li>
                <li><b>Offer Price:</b> <span>$ {{ $picked->getHighestPriceVarient($picked->id) ? $picked->getHighestPriceVarient($picked->id)->final_price : '' }}</span></li>
                <li><b>Enable Stock:</b> <span>{{ $picked->stock }} | Stock Quantity: {{ $picked->getHighestStockVarient($picked->id) ? $picked->getHighestStockVarient($picked->id)->stock_quantity : 0 }}</span></li>
                <li><b>Enable Inventory:</b> <span>{{ $picked->inventory }}</span></li>
                <li><b>Enable COD:</b> <span>{{ $picked->cod }}</span></li>
                <li><b>Enable Home Delivery:</b> <span>{{ $picked->home_delivery }}</span></li>
                <li><b>Enable Takeaway:</b> <span>{{ $picked->takeaway }}</span></li>
                <li><b>URL:</b> <span><a href="#">{{ url('admin/admin/food/items') }}/{{ $picked->slug }}</a></span></li>
                <li><b>Remark:</b> <span>{{ $picked->reamrk }}</span></li>
                <li><b>Meta Title:</b> <span>{{ $picked->meta_title }}</span></li>
                <li><b>Meta Keyword:</b> <span>{{ $picked->keyword }}</span></li>
                <li><b>Meta Description:</b> <span>{{ $picked->description }}</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
              <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">View All Variants</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th width="170">Date & Time</th>
                      <th>Quantity Type</th>
                      <th class="text-center">MRP & Discount</th>
                      <th class="text-center">Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($picked->getVarients) > 0)
                    @foreach($picked->getVarients as $v => $varient)
                      <tr>
                        <td>#{{ $v+1 }}</td>
                        <td>{{ App\Helper\Helper::convertDateTime($varient->created_at) }}</td>
                        <td>{{ $varient->getQuantity ? $varient->getQuantity->type : 'N/A' }}</td>
                        <td class="text-center">
                          @if($varient->discount)
                            <span class="cutprice">${{ $varient->price }}</span> 
                            <span class="mainprice">${{ $varient->final_price }}</span> 
                            <span class="discountprice">off {{ $varient->discount }}%</span> 
                          @else
                            <span class="mainprice">${{ $varient->price }}</span> 
                          @endif
                        </td>
                        <td class="text-center">{{ $varient->stock_quantity }}</td>
                      </tr>
                    @endforeach
                    @else
                      <tr><td colspan="10" align="center">No any record found.</td></tr>
                    @endif
                    
                  </tbody>
                </table>
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