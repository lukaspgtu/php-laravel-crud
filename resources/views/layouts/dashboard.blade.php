<!doctype html>

<html lang="en">

   <head>

      <!-- Required meta tags -->
      <meta charset="utf-8">

      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      @yield('title')

      <!-- Favicon -->
      <link rel="shortcut icon" href="assets/images/favicon.ico" />

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">

      <!-- SweetAlert2 CSS -->
      <link rel="stylesheet" href="assets/css/sweetalert2.min.css">

      <!-- Datatables CSS -->
      <link rel="stylesheet" href="assets/css/datatables.bootstrap.min.css">
      
      <!-- Typography CSS -->
      <link rel="stylesheet" href="assets/css/typography.css">

      <!-- Style CSS -->
      <link rel="stylesheet" href="assets/css/style.css">

      <!-- Responsive CSS -->
      <link rel="stylesheet" href="assets/css/responsive.css">

   </head>

   <body>

      @include('layouts.components.loading')

      <!-- Wrapper Start -->
      <div class="wrapper">
         
         @include('layouts.components.sidebar')
         
         @include('layouts.components.navbar')

         <!-- Page Content  -->
         @yield('content')

      </div>
      <!-- Wrapper END -->
      
      @include('layouts.components.footer')

      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>

      <!-- Jquery Validate -->
      <script src="assets/js/jquery.validate.min.js"></script>

      <!-- Appear JavaScript -->
      <script src="assets/js/jquery.appear.js"></script>

      <!-- Countdown JavaScript -->
      <script src="assets/js/countdown.min.js"></script>

      <!-- Counterup JavaScript -->
      <script src="assets/js/waypoints.min.js"></script>
      <script src="assets/js/jquery.counterup.min.js"></script>

      <!-- Wow JavaScript -->
      <script src="assets/js/wow.min.js"></script>

      <!-- Apexcharts JavaScript -->
      <script src="assets/js/apexcharts.js"></script>

      <!-- Slick JavaScript -->
      <script src="assets/js/slick.min.js"></script>

      <!-- Select2 JavaScript -->
      <script src="assets/js/select2.min.js"></script>

      <!-- Owl Carousel JavaScript -->
      <script src="assets/js/owl.carousel.min.js"></script>

      <!-- Magnific Popup JavaScript -->
      <script src="assets/js/jquery.magnific-popup.min.js"></script>

      <!-- Smooth Scrollbar JavaScript -->
      <script src="assets/js/smooth-scrollbar.js"></script>

      <!-- lottie JavaScript -->
      <script src="assets/js/lottie.js"></script>

      <!-- Datatables JavaScript -->
      <script src="assets/js/datatables.min.js"></script>
      <script src="assets/js/datatables.bootstrap.min.js"></script>

      <!-- Chart Custom JavaScript -->
      <script src="assets/js/chart-custom.js"></script>

      <!-- SweetAlert2 Javascript -->
      <script src="assets/js/sweetalert2.min.js"></script>
      <script src="assets/js/swal2.js"></script>

      <!-- Custom JavaScript -->
      <script src="assets/js/custom.js"></script>

      @yield('scripts')

   </body>

</html>
