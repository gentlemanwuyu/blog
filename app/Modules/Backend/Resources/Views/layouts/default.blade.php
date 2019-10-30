<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Woozee后台管理</title>
    <link rel="stylesheet" href="{{asset('/assets/layui-src/dist/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('/assets/jstree/dist/themes/default/style.min.css')}}" media="all">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <a href="{{route('admin::index')}}"><div class="layui-logo">Woozee后台管理</div></a>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <?php
                        $gravatar = \Creativeorange\Gravatar\Facades\Gravatar::exists(Auth::user()->email) ? \Creativeorange\Gravatar\Facades\Gravatar::get(\Auth::user()->email) : asset('/assets/img/system/avatar_default.jpg');
                    ?>
                    <img src="{{$gravatar}}" class="layui-nav-img">{{\Auth::user()->name}}
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="{{route('admin::logout')}}">退出</a></dd>
                </dl>
            </li>
        </ul>
    </div>
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item">
                    <a href="javascript:;">文章管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">文章列表</a></dd>
                        <dd><a href="javascript:;">发布文章</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="javascript:;">评论管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">评论列表</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="{{route('admin::category.list')}}">分类管理</a></li>
                <li class="layui-nav-item">
                    <a href="javascript:;">标签管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">标签列表</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">系统管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">系统设置</a></dd>
                        <dd><a href="javascript:;">友情链接</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <div class="layui-body">
        @yield('content')
    </div>
    <div class="layui-footer">
        Copyright &copy; 2018-2019 <a href="http://www.gentlemanwuyu.top">Woozee</a>
    </div>
</div>
<script src="{{asset('/assets/layui-src/dist/layui.all.js')}}"></script>
<script src="{{asset('/assets/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/assets/jstree/dist/jstree.min.js')}}"></script>
<script>
    var element = layui.use('element');
    var layer = layui.layer;
</script>
@yield('scripts')
</body>
</html>