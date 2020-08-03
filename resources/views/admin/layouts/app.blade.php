<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        {{ config('ghost.title') }} - {{ $titlePage }}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link href="{{ asset('assets') }}/css/font-awesome.min.css" rel="stylesheet" />
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">--}}


    <link href="{{ asset('assets') }}/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />



    <!-- CSS Files -->
    <!-- CSS Plugin -->


    @stack('css')

</head>

<body class="{{ $class }}">

    @auth()
        @include('admin.layouts.page_templates.auth')
        @include('admin.layouts.navbars.fixed-plugin')
    @endauth

    @guest
        @include('admin.layouts.page_templates.guest')
    @endguest


    <!-- Scripts -->

    <script>
        window.Config = {
            'token': "{{ csrf_token() }}",
            'auth': "{{ auth()->check() }}",
        };
    </script>


    <!--   Core JS Files   -->
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>


{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>--}}



    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/bootstrap-material-design.min.js"></script>
{{--    <script src="https://unpkg.com/default-passive-events"></script>--}}

    <script src="{{ asset('assets') }}/js/plugins/index.umd.js"></script>


    <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
{{--    <script async defer src="https://buttons.github.io/buttons.js"></script>--}}

    <script src="{{ asset('assets') }}/js/plugins/buttons.js"></script>
    <!-- Plugin    -->

    <script src="{{ asset('assets') }}/plugins/jquery-pjax-2.0.1/jquery.pjax.js"></script>
    <!-- Chartist JS -->
    <script src="{{ asset('assets') }}/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets') }}/js/material-dashboard.js?v=2.1.0"></script>

    @stack('scripts')

    @include('admin.layouts.navbars.fixed-plugin-js')

    @include('admin.layouts.notifications.index')

</body>

</html>
