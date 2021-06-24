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
                <li class="breadcrumb-item"><a href="ecommerce-dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Update Branch</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/branch') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Update Branch</h4>
            </div>
            <div class="card-body">
              <form method="post" action="{{ url('admin/branch') }}/{{ $user->id }}" enctype="multipart/form-data">
              	@csrf
                @method('PATCH')
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Branch Name</label>
                      <input type="text" class="form-control" placeholder="Branch Name" name="name" value="{{ $user->name }}" required="" />
                      	@if($errors->has('name'))
            						    <div class="error">{{ $errors->first('name') }}</div>
            						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Branch Manager Name</label>
                      <input type="text" class="form-control" placeholder="Branch Manager Name" name="manager_name" value="{{ $user->manager_name }}" />
                      	@if($errors->has('manager_name'))
						    <div class="error">{{ $errors->first('manager_name') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Mobile Number</label>
                      <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{ $user->mobile_number }}" required="" />
                      	@if($errors->has('mobile_number'))
						    <div class="error">{{ $errors->first('mobile_number') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email ID</label>
                      <input type="text" class="form-control" placeholder="Email ID" name="email" id="email" value="{{ $user->email }}" required="" />
                        @if($errors->has('email'))
						    <div class="error">{{ $errors->first('email') }}</div>
						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Full Address</label>
                      <input type="text" class="form-control" placeholder="Full Address" name="address" value="{{ $user->address }}" required="" />
                        @if($errors->has('address'))
  						    <div class="error">{{ $errors->first('address') }}</div>
  						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                  	<div class="form-group">
                      <label>Select Country</label>
                      <select class="form-control" name="country" id="country" onchange="getState()" required="">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                        	@if($user->country_id == $country->id)
                        		<option value="{{ $country->id }}" selected="">{{ $country->name }}</option>
                        	@else
                        		<option value="{{ $country->id }}">{{ $country->name }}</option>
                        	@endif
                        @endforeach()
                      </select>
                        @if($errors->has('country'))
  						    <div class="error">{{ $errors->first('country') }}</div>
  						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Select State</label>
                      <select class="form-control" name="state" id="state" onchange="getCity()" required="">
                          @foreach($states as $state)
                            @if($user->state_id == $state->id)
                              <option value="{{ $state->id }}" selected="">{{ $state->name }}</option>
                            @else
                              <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endif
                          @endforeach()
                      </select>
                        @if($errors->has('state'))
  						    <div class="error">{{ $errors->first('state') }}</div>
  						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>City</label>
                      <select class="form-control" name="city" id="city" required="">
                        @foreach($cities as $city)
                            @if($user->city_id == $city->id)
                              <option value="{{ $city->id }}" selected="">{{ $city->name }}</option>
                            @else
                              <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endif
                        @endforeach()
                      </select>
                        @if($errors->has('city'))
  						    <div class="error">{{ $errors->first('city') }}</div>
  						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Date of Open</label>
                      <input type="date" class="form-control" name="date_of_open" value="{{ $user->date_of_open }}" placeholder="Date of Open" required="" />
                        @if($errors->has('date_of_open'))
  						    <div class="error">{{ $errors->first('date_of_open') }}</div>
  						@endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      &nbsp;
                    </div>
                  </div>
                
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="customFile">Document Name & Upload Document File</label>
                      <div class="row input-wrapper">
                        @if(count($user->getDocuments) > 0)
                        @foreach($user->getDocuments as $d => $document)
                          <div class="inner-wrapper-upload col-md-2">
                              @if($errors->has('document_name'))
              	  						    <div class="error">{{ $errors->first('document_name') }}</div>
              	  						@endif
                              @if(Storage::exists($document->image))
                                @php
                                  $extension = pathinfo(storage_path('/storage/'.$document->image), PATHINFO_EXTENSION);
                                @endphp
                                  @if($extension == 'pdf')
                                    <div class="documents-list">
                                      <a href="{{ asset('storage') }}/{{ $document->image }}" target="_blank">
                                        <img src="{{ asset('') }}/images/pdf.png" alt="">
                                        <h4>{{ $document->name }}</h4>
                                      </a>
                                    </div>
                                    <button type="button" class="btn btn-danger" onclick="deleteDocument('{{ $document->id }}')"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                                  @else
                                    <div class="documents-list">
                                      <a href="{{ asset('storage') }}/{{ $document->image }}" target="_blank">
                                        <img src="{{ asset('storage') }}/{{ $document->image }}" alt="">
                                        <h4>{{ $document->name }}</h4>
                                      </a>
                                    </div>
                                    <button type="button" class="btn btn-danger" onclick="deleteDocument('{{ $document->id }}')"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                                  @endif
                              @else
                                <div class="documents-list">
                                  <a href="{{ asset('') }}admin/images/dummy.jpg" target="_blank">
                                    <img src="{{ asset('') }}admin/images/dummy.jpg" alt="">
                                    <h4>{{ $document->name }}</h4>
                                  </a>
                                </div>
                                <button type="button" class="btn btn-danger" onclick="deleteDocument('{{ $document->id }}')"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                              @endif
                          </div>
                        @endforeach
                        @endif
                        <div class="inner-wrapper-upload col-md-2">
                            <input type="text" class="form-control" name="document_name[]" id="document_name1" placeholder="Document Name" onkeyup="bannerFileRequire(1)" />
                              @if($errors->has('document_name'))
                                  <div class="error">{{ $errors->first('document_name') }}</div>
                              @endif
                            <div class="custom-img-uploader">
                              <div class="input-group">
                                <span class="input-group-btn">
                                  <span class="btn-file">
                                    <input type="file" name="file[]" id="file1" onchange="dynamicBranchChangeImage(1, this)">
                                    <img id='upload-img1' class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg"/>
                                  </span>
                                </span>
                              </div>
                            </div>
                            <a class="add_field_button"><i class="fas fa-plus"></i></a>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update Branch</button>
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
@if($errors->any())
<script type="text/javascript">
	setTimeout(function() {
		getState('{{ old('country') }}');
		getCity('{{ old('state') }}');
	}, 2000);
</script>
@endif
@endsection
@section('page-scripts')
<script type="text/javascript">
	function  bannerFileRequire(count) {
		var name = $('#document_name'+count).val();
		if(name != '') {
			$('#file'+count).attr('required', true);
		}else {
			$('#file'+count).removeAttr('required');
		}
	}

  function deleteDocument(id) {
    swal({
      title: "Are you sure?",
      text: "Delete This Document.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        $.ajax({
          url: '{{ url('admin/delete/branch/document') }}/'+id,
          method: "DELETE",
          data: {
            "_token": "{{ csrf_token() }}",
            'id'    : id,
          },
          beforeSend: function() {
            document.getElementById('loading').style.display = 'block';
          },
          success: function(response) {
            console.log(response);
            if(response.code === 200) {
              swal('', response.message, 'success');
              location.reload();
            }else {
              swal('', response.message, 'warning');
            }
          },
          error: function(response) {
            document.getElementById('loading').style.display = 'none';
          },
          complete: function() {
            document.getElementById('loading').style.display = 'none';
          }
        })
    }
    });
      
    }
</script>
@endsection