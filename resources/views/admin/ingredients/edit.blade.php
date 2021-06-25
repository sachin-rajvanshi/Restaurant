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
                <li class="breadcrumb-item active">UpdateCooking Level & Ingredients</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/ingredients') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">UpdateCooking Level & Ingredients</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/ingredients') }}/{{ $picked->id }}" method="post">
                @csrf
                @method('PATCH')
              <div class="dynamic_row">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Food Item</label>
                      <select class="select2 form-control" name="food" id="food" required="">
                        <option value="">Select Food Items</option>
                        @foreach($items as $item)
                          @if($picked->food_id == $item->id)
                            <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                          @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Type</label>
                      <select class="form-control" name="type" id="type1" onchange="priceValidationCheck(1)" required="">
                        <option value="">Select Type</option>
                        <option value="cooking-level" @if($picked->type == 'cooking-level') selected @endif>Cooking Level</option>
                        <option value="ingredient" @if($picked->type == 'ingredient') selected @endif>Extra Ingredients</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $picked->name }}" required="" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Price (If Any)</label>
                      <input type="number" class="form-control" name="price" id="price1" value="{{ $picked->price }}" placeholder="Price (If Any)"/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Status</label>
                      <select class="form-control" name="status" required="">
                        <option value="Yes" @if($picked->status == 'Yes') selected @endif>Active</option>
                        <option value="No" @if($picked->status == 'No') selected @endif>Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Remark</label>
                      <input type="text" class="form-control" name="remark" value="{{ $picked->remark }}" placeholder="If Any"/>
                    </div>
                  </div>
                  
                </div>
              </div>
                <div class="col-md-12">
                  <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update Cooking Level & Ingredients</button>
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
<script type="text/javascript">
  function priceValidationCheck(count) {
    var type = $('#type'+count).val();
    if(type == 'ingredient') {
      $('#price'+count).attr('required', true);
    }else {
       $('#price'+count).removeAttr('required');
    }
  }  
</script>
@endsection