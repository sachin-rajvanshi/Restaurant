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
                <li class="breadcrumb-item active">Update Quality</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.manageQuality') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Update Quality</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.updateQuality') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $picked->id }}">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload Image</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" name="file" id="imgSec">
                              @if(Storage::exists($picked->image))
                                <img id='upload-img' class="img-upload-block" src="{{ asset('storage') }}/{{ $picked->image }}"/>
                              @else
                                <img id='upload-img' class="img-upload-block" src="{{ asset('') }}/admin/images/plus-upload.jpg"/>
                              @endif
                              
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Heading</label>
                      <input type="text" class="form-control" name="heading" placeholder="Heading" value="{{ $picked->heading }}" required="" />
                    </div>
                    <div class="form-group">
                      <label>Select Position</label>
                      <select class="form-control" name="position" required="">
                        <option value="1" @if($picked->position == 1) selected @endif>1</option>
                        <option value="2" @if($picked->position == 2) selected @endif>2</option>
                        <option value="3" @if($picked->position == 3) selected @endif>3</option>
                        <option value="4" @if($picked->position == 4) selected @endif>4</option>
                        <option value="5" @if($picked->position == 5) selected @endif>5</option>
                        <option value="6" @if($picked->position == 6) selected @endif>6</option>
                        <option value="7" @if($picked->position == 7) selected @endif>7</option>
                        <option value="8" @if($picked->position == 8) selected @endif>8</option>
                        <option value="9" @if($picked->position == 9) selected @endif>9</option>
                        <option value="10" @if($picked->position == 10) selected @endif>10</option>
                        <option value="11" @if($picked->position == 11) selected @endif>11</option>
                        <option value="12" @if($picked->position == 12) selected @endif>12</option>
                        <option value="13" @if($picked->position == 13) selected @endif>13</option>
                        <option value="14" @if($picked->position == 14) selected @endif>14</option>
                        <option value="15" @if($picked->position == 15) selected @endif>15</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Select Status</label>
                      <select class="form-control" name="status">
                        <option value="Yes" @if($picked->status == 'Yes') selected="" @endif>Active</option>
                        <option value="No" @if($picked->status == 'No') selected="" @endif>Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Content</label>
                      <textarea class="form-control" name="content" rows="6" placeholder="Enter Content" required="">{{ $picked->content }}</textarea>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update Quality</button>
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