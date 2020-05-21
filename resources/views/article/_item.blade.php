@foreach($comments as $v)
    @if(count($v['childlist']) > 0)
        <div class="mt-2">
            @include('article._comment',['item'=>$v])
        </div>
        <div class="mt-2 ml-3 border-left border-gray-dark">
            @include('article._item',['comments'=>$v['childlist']])
        </div>
    @else
        <div class="mt-2">
            @include('article._comment',['item'=>$v])
        </div>
    @endif
@endforeach