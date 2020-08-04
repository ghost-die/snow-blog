<nav class="navbar navbar-expand-lg navbar-dark bg-dark header"  >

    <div class="container">
        <div class="title-container">
            <div class="site-title">
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                <p class="tagline text-center">一人，一剑，守一座孤城，等你归来</p>
            </div>

        </div>


        <div class="text-center">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>

        <div class="collapse navbar-collapse mt-1" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(!isset($category_id)) active @endif">
                    <a class="nav-link pt-0 pb-0" href="/">主页 <span class="sr-only">(current)</span></a>
                </li>
                @foreach($nav as $item)
                <li class="nav-item @if(isset($category_id) && $category_id===$item['id']) active @endif">
                    <a class="nav-link pt-0 pb-0" href="{{ route('category.index',['article_category'=>$item['id']]) }}">{{ $item['name'] }} <span class="sr-only">(current)</span></a>
                </li>
                @endforeach

                @foreach($toplink as $item)
                    <li class="nav-item">
                        <a class="nav-link pt-0 pb-0" target="_blank" href="{{ $item['uri'] }}">{{ $item['name'] }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

</nav>

<style>

</style>