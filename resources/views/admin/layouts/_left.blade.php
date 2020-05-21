<aside class="main-sidebar sidebar-dark-gray">
    <a href="/" class="brand-link" style="display: inline-block;height: 56px;text-align: center;">

        <div style="opacity: .8">
            {{ config('app.name', 'Laravel') }}
        </div>

        {{--            <span class="brand-text font-weight-light">laravel</span>--}}

    </a>
    <div class="sidebar">

{{--        <div class="user-panel  ">--}}
{{--            <div class="float-left image">--}}
{{--                <img src="{{ auth()->user()->avatar }}" class="img-circle" alt="User Image">--}}
{{--            </div>--}}
{{--            <div class="float-left info">--}}
{{--                <p class="text-white">{{  auth()->user()->name  }}</p>--}}

{{--            </div>--}}
{{--        </div>--}}


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ admin_url('/') }}" class="nav-link">
                        <i class="nav-icon ri-dashboard-line"></i>
                        <p>
                            主页
                        </p>
                    </a>

                </li>


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">

                        <i class="nav-icon ri-user-2-line"></i>

                        <p>
                            用户管理
                            <i class="right ri-arrow-left-s-line"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ admin_url('user') }}" class="nav-link">

                                <i class="ri-user-5-line nav-icon"></i>
                                <p>用户列表</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">


                        <i class="ri-attachment-line nav-icon"></i>

                        <p>
                            文章分类
                            <i class="right ri-arrow-left-s-line"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ admin_url('category') }}" class="nav-link">

                                <i class="ri-list-ordered  nav-icon"></i>
                                <p>分类列表</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">


                        <i class="ri-attachment-line nav-icon"></i>

                        <p>
                            文章管理
                            <i class="right ri-arrow-left-s-line"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ admin_url('article') }}" class="nav-link">

                                <i class="ri-list-ordered  nav-icon"></i>
                                <p>文章列表</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ admin_url('comment') }}" class="nav-link">

                                <i class="ri-list-ordered  nav-icon"></i>
                                <p>评论列表</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

    </div>
</aside>

<style>
    .nav-sidebar .nav-link > .right, .nav-sidebar .nav-link > p > .right {
        vertical-align:middle;
    }
    .nav-sidebar > .nav-item .nav-icon {
        vertical-align:middle;
    }
</style>