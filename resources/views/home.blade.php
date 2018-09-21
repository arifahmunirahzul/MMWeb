@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
           <div class="row">
          <div class="col-md-3">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Email Statistics</h5>
                <p class="card-category">Last Campaign Performance</p>
              </div>
              <div class="card-body ">
                <canvas id="chartDonut1" class="ct-chart ct-perfect-fourth" width="456" height="300"></canvas>
              </div>
              <div class="card-footer ">
                <div class="legend">
                  <i class="fa fa-circle text-info"></i> Open
                </div>
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar"></i> Number of emails sent
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">New Visitators</h5>
                <p class="card-category">Out Of Total Number</p>
              </div>
              <div class="card-body ">
                <canvas id="chartDonut2" class="ct-chart ct-perfect-fourth" width="456" height="300"></canvas>
              </div>
              <div class="card-footer ">
                <div class="legend">
                  <i class="fa fa-circle text-warning"></i> Visited
                </div>
                <hr>
                <div class="stats">
                  <i class="fa fa-check"></i> Campaign sent 2 days ago
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Orders</h5>
                <p class="card-category">Total number</p>
              </div>
              <div class="card-body ">
                <canvas id="chartDonut3" class="ct-chart ct-perfect-fourth" width="456" height="300"></canvas>
              </div>
              <div class="card-footer ">
                <div class="legend">
                  <i class="fa fa-circle text-danger"></i> Completed
                </div>
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i> Updated 3 minutes ago
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Subscriptions</h5>
                <p class="card-category">Our Users</p>
              </div>
              <div class="card-body ">
                <canvas id="chartDonut4" class="ct-chart ct-perfect-fourth" width="456" height="300"></canvas>
              </div>
              <div class="card-footer ">
                <div class="legend">
                  <i class="fa fa-circle text-secondary"></i> Ended
                </div>
                <hr>
                <div class="stats">
                  <i class="fa fa-history"></i> Total users
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card  card-tasks">
              <div class="card-header ">
                <h4 class="card-title">Tasks</h4>
                <h5 class="card-category">Backend development</h5>
              </div>
              <div class="card-body ">
                <div class="table-full-width table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" checked>
                              <span class="form-check-sign"></span>
                            </label>
                          </div>
                        </td>
                        <td class="img-row">
                          <div class="img-wrapper">
                            <img src="ssets/img/faces/ayo-ogunseinde-2.jpg" class="img-raised" />
                          </div>
                        </td>
                        <td class="text-left">Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                            <i class="nc-icon nc-ruler-pencil"></i>
                          </button>
                          <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                            <i class="nc-icon nc-simple-remove"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox">
                              <span class="form-check-sign"></span>
                            </label>
                          </div>
                        </td>
                        <td class="img-row">
                          <div class="img-wrapper">
                            <img src="assets/img/faces/erik-lucatero-2.jpg" class="img-raised" />
                          </div>
                        </td>
                        <td class="text-left">Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                            <i class="nc-icon nc-ruler-pencil"></i>
                          </button>
                          <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                            <i class="nc-icon nc-simple-remove"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" checked>
                              <span class="form-check-sign"></span>
                            </label>
                          </div>
                        </td>
                        <td class="img-row">
                          <div class="img-wrapper">
                            <img src="assets/img/faces/kaci-baum-2.jpg" class="img-raised" />
                          </div>
                        </td>
                        <td class="text-left">Using dummy content or fake information in the Web design process can result in products with unrealistic
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                            <i class="nc-icon nc-ruler-pencil"></i>
                          </button>
                          <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                            <i class="nc-icon nc-simple-remove"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox">
                              <span class="form-check-sign"></span>
                            </label>
                          </div>
                        </td>
                        <td class="img-row">
                          <div class="img-wrapper">
                            <img src="{{ asset('assets/img/faces/joe-gardner-2.jpg') }}" class="img-raised" />
                          </div>
                        </td>
                        <td class="text-left">But I must explain to you how all this mistaken idea of denouncing pleasure</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                            <i class="nc-icon nc-ruler-pencil"></i>
                          </button>
                          <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                            <i class="nc-icon nc-simple-remove"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh spin"></i> Updated 3 minutes ago
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">2018 Sales</h4>
                <p class="card-category">All products including Taxes</p>
              </div>
              <div class="card-body ">
                <canvas id="chartActivity"></canvas>
              </div>
              <div class="card-footer ">
                <div class="legend">
                  <i class="fa fa-circle text-info"></i> Tesla Model S
                  <i class="fa fa-circle text-danger"></i> BMW 5 Series
                </div>
                <hr>
                <div class="stats">
                  <i class="fa fa-check"></i> Data information certified
                </div>
              </div>
            </div>
          </div>
        </div>
       
      </div>
     
    </div>
  </div>
@endsection
