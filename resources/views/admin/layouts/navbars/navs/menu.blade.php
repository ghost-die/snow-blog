
@if(!isset($item['children']))
    <li class="nav-item">

        @if(url()->isValidUrl($item['uri']))
            <a class="nav-link" href="{{ $item['uri'] }}" target="_blank">
        @else
            <a class="nav-link {{ admin_url($item['uri']) == request()->url() ? ' active' : '' }} "  href="{{ admin_url($item['uri']) }}">
        @endif


            <i class="nav-icon {{$item['icon']}}"></i>
            <p>{{ __($item['title']) }}</p>
        </a>
    </li>
@else
    <li class="nav-item {{ in_array(request()->url(),Admin::toUrl(array_column($item['children'],'uri'))) ? 'menu-open': '' }}" >
        <a href="#" class="nav-link">
            <i class="nav-icon {{ $item['icon'] }}"></i>
            <p>
                {{ __($item['title'])  }}
                <i class="right fas fa-angle-left"></i>
            </p>

        </a>
        <ul class="nav nav-treeview ">
            @foreach($item['children'] as $item)
                @include('admin.layouts.navbars.navs.menu', $item)
            @endforeach
        </ul>
    </li>
@endif