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
                <li class="breadcrumb-item active">Add Hot Deals</li>
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
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Add Hot Deals</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/deals') }}" method="post">
              	@csrf
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Offer Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Offer Name" value="{{ old('name') }}" required="" />
                      @if($errors->has('name'))
					    <div class="error">{{ $errors->first('name') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Category</label>
                      <select class="select2 form-control" name="category[]" id="category" onchange="getSubCategoriesByArray()" required="" multiple>
                        @foreach($categories as $category)
                        	<option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                      @if($errors->has('category'))
					    <div class="error">{{ $errors->first('category') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Sub Category</label>
                      <select class="select2 form-control" name="sub_category[]" id="sub_category"  onchange="getFoodItems()" multiple>
                      </select>
                      @if($errors->has('sub_category'))
					    <div class="error">{{ $errors->first('sub_category') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Food Items</label>
                      <select class="select2 form-control" name="food_items[]" id="food_items" required="" multiple>
                      </select>
                      @if($errors->has('food_items'))
					    <div class="error">{{ $errors->first('food_items') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Offer Discount (%)</label>
                      <input type="text" class="form-control" name="discount" value="{{ old('discount') }}" placeholder="Offer Discount (%)" required="" />
                      @if($errors->has('discount'))
					    <div class="error">{{ $errors->first('discount') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Max Discount Value</label>
                      <input type="text" class="form-control" name="max_discount" value="{{ old('max_discount') }}" placeholder="Max Discount Value" required="" />
                      @if($errors->has('max_discount'))
					    <div class="error">{{ $errors->first('max_discount') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Min Order Value</label>
                      <input type="text" class="form-control" placeholder="Min Order Value" name="min_order" value="{{ old('min_order') }}" required="" />
                      @if($errors->has('min_order'))
					    <div class="error">{{ $errors->first('min_order') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Offer Start Date</label>
                      <input type="text" class="form-control flatpickr" placeholder="Offer Start Date" id="account-birth-date" name="start_date" value="{{ old('start_date') }}" required="" />
                      @if($errors->has('start_date'))
					    <div class="error">{{ $errors->first('start_date') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Offer End Date</label>
                      <input type="text" class="form-control flatpickr" placeholder="Offer Start Date" id="account-birth-date" name="end_date" value="{{ old('end_date') }}" required="" />
                      @if($errors->has('end_date'))
					    <div class="error">{{ $errors->first('end_date') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Applied For</label>
                      <select class="select2 form-control" name="apply_for[]" required="" multiple>
                        <option value="New">New User</option>
                        <option value="Existing">Existing user</option>
                        <option value="Premium">Premium User</option>
                      </select>
                      @if($errors->has('apply_for'))
					    <div class="error">{{ $errors->first('apply_for') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Per User Usage</label>
                      <input type="number" class="form-control" name="usages" value="{{ old('usages') }}" placeholder="How many time customer use?" required="" />
                      @if($errors->has('usages'))
					    <div class="error">{{ $errors->first('usages') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Add Hot Deal</button>
                  </div>
                </div>
              </form>
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