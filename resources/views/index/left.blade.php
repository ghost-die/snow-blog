<div class="col-sm-8">


    @foreach($data as $v)
    <div class="card mb-3 rounded-0" style="overflow:hidden;" >
        <div class="row no-gutters font-weight-light">
            <div class="col-md-5 overflow_hidden text-center" >
                <a href="{{ route('article.index',['article'=>$v['id']]) }}">
                    @empty(imageOriginalToCover(getMdFirstImageUrl($v['content'])))
                        <svg class="bd-placeholder-img" width="100%" height="192" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" >
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                            <text x="30%" y="50%" fill="#dee2e6" dy=".3em">DEFAULT IMAGE</text>
                        </svg>
                    @else
                        <img class="bd-placeholder-img w-100" src="{{ imageOriginalToCover(getMdFirstImageUrl($v['content'])) }}">
                    @endempty
                </a>
            </div>
            <div class="col-md-7">
                <div class="card-body" style="max-height: 192px">
                    <h5 class="card-title text-center mb-0 font-weight-normal">{{ \Illuminate\Support\Str::of(stripTags( $v['title']  ))->limit(45) }} </h5>
                    <div class="card-text text pt-3 md-index-content">{{ \Illuminate\Support\Str::of(stripTags( $v['content'] ))->limit(250) }}</div>
                    <p class="card-text clearfix">
                        <small class="text-muted">{{ $v['created_at'] }}</small>
                        <a class="text-right text-decoration-none float-right stretched-link" href="{{ route('article.index',['article'=>$v['id']]) }}">详情 >></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @endforeach


    {{ $data->links() }}


</div>

<style>

    .text:first-letter{
        margin-left: 2em;
    }

    .bd-placeholder-img {
        cursor: pointer;
        transition: all 0.9s;
    }
    .bd-placeholder-img:hover{
        transform: scale(1.18);
    }

</style>