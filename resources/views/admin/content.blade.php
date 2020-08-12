@extends('admin.layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    {!! $header ?: trans('admin.title') !!}
                    <span class="text-sm font-weight-light">{!! $description ?? 'description' !!}</span>
                </h1>

            </div><!-- /.col -->
            <div class="col-sm-6">

                <!-- breadcrumb start -->
                @if ($breadcrumb)
                    <ol class="breadcrumb float-sm-right" >
                        <li class="breadcrumb-item"><a href="{{ admin_url('/') }}"> {{__('Home')}}</a></li>
                        @foreach($breadcrumb as $item)
                            @if($loop->last)
                                <li class="breadcrumb-item active">
                                    {{ $item['text'] }}
                                </li>
                            @else
                                <li class="breadcrumb-item">
                                    @if (\Illuminate\Support\Arr::has($item, 'url'))
                                        <a href="{{ admin_url(\Illuminate\Support\Arr::get($item, 'url')) }}">
                                            {{ __($item['text']) }}
                                        </a>
                                    @else
                                        {{ __($item['text']) }}
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ol>
                @else

                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('/') }}">{{__('Home')}}</a></li>
                        @for($i = 2; $i <= count(Request::segments()); $i++)
                            <li class="breadcrumb-item ">
                                {{ __(ucfirst(Request::segment($i))) }}
                            </li>
                        @endfor
                    </ol>
                @endif

            <!-- breadcrumb end -->

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        @if($view)
            @include($view['view'], $view['data'])
        @else
            {!! $content !!}
        @endif

    </div>
</section>

@endsection