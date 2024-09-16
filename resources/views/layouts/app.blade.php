
<!DOCTYPE html>
<html lang="en"></html></html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cerria foundation </title>
    <link rel="icon" type="image/png" href="{{url('assets/images/favicon.png')}}" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="{{url('assets/css/remixicon.css')}}">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/bootstrap.min.css')}}">
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/apexcharts.css')}}">
    <!-- Data Table css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/dataTables.min.css')}}">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/editor-katex.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/lib/editor.atom-one-dark.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/lib/editor.quill.snow.css')}}">
    <!-- Date picker css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/flatpickr.min.css')}}">
    <!-- Calendar css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/full-calendar.css')}}">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/jquery-jvectormap-2.0.5.css')}}">
    <!-- Popup css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/magnific-popup.css')}}">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/slick.css')}}">
    <!-- prism css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/prism.css')}}">
    <!-- file upload css -->
    <link rel="stylesheet" href="{{url('assets/css/lib/file-upload.css')}}">

    <link rel="stylesheet" href="{{url('assets/css/lib/audioplayer.css')}}">
    <!-- main css -->
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">

    <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">
</head>
    <body>


        @include('layouts.header')

        @yield('content')
        

        @include('layouts.footer')


    <!-- jQuery library js -->
    <script src="{{url('assets/js/lib/jquery-3.7.1.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{url('assets/js/lib/bootstrap.bundle.min.js')}}"></script>
    <!-- Apex Chart js -->
    <script src="{{url('assets/js/lib/apexcharts.min.js')}}"></script>
    <!-- Data Table js -->
    <script src="{{url('assets/js/lib/dataTables.min.js')}}"></script>
    <!-- Iconify Font js -->
    <script src="{{url('assets/js/lib/iconify-icon.min.js')}}"></script>
    <!-- jQuery UI js -->
    <script src="{{url('assets/js/lib/jquery-ui.min.js')}}"></script>
    <!-- Vector Map js -->
    <script src="{{url('assets/js/lib/jquery-jvectormap-2.0.5.min.js')}}"></script>
    <script src="{{url('assets/js/lib/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- Popup js -->
    <script src="{{url('assets/js/lib/magnifc-popup.min.js')}}"></script>
    <!-- Slick Slider js -->
    <script src="{{url('assets/js/lib/slick.min.js')}}"></script>
    <!-- prism js -->
    <script src="{{url('assets/js/lib/prism.js')}}"></script>
    <!-- file upload js -->
    <script src="{{url('assets/js/lib/file-upload.js')}}"></script>
    <!-- audioplayer -->
    <script src="{{url('assets/js/lib/audioplayer.js')}}"></script>

    <!-- main js -->
    <script src="{{url('assets/js/app.js')}}"></script>
    <?php echo (isset($script) ? $script   : '')?>


     <!-- for js styling -->
  @yield('script')
</body>
</html>
