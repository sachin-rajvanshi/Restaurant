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
                <li class="breadcrumb-item active">About Us</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ \Auth::user()->website }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Go to Website</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">About Us</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.updateAbout') }}" method="POST" enctype="multipart/form-data">
              	@csrf
              	<input type="hidden" name="id" value="{{ $about->id }}">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload About Image</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="image_one" id="imgSec" onchange="dynamicBranchChangeImage(1, this)">
                              @if (Storage::exists($about->section_one_image)) 
                                <img id='upload-img1' class="img-upload-block" src="{{ asset('storage/'.$about->section_one_image) }}" alt="">
                              @else
                                <img id='upload-img1' class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg" alt="">
                              @endif
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                  	<div class="row">
                  		<div class="col-md-6">
                  			<label>Heading</label>
                  			<div class="form-group">
	                  			<input type="text" class="form-control" name="heading" placeholder="Enter About Heading" value="{{ $about->heading }}" required="">
	                  		</div>
                  		</div>
                  		<div class="col-md-6">
                  			<label>Title</label>
                  			<div class="form-group">
	                  			<input type="text" class="form-control" name="title" placeholder="Enter About Title" value="{{ $about->title }}" required="">
	                  		</div>
                  		</div>
                  	</div>
                  	<div class="row">
                  		<div class="col-md-6">
                  			<label>Tag Line One</label>
                  			<div class="form-group">
	                  			<input type="text" class="form-control" name="tag_one" placeholder="" value="{{ $about->tag_one }}" required="">
	                  		</div>
                  		</div>
                  		<div class="col-md-6">
                  			<label>Tag Line Two</label>
                  			<div class="form-group">
	                  			<input type="text" class="form-control" name="tag_two" placeholder="" value="{{ $about->tag_two }}" required="">
	                  		</div>
                  		</div>
                  	</div>
                    <div class="form-group">
                    	<textarea id="description" name="description_one">{{ $about->section_one_description }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload About Image</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="image_two" id="imgSec" onchange="dynamicBranchChangeImage(2, this)">
                              @if (Storage::exists($about->section_two_image)) 
                                <img id='upload-img1' class="img-upload-block" src="{{ asset('storage/'.$about->section_two_image) }}" alt="">
                              @else
                                <img id='upload-img'1 class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg" alt="">
                              @endif
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                    	<textarea id="description_two" name="description_two">{{ $about->section_two_description }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Food Items</label>
                      <input type="text" class="form-control" name="food_items" value="{{ $about->food_items }}" placeholder="Total Number of Food Items" required="" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Clients Daily</label>
                      <input type="text" class="form-control" placeholder="Total Clients Daily" value="{{ $about->clients_daily }}" name="clients_daily" required="" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Years of Experience</label>
                      <input type="text" class="form-control" placeholder="Years of Experience" value="{{ $about->years_of_experience }}" name="experience" required="" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Fresh & Halal</label>
                      <input type="text" class="form-control" placeholder="Total Number of Fresh & Halal" name="fresh_halal" value="{{ $about->fresh_halal }}" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update About</button>
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
<script type="text/javascript">
	ClassicEditor
	    .create( document.querySelector( '#description_two' ), {
	        extraPlugins: [ SimpleUploadAdapterPlugin ],
	    }) 
	    .catch( error => {
	        console.error( error );
	    } );
</script>
@endsection