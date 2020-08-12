<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('ghost.title') }} - {!! $header ?? 'title' !!}
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ Admin::css() }}

    @stack('css')


    <script rel="stylesheet" src="{{ asset(Admin::jQuery()) }}"></script>

</head>

<body class="{{ config('ghost.class') }}">
    @auth()
        @include('admin.layouts.page_templates.auth')
    @endauth

    @guest
        @include('admin.layouts.page_templates.guest')
    @endguest


    {{ \App\Http\Lib\Admin::js() }}
    @stack('js')

    @include('admin.layouts.notifications.index')


    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

</body>

</html>
