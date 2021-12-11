<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>FASTrack Asset Management</title>
  @yield('link')
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/iconfonts/font-awesome/css/font-awesome.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('vendors/iconfonts/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('vendors/lightgallery/css/lightgallery.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
  
</head>
<body class="sidebar-dark">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('layouts.setting')
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('layouts.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
  <script src="{{ asset('js/lodash.js') }}"></script>
  <script src="{{ asset('js/jquery.steps.js') }}"></script>
  <script src="{{ asset('js/jquery.steps.min.js') }}"></script>
  <script src="{{ asset('vendors/lightgallery/js/lightgallery-all.min.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script src="{{ asset('js/form-validation.js') }}"></script>

  <!-- Form -->
  <script src="{{ asset('js/file-upload.js') }}"></script>
  <script src="{{ asset('js/typeahead.js') }}"></script>

 <!-- Table -->
  <script src="{{ asset('js/buttons.html5.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('dattables/dataTables.buttons.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('dattables/jszip.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('dattables/pdfmake.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/buttons.flash.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('dattables/vfs_fonts.js') }}" type="text/javascript"></script>

 <!-- Tooltip -->
  <script src="{{ asset('js/tooltips.js') }}"></script>
  <script src="{{ asset('js/popover.js') }}"></script>
  <!-- endinject -->

  <!-- Global js for all page -->
  @include('layouts.js')
  <!-- End global js for all page-->

  <!-- Custom js for this page-->
  @yield('jscustom')
  <!-- End custom js for this page-->

  <!-- Custom js for this page-->
  @include('layouts.modal')
  <!-- End custom js for this page -->

</body>

</html>

