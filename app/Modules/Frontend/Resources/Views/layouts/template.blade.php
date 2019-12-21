<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')">
    <meta content="referrer" name="unsafe-url">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <link href="{{asset('/favicon.ico')}}" rel="shortcut icon" type="image/ico"/>
    <link rel="stylesheet" href="{{asset('/assets/layui-src/dist/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('/assets/prism/prism.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('/assets/css/frontend.css')}}" media="all">
    @yield('css')
</head>
<body>
<!--[if lt IE 8]>
<div class="browsehappy" role="dialog">
    当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请升级你的浏览器
</div>
<![endif]-->
@yield('body')
<script src="{{asset('/assets/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/assets/layui-src/dist/layui.all.js')}}"></script>
<script src="{{asset('/assets/prism/prism.js')}}"></script>
<script src="{{asset('/assets/js/frontend.js')}}"></script>
@yield('scripts')
</body>
</html>