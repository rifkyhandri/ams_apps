<!DOCTYPE html>

<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Asset QR Code</title>
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

<body>

    
    
    
<div class="visible-print text-center">
        
    
    <div class="col-12 m-4">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-3">
                <h4>All Asset - QR Code</h4>
            </div>
            <div class="col-1">
                <button style="margin: -0.2rem .05rem -1rem auto;" type="button" onclick="print()" class="btn btn-primary btn-sm">
                    <i class="ti-printer menu-icon"></i>&ensp;
                </button> 
            </div>
            <div class="col-6"></div>
        </div>
    </div>
    @foreach ($asset as $ass)
        <div class="col-12 d-flex justify-content-center">
            <div class="row ">
                <div class="form-group m-2" >
                    {!! QrCode::size(100)->generate($ass->tangnumber); !!}
                </div>
                <div class="form-group m-2">
                    <p><br>{{$ass->assetname}}</p>
                    <p><br>{{$ass->tangnumber}}</p>
                </div>
            </div>
        </div>
        
    @endforeach
   

     

    <p></p>

</div>

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
</body>

</html>