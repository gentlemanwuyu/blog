<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <link href="{{asset('/favicon.ico')}}" rel="shortcut icon" type="image/ico"/>
    <link rel="stylesheet" href="{{asset('/assets/layui-src/src/css/layui.css')}}" media="all">
    @yield('css')
</head>
<body>
@yield('body')

<script src="{{asset('/assets/layui-src/src/layui.js')}}"></script>
@yield('scripts')
</body>
</html>