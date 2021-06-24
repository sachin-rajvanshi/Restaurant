@extends('layout.admin.main')

@section('content')
    	
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
          <section id="dashboard-ecommerce">
            <div class="dashboard-boxes">
              <div class="row">
                <div class="col-md-3">
                  <div class="card card-statistics">
                    <div class="boxes-block">
                      <a href="#">
                        <i class="fas fa-hamburger"></i>
                        <h4><span>120</span> Total Food Items</h4>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card card-statistics">
                    <div class="boxes-block">
                      <a href="#">
                        <i class="fas fa-biking"></i>
                        <h4><span>234</span> Total Orders</h4>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card card-statistics">
                    <div class="boxes-block">
                      <a href="#">
                        <i class="fas fa-hotel"></i>
                        <h4><span>34</span> Total Branches</h4>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card card-statistics">
                    <div class="boxes-block">
                      <a href="#">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <h4><span>$ 9874</span> Total Payments</h4>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row match-height">
              <div class="col-lg-6 col-12">
                <div class="card card-company-table">
                  <div class="card-header">
                    <h4 class="card-title">Recent Customers</h4>
                    <div class="d-flex align-items-center">
                      <p class="card-text font-small-2 mr-25 mb-0">
                        <a href="#" class="btn btn-primary btn-sm">Today</a>
                        <a href="#" class="btn btn-primary btn-sm">7 Days</a>
                        <a href="#" class="btn btn-primary btn-sm">30 Days</a>
                      </p>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>+91 999 999 9999</td>
                            <td>Lucknow</td>
                            <td><span class="text-success">Active</span></td>
                            <td><button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Blcok</button></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>+91 999 999 9999</td>
                            <td>Lucknow</td>
                            <td><span class="text-success">Active</span></td>
                            <td><button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Blcok</button></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>+91 999 999 9999</td>
                            <td>Lucknow</td>
                            <td><span class="text-success">Active</span></td>
                            <td><button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Blcok</button></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>+91 999 999 9999</td>
                            <td>Lucknow</td>
                            <td><span class="text-success">Active</span></td>
                            <td><button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Blcok</button></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>+91 999 999 9999</td>
                            <td>Lucknow</td>
                            <td><span class="text-success">Active</span></td>
                            <td><button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Blcok</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-12">
                <div class="card card-company-table">
                  <div class="card-header">
                    <h4 class="card-title">Recent Payments</h4>
                    <div class="d-flex align-items-center">
                      <p class="card-text font-small-2 mr-25 mb-0">
                        <a href="#" class="btn btn-primary btn-sm">Today</a>
                        <a href="#" class="btn btn-primary btn-sm">7 Days</a>
                        <a href="#" class="btn btn-primary btn-sm">30 Days</a>
                      </p>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Amount Received</th>
                            <th>Payment Mode</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>$ 1200</td>
                            <td>Online</td>
                            <td><span class="text-success">Received</span></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>$ 1200</td>
                            <td>Offline</td>
                            <td><span class="text-warning">Pending</span></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>$ 1200</td>
                            <td>Online</td>
                            <td><span class="text-success">Received</span></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>$ 1200</td>
                            <td>Online</td>
                            <td><span class="text-success">Received</span></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>$ 1200</td>
                            <td>Online</td>
                            <td><span class="text-success">Received</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-12">
                <div class="card card-company-table">
                  <div class="card-header">
                    <h4 class="card-title">Recent orders</h4>
                    <div class="d-flex align-items-center">
                      <p class="card-text font-small-2 mr-25 mb-0"><a href="#" class="btn btn-primary btn-sm">Today</a> <a href="#" class="btn btn-primary btn-sm">7 Days</a> <a href="#" class="btn btn-primary btn-sm">30 Days</a></p>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Order Id</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>City</th>
                            <th>Order Details</th>
                            <th>price</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>#2121</td>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>+91 999 999 9999</td>
                            <td>Lucknow</td>
                            <td>Chicken Briyani</td>
                            <td>$ 1200</td>
                            <td><span class="text-success">Complete</span></td>
                            <td>
                              <button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Accept</button>
                              <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></button>
                            </td>
                          </tr>
                          <tr>
                            <td>#2121</td>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>+91 999 999 9999</td>
                            <td>Lucknow</td>
                            <td>Chicken Briyani</td>
                            <td>$ 1200</td>
                            <td><span class="text-success">Complete</span></td>
                            <td>
                              <button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Accept</button>
                              <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></button>
                            </td>
                          </tr>
                          <tr>
                            <td>#2121</td>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>+91 999 999 9999</td>
                            <td>Lucknow</td>
                            <td>Chicken Briyani</td>
                            <td>$ 1200</td>
                            <td><span class="text-warning">Pending</span></td>
                            <td>
                              <button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Accept</button>
                              <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></button>
                            </td>
                          </tr>
                          <tr>
                            <td>#2121</td>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>+91 999 999 9999</td>
                            <td>Lucknow</td>
                            <td>Chicken Briyani</td>
                            <td>$ 1200</td>
                            <td><span class="text-success">Complete</span></td>
                            <td>
                              <button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Accept</button>
                              <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></button>
                            </td>
                          </tr>
                          <tr>
                            <td>#2121</td>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar rounded">
                                  <div class="avatar-content">
                                    <img src="images/avtar.png">
                                  </div>
                                </div>
                                <div>
                                  <div class="font-weight-bolder">John Methue</div>
                                  <div class="font-small-2 text-muted">johnmethue@gmail.com</div>
                                </div>
                              </div>
                            </td>
                            <td>+91 999 999 9999</td>
                            <td>Lucknow</td>
                            <td>Chicken Briyani</td>
                            <td>$ 1200</td>
                            <td><span class="text-success">Complete</span></td>
                            <td>
                              <button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Accept</button>
                              <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row match-height">
              <div class="col-lg-8 col-12">
                <div class="card card-revenue-budget">
                  <div class="row mx-0">
                    <div class="col-md-8 col-12 revenue-report-wrapper">
                      <div class="d-sm-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-50 mb-sm-0">Revenue Report</h4>
                        <div class="d-flex align-items-center">
                          <div class="d-flex align-items-center mr-2">
                            <span class="bullet bullet-primary font-small-3 mr-50 cursor-pointer"></span>
                            <span>Earning</span>
                          </div>
                          <div class="d-flex align-items-center ml-75">
                            <span class="bullet bullet-warning font-small-3 mr-50 cursor-pointer"></span>
                            <span>Refund</span>
                          </div>
                        </div>
                      </div>
                      <div id="revenue-report-chart"></div>
                    </div>
                    <div class="col-md-4 col-12 budget-wrapper">
                      <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              2020
                            </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);">2020</a>
                          <a class="dropdown-item" href="javascript:void(0);">2019</a>
                          <a class="dropdown-item" href="javascript:void(0);">2018</a>
                        </div>
                      </div>
                      <h2 class="mb-25">$ 25852000</h2>
                      <div class="d-flex justify-content-center">
                        <span class="font-weight-bolder mr-25">Budget:</span>
                        <span>50000000</span>
                      </div>
                      <div id="budget-chart"></div>
                      <button type="button" class="btn btn-primary">Increase Budget</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-12">
                <div class="row match-height">
                  <div class="col-lg-6 col-md-3 col-6">
                    <div class="card">
                      <div class="card-body pb-50">
                        <h6>Orders</h6>
                        <h2 class="font-weight-bolder mb-1">2,76k</h2>
                        <div id="statistics-order-chart"></div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-3 col-6">
                    <div class="card card-tiny-line-stats">
                      <div class="card-body pb-50">
                        <h6>Profit</h6>
                        <h2 class="font-weight-bolder mb-1">6,24k</h2>
                        <div id="statistics-profit-chart"></div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-6 col-12">
                    <div class="card earnings-card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-6">
                            <h4 class="card-title mb-1">Earnings</h4>
                            <div class="font-small-2">This Month</div>
                            <h5 class="mb-1">$ 405545</h5>
                            <p class="card-text text-muted font-small-2">
                              <span class="font-weight-bolder">68.2%</span><span> more earnings than last month.</span>
                            </p>
                          </div>
                          <div class="col-6">
                            <div id="earnings-chart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row match-height">
              <div class="col-xl-12 col-md-12 col-12">
                <div class="card card-statistics">
                  <div class="card-header">
                    <h4 class="card-title">Orders & Deliveries</h4>
                    <div class="d-flex align-items-center">
                      <p class="card-text font-small-2 mr-25 mb-0">Updated 1 month ago</p>
                    </div>
                  </div>
                  <div class="card-body statistics-body">
                    <div class="row">
                      <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="media">
                          <div class="avatar bg-light-primary mr-2">
                            <div class="avatar-content">
                              <i class="fas fa-biking"></i>
                            </div>
                          </div>
                          <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0">89</h4>
                            <p class="card-text font-small-3 mb-0">Total Takeaway</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="media">
                          <div class="avatar bg-light-info mr-2">
                            <div class="avatar-content">
                              <i class="fab fa-buffer"></i>
                            </div>
                          </div>
                          <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0">12K</h4>
                            <p class="card-text font-small-3 mb-0">Total Deliveries</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                        <div class="media">
                          <div class="avatar bg-light-danger mr-2">
                            <div class="avatar-content">
                              <i class="fab fa-creative-commons-nc"></i>
                            </div>
                          </div>
                          <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0">$ 14K</h4>
                            <p class="card-text font-small-3 mb-0">Total Refunds</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">
                        <div class="media">
                          <div class="avatar bg-light-success mr-2">
                            <div class="avatar-content">
                              <i class="fas fa-phone-slash"></i>
                            </div>
                          </div>
                          <div class="media-body my-auto">
                            <h4 class="font-weight-bolder mb-0">199</h4>
                            <p class="card-text font-small-3 mb-0">Total Cancelled & Rejected Orders</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        </div>
      </div>
    </div>

@endsection