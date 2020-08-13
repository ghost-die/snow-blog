
<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-dark-gray">
    <!-- Brand Logo -->
    <a href="/" class="brand-link navbar-gray">
        <img src="{{ config('ghost.min-logo') }}" alt="AdminLTE Logo" class="brand-image  img-circle elevation-3"
             style="opacity: .8">

        <span class="brand-text font-weight-light">{{ config('ghost.logo') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
{{--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--            <div class="image">--}}
{{--                <img src="{{ make_gravatar(auth()->user()->email) }}" class="img-circle elevation-2" alt="User Image">--}}
{{--            </div>--}}
{{--            <div class="info">--}}
{{--                <a href="#" class="d-block">{{ auth()->user()->name }}</a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="sidebar-menu nav nav-pills nav-sidebar flex-column  nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                {{ dd(Admin::menu()) }}
                @each('admin.layouts.navbars.navs.menu', Admin::menu(), 'item')

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

