<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin_assets/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
   
    <link href="{{asset('admin_assets/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/toastr/toastr.min.css')}}">
    @stack('style-lib')
    <!-- Main CSS-->
    <link href="{{asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">
    @stack('style')
</head>

<body>
    @yield('content')
    <!-- Jquery JS-->
    <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>

    <script src="{{asset('admin_assets/vendor/slick/slick.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/toastr/toastr.min.js')}}"></script>
    @stack('script-lib')
    
    <!-- Main JS-->
    <script src="{{asset('admin_assets/js/main.js')}}"></script>
    @stack('script')
</body>

</html>
<!-- end document-->