

@extends('layouts.app')

@section('content')


    <div class="container">


        <div class="row justify-content-around">


            <div class="col-sm-8" id="content">
                <div class="card rounded-0" >
                    <div class="card-body">
                        <h2 class="card-title font-weight-light text-center border-bottom pb-4 pt-4  clearfix">
                            {{ $data->title }}
                            <p class="card-text font-weight-light" style="font-size: 12px"><small class="text-muted">{{ $data->created_at }}</small></p>
                        </h2>
                        <div class="card-text mt-5" id="md-content">
                            {!! $data->content !!}
                        </div>
                    </div>
                    <div class="card-footer bg-white text-danger">
                        本文为{{ config('app.name', 'Laravel') }}原创文章,转载无需和我联系,但请注明来自<a href="{{ config('app.url') }}">{{ config('app.name', 'Laravel') }}</a>
                    </div>
                </div>





                <div class="card mt-3 mb-3">
                    <div class="card-body pl-5">
                        {{ $data->comment->count() }}条评论
                    </div>
                </div>

                @include('article._item',['comments'=>$comments])

                <div class="card mt-3 Post-Comment">
                    <div class="card-body p-5 comment">

                        <p>发表评论</p>
                        <p>您的电子邮件地址不会被公布。必填字段被标记为*</p>

                        <form class="" action="{{ route('article.comment',['article'=>$data['id']]) }}" method="POST">

                            @csrf
                            <div class="form-group">
                                <label for="content">评论*</label>
                                <textarea style="min-height: 160px" class="form-control rounded-0  @error('content') is-invalid @else border-dark @enderror" id="content" name="content" required  autocomplete="off" >{{ old('content') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">昵称*</label>
                                <input type="text" class="form-control rounded-0  @error('name') is-invalid @else border-dark @enderror"
                                       id="name" name="name" placeholder="Ghost" required value="{{ old('name') ??   $comment_data['name'] }}" autocomplete="off" >
                            </div>

                            <div class="form-group">
                                <label for="email">邮箱*</label>
                                <input type="email" class="form-control rounded-0  @error('email') is-invalid @else border-dark @enderror" id="email" name="email"
                                       placeholder="name@email.com" required value="{{ old('email') ?? $comment_data['email']  }}" autocomplete="off" >
                            </div>

                            <div class="form-group">
                                <label for="web_site">主页</label>
                                <input type="text" class="form-control rounded-0  @error('web_site') is-invalid @else border-dark @enderror"
                                       id="web_site" name="web_site" placeholder="https://" value="{{ old('web_site') ?? $comment_data['web_site'] }}" autocomplete="off" >
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" value="1" name="is_remember" id="is_remember">
                                <label class="form-check-label" for="is_remember">在当前浏览器记住昵称和邮箱和主页，自动填充</label>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-dark rounded-0">提交评论</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            @include('index.right')
        </div>
    </div>


    <style>



    </style>

@endsection


@section('js')


    <script>

        let $content = $('#content')
        let $postComment = $content.find('.Post-Comment');
        let res=null
        let commentId;
        let url = $postComment.find('form').attr('action');
        $content.on('click','.Reply',function () {
            let $cardBody = $(this).parents('.card-body');
            commentId = $(this).data('id');
            $postComment.find('form').attr('action',url + '/' + commentId)
            $postComment.remove();
            if(res !==null){
                res.find('.comment').remove()
            }
            res = $cardBody.append($postComment.html())
        })


        $("#md-content").find('a').each(function () {
            let href = $(this).attr('href');
            console.log(href);
            if(href !==undefined)
            {
                if (href.indexOf("{{ config('app.url') }}") === -1) {
                    $(this).attr('href', "/go-wild?url="+ encodeURIComponent(href));
                }
            }

        });
    </script>


@endsection