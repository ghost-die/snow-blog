<div class="wrapper">
    @include('admin.layouts.navbars.navs.auth')

    @include('admin.layouts.navbars.auth')

    <div class="content-wrapper" id="pjax-container" >

        @stack('style')


        <div id="app">
            @yield('content')
        </div>

        @stack('script')

    </div>

    @include('admin.layouts.footer')

</div>