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
                <li class="breadcrumb-item active">Manage Home Page Content Settings</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.dashboard') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
    	<!-- Manage Order Tax Setting  -->
    	<div class="row">
		    <div class="col-md-12">
		        <div class="card">
		            <div class="card-header">
		              <h4 class="card-title">Order Tax Setting</h4>
		            </div>
		            <div class="card-body">
		              <form action="{{ url('admin/update/order/tax') }}" method="POST">
		              @csrf
		              @method('PUT')
		              	<input type="hidden" name="tax_id" value="{{ $tax->id }}">
		                <div class="row">
							<div class="col-md-5">
								<div class="form-group">
  	  		                      	<label>Tax Name</label>
  	  		                      	<input type="text" name="name" class="form-control" value="{{ $tax->heading }}" required="">
  	  		                    </div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
  	  		                      	<label>Discount(%)</label>
  	  		                      	<input type="text" name="discount" class="form-control" value="{{ $tax->title }}" required="">
  	  		                    </div>
							</div>
							<div class="col-md-2 form-group">
								<button class="btn btn-primary waves-effect waves-float waves-light" type="submit" style="margin-top: 20px;">Update</button>
							</div>
		              	</div>
		         	 </form>
		      		</div>
		  		</div>
			</div>
		</div>
    	<!-- Manage Categories On Home -->
    	<div class="row">
		    <div class="col-md-12">
		        <div class="card">
		            <div class="card-header">
		              <h4 class="card-title">Manage Categories On Home</h4>
		            </div>
		            <div class="card-body">
		              <form action="{{ url('admin/update/home/page/categories') }}" method="POST">
		              @csrf
		              @method('PUT')
		              	<input type="hidden" name="cat_slug_id" value="{{ $s_category->id }}">
		                <div class="row">
							<div class="col-md-8">
								<div class="form-group">
			                      	<label>Select Categories</label>
			                      	<select class="select2 form-control" name="category[]" required="" multiple>
			                      		@foreach($categories as $category)
			                      			@if(in_array($category->id, explode(',', $s_category->ids)))
					                        	<option value="{{ $category->id }}" selected="">{{ $category->name }}</option>
					                        @else
					                        	<option value="{{ $category->id }}">{{ $category->name }}</option>
					                        @endif
				                        @endforeach
			                      	</select>
			                    </div>
							</div>
							<div class="col-md-4">
								<button class="btn btn-primary waves-effect waves-float waves-light" style="margin-top:20px;" type="submit">Update</button>
							</div>
		              	</div>
		         	 </form>
		      		</div>
		  		</div>
			</div>
		</div>
		<!-- Manage Famous Dish On Home -->
    	<div class="row">
		    <div class="col-md-12">
		        <div class="card">
		            <div class="card-header">
		              <h4 class="card-title">Manage Best Dish On Home</h4>
		            </div>
		            <div class="card-body">
		              <form action="{{ url('admin/update/home/page/best_food') }}" method="POST" enctype="multipart/form-data">
		              @csrf
		              @method('PUT')
		              	<input type="hidden" name="best_dish_id" value="{{ $best_dish->id }}">
		              	<div class="row">
		              	  <div class="col-md-2">
		              	    <div class="form-group">
		              	      <label>Upload Banner</label>
		              	      <div class="custom-img-uploader">
		              	        <div class="input-group">
		              	          <span class="input-group-btn">
		              	            <span class="btn-file">
		              	              <input type="file" name="image" id="imgSec">
		              	              	@if(Storage::exists($best_dish->image)) 
			                                <img id='upload-img' class="img-upload-block" src="{{ asset('storage/'.$best_dish->image) }}" alt="">
			                            @else
			                                <img id='upload-img' class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg" alt="">
			                            @endif
		              
		              	            </span>
		              	          </span>
		              	          <span><strong>Note: </strong>Please upload only png format file.</span>
		              	        </div>
		              	      </div>
		              	    </div>
		              	  </div>
		              	  <div class="col-md-10">
		              	  	<div class="row">
  	  		              	  <div class="col-md-6">
  	  		              	    <div class="form-group">
  	  		                      	<label>Select Food List</label>
  	  		                      	<select class="select2 form-control" name="food_id" required="">
  	  		                      		@foreach($food_items as $item)
  	  		                      			@if(in_array($item->id, explode(',', $best_dish->ids)))
  	  				                        	<option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
  	  				                        @else
  	  				                        	<option value="{{ $item->id }}">{{ $item->name }}</option>
  	  				                        @endif
  	  			                        @endforeach
  	  		                      	</select>
  	  		                    </div>
  	  		              	  </div>
  	  		              	  <div class="col-md-6">
  	  		              	    <div class="form-group">
  	  		                      	<label>Heading</label>
  	  		                      	<input type="text" name="heading" class="form-control" value="{{ $best_dish->heading }}" required="">
  	  		                    </div>
  	  		              	  </div>
  	  		              	  <div class="col-md-12">
  	  		              	    <div class="form-group">
  	  		                      	<label>Title</label>
  	  		                      	<textarea name="title" class="form-control" rows="4">{{ $best_dish->title }}</textarea>
  	  		                    </div>
  	  		              	  </div>
		              	  	</div>
		              	  </div>
		              	  <div class="col-md-12">
		                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update</button>
		                  </div>
		              	</div>
		         	 </form>
		      		</div>
		  		</div>
			</div>
		</div>
		<!-- Manage Popular Foods On Home -->
    	<div class="row">
			<div class="col-md-12">
		        <div class="card">
		            <div class="card-header">
		              <h4 class="card-title">Manage Popular Dishes On Home</h4>
		            </div>
		            <div class="card-body">
		              <form action="{{ url('admin/update/home/page/popular/foods') }}" method="POST">
		              @csrf
		              @method('PUT')
		              	<input type="hidden" name="popular_dish_id" value="{{ $popular_dishes->id }}">
		                <div class="row">
							<div class="col-md-3">
								<div class="form-group">
			                      	<label>Select Food Items</label>
			                      	<select class="select2 form-control" name="dishes[]" required="" multiple>
			                      		@foreach($food_items as $f_food)
			                      			@if(in_array($f_food->id, explode(',', $popular_dishes->ids)))
					                        	<option value="{{ $f_food->id }}" selected="">{{ $f_food->name }}</option>
					                        @else
					                        	<option value="{{ $f_food->id }}">{{ $f_food->name }}</option>
					                        @endif
				                        @endforeach
			                      	</select>
			                    </div>
							</div>
							<div class="col-md-3">
  	  		              	    <div class="form-group">
  	  		                      	<label>Heading</label>
  	  		                      	<input type="text" name="heading" class="form-control" value="{{ $popular_dishes->heading }}" required="">
  	  		                    </div>
  	  		              	</div>
  	  		              	<div class="col-md-3">
  	  		              	    <div class="form-group">
  	  		                      	<label>Title</label>
  	  		                      	<input type="text" name="title" class="form-control" value="{{ $popular_dishes->title }}" required="">
  	  		                    </div>
  	  		              	</div>
							<div class="col-md-3">
								<button class="btn btn-primary waves-effect waves-float waves-light" style="margin-top:20px;" type="submit">Update</button>
							</div>
		              	</div>
		         	 </form>
		      		</div>
		  		</div>
			</div>
		</div>
		<!-- Manage Testimonial Section -->
    	<div class="row">
		    <div class="col-md-12">
		        <div class="card">
		            <div class="card-header">
		              <h4 class="card-title">Manage Testimonials On Home</h4>
		            </div>
		            <div class="card-body">
		              <form action="{{ url('admin/update/home/page/testimonial') }}" method="POST" enctype="multipart/form-data">
		              @csrf
		              @method('PUT')
		              	<input type="hidden" name="testimonial_id" value="{{ $testimonial->id }}">
		              	<div class="row">
		              	  <div class="col-md-2">
		              	    <div class="form-group">
		              	      <label>Upload Banner</label>
		              	      <div class="custom-img-uploader">
		              	        <div class="input-group">
		              	          <span class="input-group-btn">
		              	            <span class="btn-file">
		              	              <input type="file" name="image" id="imgSec" onchange="dynamicBranchChangeImage(1, this)">
		              	              	@if(Storage::exists($testimonial->image)) 
			                                <img id='upload-img1' class="img-upload-block" src="{{ asset('storage/'.$testimonial->image) }}" alt="">
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
  	  		              	    <div class="form-group">
  	  		                      	<label>Heading</label>
  	  		                      	<input type="text" name="heading" class="form-control" value="{{ $testimonial->heading }}" required="">
  	  		                    </div>
  	  		              	  </div>
  	  		              	  <div class="col-md-12">
  	  		              	    <div class="form-group">
  	  		                      	<label>Title</label>
  	  		                      	<textarea name="title" class="form-control" rows="4">{{ $testimonial->title }}</textarea>
  	  		                    </div>
  	  		              	  </div>
		              	  	</div>
		              	  </div>
		              	  <div class="col-md-12">
		                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update</button>
		                  </div>
		              	</div>
		         	 </form>
		      		</div>
		  		</div>
			</div>
		</div>
		<!-- Manage Online Content Section -->
    	<div class="row">
		    <div class="col-md-12">
		        <div class="card">
		            <div class="card-header">
		              <h4 class="card-title">Manage Online Content Section On Home</h4>
		            </div>
		            <div class="card-body">
		              <form action="{{ url('admin/update/home/page/online/section') }}" method="POST" enctype="multipart/form-data">
		              @csrf
		              @method('PUT')
		              	<input type="hidden" name="online_id" value="{{ $online->id }}">
		              	<div class="row">
		              	  <div class="col-md-2">
		              	    <div class="form-group">
		              	      <label>Upload Banner</label>
		              	      <div class="custom-img-uploader">
		              	        <div class="input-group">
		              	          <span class="input-group-btn">
		              	            <span class="btn-file">
		              	              <input type="file" name="image" id="imgSec" onchange="dynamicBranchChangeImage(2, this)">
		              	              	@if(Storage::exists($online->image)) 
			                                <img id='upload-img2' class="img-upload-block" src="{{ asset('storage/'.$online->image) }}" alt="">
			                            @else
			                                <img id='upload-img2' class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg" alt="">
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
  	  		              	    <div class="form-group">
  	  		                      	<label>Heading</label>
  	  		                      	<input type="text" name="heading" class="form-control" value="{{ $online->heading }}" required="">
  	  		                    </div>
  	  		              	  </div>
  	  		              	  <div class="col-md-6">
  	  		              	    <div class="form-group">
  	  		                      	<label>Title</label>
  	  		                      	<input type="text" name="title" class="form-control" value="{{ $online->title }}" required="">
  	  		                    </div>
  	  		              	  </div>
  	  		              	  <div class="col-md-12">
  	  		              	    <div class="form-group">
  	  		                      	<label>Description</label>
  	  		                      	<textarea name="description" class="form-control" rows="4">{{ $online->description }}</textarea>
  	  		                    </div>
  	  		              	  </div>
		              	  	</div>
		              	  </div>
		              	  <div class="col-md-12">
		                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update</button>
		                  </div>
		              	</div>
		         	 </form>
		      		</div>
		  		</div>
			</div>
		</div>
		<!-- Manage Gallery Section Header Content -->
    	<div class="row">
		    <div class="col-md-12">
		        <div class="card">
		            <div class="card-header">
		              <h4 class="card-title">Manage Gallery Header Content</h4>
		            </div>
		            <div class="card-body">
		              <form action="{{ url('admin/update/home/gallery/content') }}" method="POST" enctype="multipart/form-data">
		              @csrf
		              @method('PUT')
		              	<input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
	              	  	<div class="row">
	  		              	  <div class="col-md-5">
	  		              	    <div class="form-group">
	  		                      	<label>Heading</label>
	  		                      	<input type="text" name="heading" class="form-control" value="{{ $gallery->heading }}" required="">
	  		                    </div>
	  		              	  </div>
	  		              	  <div class="col-md-5">
	  		              	    <div class="form-group">
	  		                      	<label>Title</label>
	  		                      	<input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required="">
	  		                    </div>
	  		              	  </div>
	  		              	  <div class="col-md-2" style="margin-top: 20px;">
		                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update</button>
		                  </div>
	              	  	</div>
		         	 </form>
		      		</div>
		  		</div>
			</div>
		</div>
		<!-- Manage Contact Header Content -->
    	<div class="row">
		    <div class="col-md-12">
		        <div class="card">
		            <div class="card-header">
		              <h4 class="card-title">Manage Contact Page Content</h4>
		            </div>
		            <div class="card-body">
		              <form action="{{ url('admin/update/home/contact/content') }}" method="POST" enctype="multipart/form-data">
		              @csrf
		              @method('PUT')
		              	<input type="hidden" name="contact_id" value="{{ $contact->id }}">
	              	  	<div class="row">
	  		              	  <div class="col-md-4">
	  		              	    <div class="form-group">
	  		                      	<label>Heading</label>
	  		                      	<input type="text" name="heading" class="form-control" value="{{ $contact->heading }}" required="">
	  		                    </div>
	  		              	  </div>
	  		              	  <div class="col-md-4">
	  		              	    <div class="form-group">
	  		                      	<label>Title</label>
	  		                      	<input type="text" name="title" class="form-control" value="{{ $contact->title }}" required="">
	  		                    </div>
	  		              	  </div>
	  		              	  <div class="col-md-4">
	  		              	    <div class="form-group">
	  		                      	<label>Opening Time</label>
	  		                      	<input type="text" name="office_time" class="form-control" value="{{ $contact->image }}" required="">
	  		                    </div>
	  		              	  </div>
	  		              	  <div class="col-md-12">
	  		              	    <div class="form-group">
	  		                      	<label>Map Link</label>
	  		                      	<input type="text" name="map_link" class="form-control" value="{{ $contact->description }}" required="">
	  		                    </div>
	  		              	  </div>
	              	  	</div>
	              	  	<div class="col-md-2" style="margin-top: 20px;">
	                    	<button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update</button>
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