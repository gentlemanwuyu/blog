<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>Woozee后台管理</title>
    <link rel="stylesheet" href="{{asset('/assets/jstree/dist/themes/default/style.min.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('/assets/fancybox/dist/jquery.fancybox.min.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('/assets/layui-src/dist/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('/assets/css/backend.css')}}" media="all">
    @yield('css')
</head>
<body>
@yield('body')
<script src="{{asset('/assets/layui-src/dist/layui.all.js')}}"></script>
<script src="{{asset('/assets/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/assets/jstree/dist/jstree.min.js')}}"></script>
<script src="{{asset('/assets/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('/assets/fancybox/dist/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('/assets/js/backend.js')}}"></script>
<script>
    var element = layui.use('element');
    var layer = layui.layer;
</script>
@yield('scripts')
</body>
</html>