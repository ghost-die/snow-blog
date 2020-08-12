
<ul class="pagination pagination-sm m-0 float-right">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
    @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
    @endif

<!-- Pagination Elements -->
    @foreach ($elements as $element)
    <!-- "Three Dots" Separator -->
        @if (is_string($element))
            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @endif

    <!-- Array Of Links -->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

<!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
    @else
        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
    @endif
</ul>





{{--<label class="control-label pull-right" style="margin-right: 10px; font-weight: 100;">--}}

{{--    <small>{{ __('show') }}</small>&nbsp;--}}
{{--    <select class="input-sm per-page" name="per-page">--}}
{{--        $options--}}
{{--    </select>--}}
{{--    &nbsp;<small>{$trans['entries']}</small>--}}
{{--</label>--}}



{{--@if ($paginator->hasPages())--}}
{{--    <nav>--}}
{{--        <ul class="pagination">--}}
{{--            --}}{{-- Previous Page Link --}}
{{--            @if ($paginator->onFirstPage())--}}
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
{{--                    <span class="page-link" aria-hidden="true">&lsaquo;</span>--}}
{{--                </li>--}}
{{--            @else--}}
{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>--}}
{{--                </li>--}}
{{--            @endif--}}

{{--            --}}{{-- Pagination Elements --}}
{{--            @foreach ($elements as $element)--}}
{{--                --}}{{-- "Three Dots" Separator --}}
{{--                @if (is_string($element))--}}
{{--                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>--}}
{{--                @endif--}}

{{--                --}}{{-- Array Of Links --}}
{{--                @if (is_array($element))--}}
{{--                    @foreach ($element as $page => $url)--}}
{{--                        @if ($page == $paginator->currentPage())--}}
{{--                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>--}}
{{--                        @else--}}
{{--                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            @endforeach--}}

{{--            --}}{{-- Next Page Link --}}
{{--            @if ($paginator->hasMorePages())--}}
{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>--}}
{{--                </li>--}}
{{--            @else--}}
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                    <span class="page-link" aria-hidden="true">&rsaquo;</span>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--        </ul>--}}
{{--    </nav>--}}
{{--    <style>--}}
{{--        .page-item.active .page-link--}}
{{--        {--}}
{{--            background-color: #8027a1;--}}
{{--            border-color: #8027a1;--}}
{{--        }--}}
{{--        .page-link{--}}
{{--            color: #6c757d;--}}
{{--        }--}}

{{--        .page-link:hover{--}}
{{--            color: rgba(255, 255, 255, 0.5);--}}
{{--            background-color: rgba(105, 113, 135, 0.5);--}}
{{--            border-color: rgba(105, 113, 135, 0.5);--}}
{{--        }--}}
{{--        /*.page-item:first-child .page-link {*/--}}
{{--        /*    border-radius:0 !important;*/--}}
{{--        /*}*/--}}
{{--        /*.page-item:last-child .page-link{*/--}}
{{--        /*    border-radius:0 !important;*/--}}
{{--        /*}*/--}}
{{--        :focus {--}}
{{--            box-shadow:none !important;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endif--}}
