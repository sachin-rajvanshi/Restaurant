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
                <li class="breadcrumb-item active">Manage Cooking Level & Ingredients</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="add-ingredients.php" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Cooking Level & Ingredients</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Cooking Level & Ingredients</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Date & Time</th>
                      <th>Type</th>
                      <th>Name & Price(If any)</th>
                      <th>Price</th>
                      <th width="100">Status</th>
                      <th width="70">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td width="50">#1</td>
                      <td>12 May 2021, 12:33 PM</td>
                      <td>Cooking Level</td>
                      <td>Rare</td>
                      <td></td>
                      <td><span class="text-success">Active</span></td>
                      <td>
                        <a href="edit-ingredients.php" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="50">#2</td>
                      <td>12 May 2021, 12:33 PM</td>
                      <td>Cooking Level</td>
                      <td>Medium Rare </td>
                      <td></td>
                      <td><span class="text-success">Active</span></td>
                      <td>
                        <a href="edit-ingredients.php" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="50">#3</td>
                      <td>12 May 2021, 12:33 PM</td>
                      <td>Rice Type</td>
                      <td>White Rice </td>
                      <td></td>
                      <td><span class="text-success">Active</span></td>
                      <td>
                        <a href="edit-ingredients.php" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="50">#4</td>
                      <td>12 May 2021, 12:33 PM</td>
                      <td>Extra Ingredients</td>
                      <td>1.5 Ounce Hot Sauce</td>
                      <td><span>$ 0.50</span></td>
                      <td><span class="text-success">Active</span></td>
                      <td>
                        <a href="edit-ingredients.php" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="50">#5</td>
                      <td>12 May 2021, 12:33 PM</td>
                      <td>Rice Type</td>
                      <td>8 ounce Creamy Garlic Sauce</td>
                      <td><span>$ 2.50</span></td>
                      <td><span class="text-success">Active</span></td>
                      <td>
                        <a href="edit-ingredients.php" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
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

<?php include 'includes/footer.php'; ?>

@endsection
@section('page-scripts')

@endsection