@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-delivery-fast text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Booking Today</p>
                      @foreach($ordertoday as $key=>$data)
                      <p class="card-title">{{$data->numberofbooking}}
                        <p>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Update Now
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Total Sales</p>
                       <?php
                            $totalearn=0;
                        ?>
                        @foreach($salesmonth as $key=>$data)
                          <?php
                                $totalearn += $data->price;
                          ?>
                                    
                        @endforeach
                      <p class="card-title">RM {{$totalearn}}
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i> By Month
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-watch-time text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Pending Bookings</p>
                      @foreach($pendingorder as $key=>$data)
                      <p class="card-title">{{$data->pendingorders}}
                        <p>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i> In the last hour
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-chart-pie-36 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Complete Booking</p>
                      @foreach($completedorder as $key=>$data)
                      <p class="card-title">{{$data->completedorders}}
                        <p>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Update now
                </div>
              </div>
            </div>
          </div>
        
         

        <div class="row">
          <div class="col-lg-6">
            <div class="card  card-tasks">
              <div class="card-header ">
                <h4 class="card-title">Latest Bookings</h4>
                <h5 class="card-category">List of Latest Booking</h5>
              </div>
              <div class="card-body ">
                <div>
                  <table class="table">
                    <tbody>
                      @foreach($latestbook as $key=>$data)
                        <tr>
                          <td class="text-center" ><a><strong>{{$data->booking_id}}</strong></a></td>
                            <td><a>{{$data->service}}</a></td>
                            <td class="hidden-xs text-center">
                                {{$data->city}}
                            </td>
                            <td class="hidden-xs text-center">
                                {{$data->created_at}}
                            </td>
                            </tr>
                      @endforeach
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
          <div class="col-lg-6">
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">2018 Booking</h4>
                <p class="card-category">All Booking Overview</p>
              </div>
              <div class="card-body ">
                 <div style="height: 340px;">{!! $chart->container() !!}</div>
              </div>
              {!! $chart->script() !!}
              <div class="card-footer ">
                
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
