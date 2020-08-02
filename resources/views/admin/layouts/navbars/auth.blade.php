
<div class="sidebar" data-color="purple" data-background-color="black" data-image="{{ asset('assets') }}/img/sidebar-2.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">

        <a href="" class="simple-text logo-mini">
            {{ config('ghost.min-logo') }}
        </a>

        <a href="" class="simple-text logo-normal">
            {{ config('ghost.logo') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            <li class="nav-item {{ $activePage == 'user' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="material-icons">person</i>
                    <p>{{ __('User Profile') }}</p>
                </a>
            </li>
            <li class="nav-item {{ $activePage == 'category' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.category.index') }}">
                    <i class="material-icons">category</i>
                    <p>{{ __('Category') }}</p>
                </a>
            </li>
            <li class="nav-item  {{ $activePage == 'article' ? ' actived' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#ArticleManagement">
                    <i class="material-icons">article</i>
                    <p>{{ __('Article Management') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $activePage == 'article' ? ' show' : '' }}" id="ArticleManagement">
                    <ul class="nav">
                        <li class="nav-item {{ $active == 'article_index' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.article.index') }}">
                                <i class="material-icons">list</i>
                                <p class="sidebar-normal">{{ __('Article List') }}</p>
                            </a>
                        </li>
                        <li class="nav-item {{ $active == 'article_comment' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.comment.index') }}">
                                <i class="material-icons">comment</i>
                                <p class="sidebar-normal">{{ __('Article Comment') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
{{--            <li class="nav-item ">--}}
{{--                <a class="nav-link" href="./icons.html">--}}
{{--                    <i class="material-icons">bubble_chart</i>--}}
{{--                    <p>Icons</p>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item ">--}}
{{--                <a class="nav-link" href="./map.html">--}}
{{--                    <i class="material-icons">location_ons</i>--}}
{{--                    <p>Maps</p>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item ">--}}
{{--                <a class="nav-link" href="./notifications.html">--}}
{{--                    <i class="material-icons">notifications</i>--}}
{{--                    <p>Notifications</p>--}}
{{--                </a>--}}
{{--            </li>--}}
            <!-- <li class="nav-item active-pro ">
                  <a class="nav-link" href="./upgrade.html">
                      <i class="material-icons">unarchive</i>
                      <p>Upgrade to PRO</p>
                  </a>
              </li> -->
        </ul>
    </div>
</div>