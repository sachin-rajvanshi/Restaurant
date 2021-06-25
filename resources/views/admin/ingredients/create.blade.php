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
                <li class="breadcrumb-item active">Add Cooking Level & Ingredients</li>
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
              <h4 class="card-title">Add Cooking Level & Ingredients</h4>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-primary add_more_ingredient_row">Add <i class="fas fa-plus"></i></button>
              <form action="{{ url('admin/ingredients') }}" method="post">
                @csrf
              <div class="dynamic_row">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Food Item</label>
                      <select class="select2 form-control" name="food[]" id="food" required="">
                        <option value="">Select Food Items</option>
                        @foreach($items as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Type</label>
                      <select class="form-control" name="type[]" id="type1" onchange="priceValidationCheck(1)" required="">
                        <option value="">Select Type</option>
                        <option value="cooking-level">Cooking Level</option>
                        <option value="ingredient">Extra Ingredients</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name[]" placeholder="Name" required="" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Price (If Any)</label>
                      <input type="number" class="form-control" name="price[]" id="price1" placeholder="Price (If Any)"/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Status</label>
                      <select class="form-control" name="status[]" required="">
                        <option value="Yes">Active</option>
                        <option value="No">Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Remark</label>
                      <input type="text" class="form-control" name="remark[]" placeholder="If Any"/>
                    </div>
                  </div>
                  
                </div>
              </div>
                <div class="col-md-12">
                  <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Add Cooking Level & Ingredients</button>
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

  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper       = $(".dynamic_row"); //Fields wrapper
    var add_button      = $(".add_more_ingredient_row"); //Add button ID
    var counter         = 2;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
        x++; 
        $(wrapper).append(`<div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Food Item</label>
                      <select class="select2 form-control" name="food[]" id="food" required="">
                        <option value="">Select Food Items</option>
                        @foreach($items as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Type</label>
                      <select class="form-control" name="type[]" id="type${x}" onchange="priceValidationCheck(${x})" required="">
                        <option value="">Select Type</option>
                        <option value="cooking-level">Cooking Level</option>
                        <option value="ingredient">Extra Ingredients</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name[]" placeholder="Name" required="" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Price (If Any)</label>
                      <input type="number" class="form-control" name="price[]"  id="price${x}" placeholder="Price (If Any)"/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Status</label>
                      <select class="form-control" name="status[]" required="">
                        <option value="Yes">Active</option>
                        <option value="No">Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Remark</label>
                      <input type="text" class="form-control" name="remark[]" placeholder="If Any"/>
                    </div>
                  </div>
                  <button type="button" class="btn btn-primary remove_ingredient_field"><i class="far fa-trash-alt"></i></button>
                </div>
                `);
      }
    });
    
    $(wrapper).on("click",".remove_ingredient_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent('div').remove(); x--;
    })
  });
  
</script>
@endsection