@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Schedule Task - Urut Pantang</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                 
                </div>
                <div class="content">
                      <div class="row">
                        <div class="col-md-10 ml-auto mr-auto">
                          <div class="card card-calendar">
                            <div class="card-body ">
                              {!! $calendar->calendar() !!}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
              <!-- end content-->
            </div>
            <!--  end card  -->
          </div>
          <!-- end col-md-12 -->
        </div>
        <!-- end row -->
      </div>
  <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script> 
  {!! $calendar->script() !!}
      
@endsection