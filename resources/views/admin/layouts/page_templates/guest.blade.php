@include('admin.layouts.navbars.navs.guest')

<div class="wrapper wrapper-full-page ">
    <div class="full-page section-image" filter-color="black" data-image="{{ asset('assets') . '/' . ($backgroundImagePath ?? "img/bg/fabio-mangione.jpg") }}">
        @yield('content')
{{--        @include('admin.layouts.footer')--}}
    </div>
</div>
