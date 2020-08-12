<div class="col-lg-8 col-xl-8">
    @foreach($data as $v)
    <div class="card mb-3 rounded-0 p-4" >
        <div class="card-body">
            <h3 class="card-title font-weight-normal clearfix">
                <a class="text-decoration-none text-dark" href="{{ route('article.index',['article'=>$v['id']]) }}"> {{ $v->title }} </a>
            </h3>
            <p class="card-text font-weight-light mt-1" style="font-size: 12px">
                <small class="text-muted">
                    <span>Published on </span>
                    <span>{{ $v->created_at }}</span>
                    <span> By. {{ $v->author }}</span>
                </small>
            </p>
            <div class="card-text p-1" id="md-content">
                {!! $v->content !!}
            </div>
            <div class="p-1">
                @foreach($v->label as $label)
                    <a href="{{ route('tags.index',['label'=>$label['id']]) }}" class="badge badge-dark font-weight-light">
                        {{ $label['name'] }}
                    </a>

                @endforeach
            </div>
        </div>
    </div>
    @endforeach
    {{ $data->links() }}
</div>