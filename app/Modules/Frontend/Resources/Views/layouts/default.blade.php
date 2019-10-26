@extends('frontend::layouts.template')
@section('body')
    @include('frontend::layouts.header')
    <div class="layui-container">
        <div class="layui-row layui-col-space15 main">
            <div class="map">
            <span class="layui-breadcrumb" style="visibility: visible;">
                <a href="https://www.echo.so/">首页</a><span lay-separator="">/</span>
                <a href="https://www.echo.so/category/php/">PHP</a><span lay-separator="">/</span>
                <a><cite>正文</cite></a>
            </span>
            </div>
            <div class="layui-col-md9 layui-col-lg9">
                @yield('content')
            </div>
            @include('frontend::layouts.sidebar')
        </div>
    </div>
    @include('frontend::layouts.footer')
@endsection