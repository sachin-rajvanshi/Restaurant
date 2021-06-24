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
                <li class="breadcrumb-item active">Promotional Banner</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('admin.addPromotionalBanners') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Banner</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Promotional Banner List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Banner ID</th>
                      <th>Date & Time</th>
                      <th>Banner Name</th>
                      <th>Banner Position</th>
                      <th>Application</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($banners) > 0)
                      @foreach($banners as $b => $banner)
                      <tr>
                        <td>#{{ $b+1 }}</td>
                        <td>{{ App\Helper\Helper::convertDateTime($banner->created_at) }}</td>
                        <td>
                          <div class="table-image">
                            @if (Storage::exists($banner->image)) 
                                <img src="{{ asset('storage/'.$banner->image) }}">
                            @else
                                <img src="{{ asset('') }}admin/images/dummy.jpg">
                            @endif
                            <span>{{ $banner->name }}</span>
                          </div>
                        </td>
                        <td>{{ $banner->position }}</td>
                        <td>{{ $banner->applications }}</td>
                        <td>@if($banner->status == 'Yes') <span class="text-success">Active</span> @else <span class="text-danger">Inactive</span>  @endif</td>
                        <td>
                          @if (Storage::exists($banner->image)) 
                             <a href="{{ asset('storage/'.$banner->image) }}" class="btn btn-success btn-sm-custom waves-effect waves-float waves-light" target="_blank"><i class="far fa-eye"></i></a>
                          @endif
                          <a href="{{ route('admin.editPromotionalBanners', $banner->id) }}" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                          @if($banner->status == 'Yes') 
                            <a href="javascript:void(0)" onclick="changeStatus('{{ $banner->id }}')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-times"></i></a>
                          @else  
                            <a href="javascript:void(0)" onclick="changeStatus('{{ $banner->id }}')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-check-circle"></i></a>
                          @endif
                          <a href="javascript:void(0)" onclick="deleteContent('{{ $banner->id }}')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    @else
                      <p>No any banners found!</p>
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
</div>

@endsection
@section('page-scripts')
<script type="text/javascript">
  function changeStatus(id) {
      swal({
          title: "Are you sure?",
          text: "Change Status Of This Banner",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
              url: '{{ url('admin/change-status/promotional/banners') }}',
              method: "POST",
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

  function deleteContent(id) {
      swal({
          title: "Are you sure?",
          text: "Delete This Banner",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
              url: '{{ url('admin/delete/promotional/banners') }}',
              method: "POST",
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