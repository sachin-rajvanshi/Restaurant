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
                <li class="breadcrumb-item active">Update Hot Deals</li>
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
              <h4 class="card-title">Update Hot Deals</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/deals') }}/{{ $picked->id }}" method="post">
              	@csrf
                @method('PATCH')
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Offer Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Offer Name" value="{{ $picked->name }}" required="" />
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
                          @if(in_array($category->id, explode(',', $picked->category)))
                            <option value="{{ $category->id }}" selected="">{{ $category->name }}</option>
                          @else
                        	  <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endif
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
                        @foreach($sub_categories as $sub_category)
                          @if(in_array($sub_category->id, explode(',', $picked->sub_category)))
                            <option value="{{ $sub_category->id }}" selected="">{{ $sub_category->name }}</option>
                          @else
                            <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                          @endif
                        @endforeach
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
                        @foreach($food_items as $item)
                          @if(in_array($item->id, explode(',', $picked->food_items)))
                            <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                          @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endif
                        @endforeach
                      </select>
                      @if($errors->has('food_items'))
					    <div class="error">{{ $errors->first('food_items') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Offer Discount (%)</label>
                      <input type="text" class="form-control" name="discount" value="{{ $picked->discount }}" placeholder="Offer Discount (%)" required="" />
                      @if($errors->has('discount'))
					    <div class="error">{{ $errors->first('discount') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Max Discount Value</label>
                      <input type="text" class="form-control" name="max_discount" value="{{ $picked->max_discount }}" placeholder="Max Discount Value" required="" />
                      @if($errors->has('max_discount'))
					    <div class="error">{{ $errors->first('max_discount') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Min Order Value</label>
                      <input type="text" class="form-control" placeholder="Min Order Value" name="min_order" value="{{ $picked->min_order }}" required="" />
                      @if($errors->has('min_order'))
					    <div class="error">{{ $errors->first('min_order') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Offer Start Date</label>
                      <input type="text" class="form-control flatpickr" placeholder="Offer Start Date" id="account-birth-date" name="start_date" value="{{ $picked->start_date }}" required="" />
                      @if($errors->has('start_date'))
					    <div class="error">{{ $errors->first('start_date') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Offer End Date</label>
                      <input type="text" class="form-control flatpickr" placeholder="Offer Start Date" id="account-birth-date" name="end_date" value="{{ $picked->end_date }}" required="" />
                      @if($errors->has('end_date'))
					    <div class="error">{{ $errors->first('end_date') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Applied For</label>
                      <select class="select2 form-control" name="apply_for[]" required="" multiple>
                        <option value="New" @if(in_array('New', explode(',', $picked->apply_for))) selected  @endif>New User</option>
                        <option value="Existing" @if(in_array('Existing', explode(',', $picked->apply_for))) selected  @endif>Existing user</option>
                        <option value="Premium" @if(in_array('Premium', explode(',', $picked->apply_for))) selected  @endif>Premium User</option>
                      </select>
                      @if($errors->has('apply_for'))
					    <div class="error">{{ $errors->first('apply_for') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Per User Usage</label>
                      <input type="number" class="form-control" name="usages" value="{{ $picked->usages }}" placeholder="How many time customer use?" required="" />
                      @if($errors->has('usages'))
					    <div class="error">{{ $errors->first('usages') }}</div>
					  @endif
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update Hot Deal</button>
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