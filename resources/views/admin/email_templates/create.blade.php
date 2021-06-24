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
                <li class="breadcrumb-item active">Add Email Template</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ url('admin/email/template') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Add Email Template</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('admin/email/template') }}" method="post" enctype="multipart/form-data">
              	@csrf
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload Template Image</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="file" id="imgSec">
                              <img id='upload-img' class="img-upload-block" src="{{ asset('') }}admin/images/plus-upload.jpg"/>
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name" onkeyup="getTemplateCode()" required="" />
                    </div>
                    <div class="form-group">
                      <label>Code</label>
                      <input type="text" class="form-control" placeholder="Template Code" name="code" id="code" readonly="" required="" />
                    </div>
                    <div class="form-group">
						          <label>Subject</label>
						          <input type="text" class="form-control" placeholder="Enter Subject" name="subject" required="" />
                    </div>
                    <div class="form-group">
                      <label>Show Button</label>
                      <select class="form-control" name="button" required="">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Button HTML</label>
                      <textarea class="form-control" name="button_html"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status" required="">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="form-group">
                    	<label>Template</label>
               		  	<textarea id="description" name="description"></textarea>
               		 </div>
                  </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Add Template</button>
                  </div>
              </form>
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
<script type="text/javascript">
  function getTemplateCode() {
      var name        = $('#name').val();
      var rand_number = '{{ rand(1000, 9999) }}';
      var main        = name.toUpperCase().replace(/\s/g, '');
      var render      = main+'-'+rand_number;
      $('#code').val(render);
  }
</script>
@endsection