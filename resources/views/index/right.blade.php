<div class="col-sm-4" >

    <div class="card rounded-0" >

        <div class="card-body">


            <form action="{{ route('search.index') }}">
                <div class="input-group">
                    <input type="text"  placeholder="Search" name="search" class="form-control border-right-0 border-dark rounded-0" id="validationTooltipSearch" aria-describedby="validationTooltipSearchPrepend">
                    <div class="input-group-prepend">
                        <button type="submit" class="input-group-text border-dark rounded-0" id="validationTooltipSearchPrepend"><i class="ri-search-line"></i></button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="card mt-3  rounded-0" style="">
        <div class="card-header">
            推荐
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
            @foreach($top as $item)
                <li class="list-group-item overflow_hidden" style="text-overflow:ellipsis;white-space: nowrap;"><a class="link-gray-dark" href="{{ route('article.index',['article'=>$item['id']]) }}">{{ $item['title'] }}</a> </li>
            @endforeach
            </ul>
        </div>
    </div>

    <div class="card mt-3 rounded-0" style="">
        <div class="card-header">
            标签
        </div>
        <div class="card-body">
            <div class="p-3">
            @foreach($labels as $label)
                <a href="{{ route('tags.index',['label'=>$label['id']]) }}" class="badge rounded-0 border border-gray-dark p-2">{{ $label['name'] }} <span class="text-danger">{{ $label['num'] }}</span></a>
            @endforeach
            </div>
        </div>
    </div>


    <div class="card mt-3  rounded-0"  >
        <div class="card-header">
            友情连接
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach($rightlink as $link)
                <li class="list-group-item"><a href="{{ $link['uri'] }}">{{ $link['name'] }}</a> </li>
                @endforeach
            </ul>
        </div>

    </div>


    <div class="card mt-3  rounded-0"  >
        <div class="card-body" >
            <script type="text/javascript" id="clustrmaps" src="//cdn.clustrmaps.com/map_v2.js?d=1GdU19QCiEmlTiMD8IRvmoUlgVTViQnqXNDs0m7KDwk&cl=ffffff&w=a"></script>
        </div>
    </div>

</div>

<style>


</style>