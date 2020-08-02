<div class="wrapper">

    @include('admin.layouts.navbars.auth')

    <div class="main-panel">
        @include('admin.layouts.navbars.navs.auth')
        @yield('content')
        @include('admin.layouts.footer')
    </div>
</div>