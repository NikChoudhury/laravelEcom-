@extends('admin.layouts.master')
@section('content')
    <!-- page-wrapper start -->
    <div class="page-wrapper"> 
        @include('admin.partials.sidenav')
        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            @include('admin.partials.topnav')
                    @yield('panel')
            @include('admin.partials.footer')   
        </div>
        <!-- PAGE CONTAINER END-->
    </div>
    <!-- page-wrapper END -->   
@endsection
