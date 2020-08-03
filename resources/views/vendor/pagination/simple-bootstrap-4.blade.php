

@if ($paginator->hasPages())

<div class="card rounded-0"  >
    <div class="card-body" >

            <nav>
                <ul class="pagination  justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled rounded-0" aria-disabled="true">
                            <span class="page-link">@lang('pagination.previous')</span>
                        </li>
                    @else
                        <li class="page-item rounded-0">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item rounded-0">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                        </li>
                    @else
                        <li class="page-item disabled rounded-0" aria-disabled="true">
                            <span class="page-link">@lang('pagination.next')</span>
                        </li>
                    @endif
                </ul>
            </nav>

    </div>
</div>
@endif


<style>
ul{
    margin-block-end: 0;
}
.page-link{
     border: none !important;
     color: black;
}
.page-link:hover {
    z-index: 2;
    color: #333333;
    /*text-decoration: none;*/
    background: none !important;
    border: none !important;
}
</style>