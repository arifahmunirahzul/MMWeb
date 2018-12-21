<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/logo.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    MOBILE MUSLIM
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="{{ URL::asset('https://fonts.googleapis.com/css?family=Montserrat:400,700,200') }}" rel="stylesheet" />
  <link href="{{ URL::asset('https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/paper-dashboard.css') }}" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/select2-bootstrap.min.css') }}">

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="brown" data-active-color="primary">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="{{ asset('assets/img/logo.png') }}" >
          </div>
        </a>
        <a href="" class="simple-text logo-normal">
          MOBILE MUSLIM
          
        </a>
      </div>
                       <?php
                         if (!function_exists('classActivePath')) {
                                function classActivePath($path)
                                {
                                    $path = explode('.', $path);
                                    $segment = 1;
                                    foreach($path as $p) {
                                            if((request()->segment($segment) == $p) == false) {
                                            return '';
                                }
                                    $segment++;
                                }
                                return 'active';
                                }
                        }
                        ?>
      <div class="sidebar-wrapper">
        <div class="user" >
          <div class="photo">
             @if(Auth::user()->url_image == '')
                    <img src="{{ asset('assets/img/default-avatar.png') }}" alt="...">
                    @endif
             @if(Auth::user()->url_image != '')
                    <img src="{{ url('/') }}/upload/userpic/<?php echo Auth::user()->url_image; ?>" alt="...">
             @endif
          </div>
          <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
                {{ucwords(Auth::user()->name)}}
                <b class="caret"></b>
              </span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="{!! classActivePath('view-edit-profile') !!}">
                  <a href="{{url('/view-edit-profile')}}">
                    <span class="sidebar-mini-icon">EP</span>
                    <span class="sidebar-normal">Edit Profile</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="{!! classActivePath('home') !!}" >
            <a href="{{url('/home')}}">
              <i class="nc-icon nc-tv-2"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @if(Auth::user()->role == 'Admin')
           <li class="{!! classActivePath('user') !!}">
            <a href="{{url('/user')}}">
              <i class="nc-icon nc-circle-10"></i>
              <p>User Management</p>
            </a>
          </li>
           <li class="{!! classActivePath('pending-approval') !!}">
            <a href="{{url('/pending-approval')}}">
              <i class="fa fa-history"></i>
              <p>PENDING APPROVAL</p>
            </a>
          </li>
          <li>
            <a data-toggle="collapse" href="#formsBooking">
              <i class="fa fa-pencil-square-o"></i>
              <p>
                BOOK A SERVICE
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="formsBooking">
              <ul class="nav">
                <li class="{!! classActivePath('view-book-pembantu-rumah') !!}">
                  <a href="{{url('/view-book-pembantu-rumah')}}">
                    <span class="sidebar-mini-icon">PR</span>
                    <span class="sidebar-normal"> PEMBANTU RUMAH (HARIAN) </span>
                  </a>
                </li>
                <li class="{!! classActivePath('view-book-urut-pantang') !!}">
                  <a href="{{url('/view-book-urut-pantang')}}">
                    <span class="sidebar-mini-icon">UP</span>
                    <span class="sidebar-normal"> URUT PANTANG </span>
                  </a>
                </li>
                <li class="{!! classActivePath('view-book-katering') !!}">
                  <a href="{{url('/view-book-katering')}}">
                    <span class="sidebar-mini-icon">KTG</span>
                    <span class="sidebar-normal"> KATERING</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
            <li>
            <a data-toggle="collapse" href="#formsSchedule">
              <i class="fa fa-calendar"></i>
              <p>
                Schedule Task
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="formsSchedule">
              <ul class="nav">
                <li class="{!! classActivePath('view-task-pembantu-rumah') !!}">
                  <a href="{{url('/view-task-pembantu-rumah')}}">
                    <span class="sidebar-mini-icon">PR</span>
                    <span class="sidebar-normal"> PEMBANTU RUMAH (HARIAN) </span>
                  </a>
                </li>
                <li class="{!! classActivePath('view-task-urut-pantang') !!}">
                  <a href="{{url('/view-task-urut-pantang')}}">
                    <span class="sidebar-mini-icon">UP</span>
                    <span class="sidebar-normal"> URUT PANTANG </span>
                  </a>
                </li>
                <li class="{!! classActivePath('view-task-katering') !!}">
                  <a href="{{url('/view-task-katering')}}">
                    <span class="sidebar-mini-icon">KTG</span>
                    <span class="sidebar-normal"> KATERING</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="{!! classActivePath('list-job-request') !!}">
            <a href="{{url('/list-job-request')}}">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>Job Request</p>
            </a>
          </li>
          <li class="{!! classActivePath('provider-quotation') !!}">
            <a href="{{url('/provider-quotation')}}">
              <i class="nc-icon nc-briefcase-24"></i>
              <p>Provider Quotation</p>
            </a>
          </li>
          <li>
            <a data-toggle="collapse" href="#formsExamples">
              <i class="nc-icon nc-tile-56"></i>
              <p>
                Tables
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="formsExamples">
              <ul class="nav">
                <li class="{!! classActivePath('type-service') !!}">
                  <a href="{{url('/type-service')}}">
                    <span class="sidebar-mini-icon">TS</span>
                    <span class="sidebar-normal"> TYPE SERVICE </span>
                  </a>
                </li>
                <li class="{!! classActivePath('type-property') !!}">
                  <a href="{{url('/type-property')}}">
                    <span class="sidebar-mini-icon">TP</span>
                    <span class="sidebar-normal"> TYPE PROPERTY </span>
                  </a>
                </li>
                <li class="{!! classActivePath('type-event') !!}">
                  <a href="{{url('/type-event')}}">
                    <span class="sidebar-mini-icon">TE</span>
                    <span class="sidebar-normal"> TYPE EVENT </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          @endif
          @if(Auth::user()->role == 'Service Provider' && Auth::user()->approval_status == 'Approved')
           <li class="{!! classActivePath('job-pending') !!}">
            <a href="{{url('/job-pending')}}">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>Pending Job Request</p>
            </a>
          </li>
          <li class="{!! classActivePath('status-quotation') !!}">
            <a href="{{url('/status-quotation')}}">
              <i class="nc-icon nc-bulb-63"></i>
              <p>Quotation Status</p>
            </a>
          </li> 
          @endif
          <li>
            <a href="{{url('/logout')}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
              <i class="nc-icon nc-user-run"></i>
              <p>Logout</p>
            </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    style="display: none;">
                    {{ csrf_field() }}
             </form>
          </li>
         
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-icon btn-round">
                <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
                <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
              </button>
            </div>
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">MOBILE MUSLIM</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
             <!--  <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div> -->
            </form>
           <!--  <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="#pablo">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="#pablo">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul> -->
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header">
  
  <canvas id="bigDashboardChart"></canvas>
  
  
</div> -->

  <!-- Main Container -->
           @yield('content')
  <!-- END Main Container -->


  <!--   Core JS Files   -->
 
  <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{ asset('assets/js/plugins/sweetalert2.min.js') }}"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{ asset('assets/js/plugins/jquery.validate.min.js') }}"></script>
  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js') }}"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.js') }}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{ asset('assets/js/plugins/bootstrap-tagsinput.js') }}"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js') }}"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{ asset('assets/js/plugins/jquery-jvectormap.js') }}"></script>
  <!--  Plugin for the Bootstrap Table -->
  <script src="{{ asset('assets/js/plugins/nouislider.min.js') }}"></script>
  <!-- Chart JS -->
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/paper-dashboard.min.js?v=2.0.1') }}" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('assets/demo/demo.js') }}"></script>

  <script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>


  <script>
    $('#edit').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var booking_id = button.data('mybooking')
      var name = button.data('myname') 
      var service = button.data('myservice') 
      var price = button.data('myprice')
      var message = button.data('mymessage')
      var status = button.data('mystatus')    

      var modal = $(this)
      
      modal.find('.modal-body #booking_id').val(booking_id);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #service').val(service);
      modal.find('.modal-body #price').val(price);
      modal.find('.modal-body #message').val(message);
      modal.find('.modal-body #status').val(status);
    })

    $('#myModalGrabJB').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var job_id = button.data('job_id')
      
      var modal = $(this)
      
      modal.find('.modal-body #job_id').val(job_id);
      
    })

   
    $('#deleteBookingPR').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var booking_id = button.data('booking_id')
      
      var modal = $(this)
      
      modal.find('.modal-body #booking_id').val(booking_id);
      
    })

    $('#deleteBookingUP').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var booking_id = button.data('booking_id')
      
      var modal = $(this)
      
      modal.find('.modal-body #booking_id').val(booking_id);
      
    })

     $('#deleteKatering').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var booking_id = button.data('booking_id')
      
      var modal = $(this)
      
      modal.find('.modal-body #booking_id').val(booking_id);
      
    })

    $('#delete').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var id = button.data('id')
      
      var modal = $(this)
      
      modal.find('.modal-body #id').val(id);
      
    })

     $('#myModalAddCredit').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var company_name = button.data('mycompany_name')
      var service = button.data('myservice')
      var id = button.data('myid')
      
      var modal = $(this)
      
      modal.find('.modal-body #company_name').val(company_name);
      modal.find('.modal-body #service').val(service);
      modal.find('.modal-body #id').val(id);
      
    })

     $('#editPR').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var booking_id = button.data('booking_id')
      var job_id = button.data('job_id') 
      var name = button.data('name') 
      var u_phone = button.data('u_phone')
      var date_booking = button.data('date_booking')
      var duration = button.data('duration')  
      var type_property = button.data('type_property')
      var address = button.data('address')
      var city = button.data('city')
      var postcode = button.data('postcode')
      var state = button.data('state') 
      var clean_area = button.data('clean_area')
      var message = button.data('message')        

      var modal = $(this)
      
      modal.find('.modal-body #booking_id').val(booking_id);
      modal.find('.modal-body #job_id').val(job_id);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #u_phone').val(u_phone);
      modal.find('.modal-body #date_booking').val(date_booking);
      modal.find('.modal-body #duration').val(duration);
      modal.find('.modal-body #type_property').val(type_property);
      modal.find('.modal-body #address').val(address);
      modal.find('.modal-body #city').val(city);
      modal.find('.modal-body #postcode').val(postcode);
      modal.find('.modal-body #state').val(state);
      modal.find('.modal-body #clean_area').val(clean_area);
      modal.find('.modal-body #message').val(message);
      
    })

    $('#editUP').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var booking_id = button.data('booking_id')
      var job_id = button.data('job_id') 
      var name = button.data('name') 
      var u_phone = button.data('u_phone')
      var date_booking = button.data('date_booking')
      var package = button.data('package')  
      var address = button.data('address')
      var city = button.data('city')
      var postcode = button.data('postcode')
      var state = button.data('state') 
      var message = button.data('message')        

      var modal = $(this)
      
      modal.find('.modal-body #booking_id').val(booking_id);
      modal.find('.modal-body #job_id').val(job_id);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #u_phone').val(u_phone);
      modal.find('.modal-body #date_booking').val(date_booking);
      modal.find('.modal-body #package').val(package);
      modal.find('.modal-body #address').val(address);
      modal.find('.modal-body #city').val(city);
      modal.find('.modal-body #postcode').val(postcode);
      modal.find('.modal-body #state').val(state);
      modal.find('.modal-body #message').val(message);
      
    })

    $('#editKatering').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var booking_id = button.data('booking_id')
      var job_id = button.data('job_id') 
      var name = button.data('name') 
      var u_phone = button.data('u_phone')
      var date_booking = button.data('date_booking')
      var total_visitor = button.data('total_visitor')  
      var type_event = button.data('type_event')  
      var address = button.data('address')
      var city = button.data('city')
      var postcode = button.data('postcode')
      var state = button.data('state') 
      var message = button.data('message')        

      var modal = $(this)
      
      modal.find('.modal-body #booking_id').val(booking_id);
      modal.find('.modal-body #job_id').val(job_id);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #u_phone').val(u_phone);
      modal.find('.modal-body #date_booking').val(date_booking);
      modal.find('.modal-body #total_visitor').val(total_visitor);
      modal.find('.modal-body #type_event').val(type_event);
      modal.find('.modal-body #address').val(address);
      modal.find('.modal-body #city').val(city);
      modal.find('.modal-body #postcode').val(postcode);
      modal.find('.modal-body #state').val(state);
      modal.find('.modal-body #message').val(message);
      
    })
 </script>
  <script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [5, 10, 15, -1],
          [5, 10, 15, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }

      });

      var table = $('#datatable').DataTable();

      // Edit record
      // table.on('click', '.edit', function() {
      //   $tr = $(this).closest('tr');

      //   var data = table.row($tr).data();
      //   alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      // });

      // // Delete a record
      // table.on('click', '.remove', function(e) {
      //   $tr = $(this).closest('tr');
      //   table.row($tr).remove().draw();
      //   e.preventDefault();
      // });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
  </script>
   

</body>

</html>