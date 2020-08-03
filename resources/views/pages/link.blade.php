<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}博客,bogl,blog,{{ config('app.name', 'Laravel') }},孤城,雪,ghost">
    <meta name="description" content="{{ $description ?? '一人，一剑，守一座孤城，等你归来' }}" />
    <title>{{ config('app.name', 'Laravel') }} - {{$title ?? ""}}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<script>

</script>
<style>

</style>
<body style="background: #eaeaec">

<div class="snow-container">
    <div class="snow foreground"></div>
    <div class="snow foreground layered"></div>
    <div class="snow middleground"></div>
    <div class="snow middleground layered"></div>
    <div class="snow background"></div>
    <div class="snow background layered"></div>
</div>

<div id="app">

    @include('layouts.header')
    <main class="main-content g-mb-6">
        <div class="container">

            <div class="row justify-content-around">

                <div class="col-md-8">
                    <div class="card rounded-0">
                        <div class="card-header text-center border-0">
                            <h3 class="mt-2 font-weight-normal" style="">即将跳转到外部网站</h3>
                            <h5 class="text-black-50 font-weight-light">安全性未知，是否继续</h5>
                        </div>

                        <div class="card-body">
                            <div class="link-body">
                                <div class="text-white link-icon float-left"><i class="ri-links-line"></i></div>
                                <div class="link-url float-left"><a target="_blank" title="{{$link}}"  href="{{$link}}">{{$link}}</a></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </main>



</div>
</body>
<style>
    .link-body{
        padding: 1rem 5rem;
        height: 75px;
        border: 1px solid #dddddd;
        background: #fafafa;
    }
    .link-icon{
        -webkit-flex-shrink: 0;
        -ms-flex-negative: 0;
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        line-height: 40px;
        font-size: 20px;
        background: #bcc6d8;
        text-align: center;
        border-radius: 2px;
    }
    .link-url{
        font-size: 14px;
        color: #3194d0;
        margin-left: 10px;
        overflow: hidden;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
        white-space: nowrap;
        line-height: 40px;
    }
</style>

<script>
    window.Config = {
        'token': "{{ csrf_token() }}",
        'auth': "{{ \Illuminate\Support\Facades\Auth::check() }}",
        'routes': {
            'upload_md_image': "{{ route('upload_md_image') }}",
        }
    };
</script>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>


</html>
