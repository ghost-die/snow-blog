<div class="col-sm-4" >

    <div class="card rounded-0 border-0" >

        <div class="card-body ">


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

    <div class="card mt-3  rounded-0 border-0" style="">
        <div class="card-header border-0">
            <h6 class="font-weight-normal">推荐</h6>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
            @foreach($top as $item)
                <li class="list-group-item overflow_hidden" style="text-overflow:ellipsis;white-space: nowrap;"><a class="link-gray-dark" href="{{ route('article.index',['article'=>$item['id']]) }}">{{ $item['title'] }}</a> </li>
            @endforeach
            </ul>
        </div>
    </div>

    <div class="card mt-3 rounded-0 border-0">
        <div class="card-header border-0">
            <h6 class="font-weight-normal">标签</h6>
        </div>
        <div class="card-body">
            <div class="p-3">
            @foreach($labels as $label)
                <a href="{{ route('tags.index',['label'=>$label['id']]) }}" class="badge rounded-0 border border-gray-dark p-2">{{ $label['name'] }} <span class="text-danger">{{ $label['num'] }}</span></a>
            @endforeach
            </div>
        </div>
    </div>


    <div class="card mt-3  rounded-0 border-0">
        <div class="card-header border-0">
            <h6 class="font-weight-normal">友链 <a class="btn btn-sm btn-link" data-toggle="modal" data-target="#addLinkModal"><i class="ri-add-line"></i></a></h6>

        </div>
        <div class="card-body">
            <ul class="list-group pl-4">
                @foreach($rightlink as $link)
                <li class=""><a class="text-decoration-none" href="{{ $link['uri'] }}">{{ $link['name'] }}</a> </li>
                @endforeach
            </ul>
        </div>

    </div>


    <div class="card mt-3  rounded-0"  >
        <div class="card-body" >
            <a href="https://clustrmaps.com/site/1b21z" title="Visit tracker"><img src="//clustrmaps.com/map_v2.png?cl=000000&w=300&t=n&d=1GdU19QCiEmlTiMD8IRvmoUlgVTViQnqXNDs0m7KDwk&co=ffffff&ct=ffffff" /></a>
        </div>
    </div>

</div>

<div class="modal fade" id="addLinkModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content rounded-0">
            <div class="modal-header border-left-0 border-right-0 border-top-0">
                <h5 class="modal-title font-weight-normal w-100 text-center" id="addLinkModal">互换友链</h5>
                <button type="button" class="close font-weight-normal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body border-0">
                <form action="{{ route('add.link') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">站点名称 <span class="text-danger">*</span>:</label>
                        <input type="text" name="name" class="form-control rounded-0 border-dark" required placeholder="" id="name">
                    </div>

                    <div class="form-group">
                        <label for="uri" class="col-form-label">站点地址 <span class="text-danger">*</span>:</label>
                        <input type="url" name="uri" class="form-control rounded-0 border-dark" required placeholder="" id="uri">
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label">邮箱地址 <span class="text-danger">*</span>:</label>
                        <input type="email" name="email" class="form-control rounded-0 border-dark" required placeholder="" id="email">
                    </div>

                    <div class="form-group">
                        <label for="introduction" class="col-form-label">简介:</label>
                        <textarea class="form-control rounded-0 border-dark" name="introduction" placeholder="" id="introduction"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-sm btn-outline-dark">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>