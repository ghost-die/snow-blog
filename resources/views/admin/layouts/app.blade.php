<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<script>
    window.Config = {
        'token': "{{ csrf_token() }}",
        'auth': "{{ auth()->check() }}",
        'routes': {
            'upload_md_image': "{{ route('upload_md_image') }}",
        }
    };
</script>
<style>

</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-light" style="padding-right: 0">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="ri-layout-line"></i></a>
            </li>
        </ul>

        <ul class="nav navbar-nav  ml-auto" >
            <li class="dropdown user user-menu nav-item" style="padding-right: 1rem;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ auth()->user()->avatar }}" style="margin-top: 0" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{ auth()->user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="user-header">
                        <img src="{{ auth()->user()->avatar }}"  class="img-circle" alt="User Image">
                        <p>
                            {{ auth()->user()->name }}
                            <small>Member since admin {{ auth()->user()->created_at }}</small>
                        </p>
                    </li>
                    <li class="border-top clearfix " style="padding: .5rem 1rem;" >

                        <div class="float-left">
                            <a href="{{ admin_url('auth/setting') }}" class="btn btn-sm border btn-default btn-flat">编辑</a>
                        </div>
                        <div class="float-right">

                            <a class="btn btn-sm btn-default border rounded-0" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                退出
                            </a>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    @include('admin.layouts._left')

    <div class="content-wrapper" id="pjax-container">
        @yield('content')
    </div>
    <footer class="main-footer">
        <strong>{{ config('app.name', 'Laravel') }} &copy; {{ date('Y') }} </strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 0.1
        </div>
    </footer>

</div>

</body>




<!-- Scripts -->
<script src="{{ asset('js/admin.js') }}"></script>



@yield('script')


<script>

    @if ($errors->any())
    @foreach ($errors->all() as $error)

    toastr.error("{{ $error }}");
    @endforeach
    @endif

    @if (session('success'))
    toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
    toastr.error("{{ session('error') }}");
    @endif

</script>
</html>
