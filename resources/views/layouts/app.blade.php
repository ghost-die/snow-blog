<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

            @yield('content')

        </main>

        <footer>
            @include('layouts.foot')

        </footer>

    </div>
</body>


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



    @yield('js')
    @yield('script')


    <script>


        @if ($errors->any())
            @foreach ($errors->all() as $error)

                toastr.error("{{ $error }}");
            @endforeach
        @endif

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif


    </script>

<script>


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

</html>
