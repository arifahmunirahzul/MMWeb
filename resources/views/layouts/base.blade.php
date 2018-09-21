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
  <link href="{{ asset('assets/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('assets/demo/demo.css" rel="stylesheet') }}" />
</head>

<body class="login-page">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container">
      <div class="navbar-wrapper">
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
       <ul class="navbar-nav">
         <!--  <li class="nav-item">
            <a href="dashboard.html" class="nav-link">
              <i class="nc-icon nc-layout-11"></i> Dashboard
            </a>
          </li> -->
          <li class="nav-item ">
            <a href="{{ route('register') }}"class="nav-link">
              <i class="nc-icon nc-book-bookmark"></i> Register
            </a>
          </li>
          <li class="nav-item  active ">
            <a href="{{ route('login') }}" class="nav-link">
              <i class="nc-icon nc-tap-01"></i> Login
            </a>
          </li>
          <!-- <li class="nav-item ">
            <a href="user.html" class="nav-link">
              <i class="nc-icon nc-satisfied"></i> User
            </a>
          </li>
          <li class="nav-item ">
            <a href="lock.html" class="nav-link">
              <i class="nc-icon nc-key-25"></i> Lock
            </a>
          </li> -->
        </ul>
      </div> 
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page ">
    <div class="full-page section-image" filter-color="blue" data-image="{{ asset('assets/img/bg/cleaning.jpg') }}">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      
         <!--Main Content-->
                   @yield('basecontent')
         <!--End Main Content-->
    </div>
  </div>
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
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js') }}"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.js') }}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{ asset('assets/js/plugins/bootstrap-tagsinput.js') }}"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js') }}"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{ asset('assets/js/plugins/jquery-jvectormap.js') }}"></script>
  <!--  Plugin for the Bootstrap Table -->
  <script src="{{ asset('assets/js/plugins/nouislider.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <script src="{{ URL::asset('https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE') }}"></script>
  <!-- Chart JS -->
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/paper-dashboard.min.js?v=2.0.1') }}" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('assets/demo/demo.js') }}"></script>
  <script>
    $(document).ready(function() {
      demo.checkFullPageBackgroundImage();
    });
  </script>
</body>

</html>