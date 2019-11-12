@extends('frontend::layouts.template')
@section('body')
    @include('frontend::layouts.header')
    <div class="layui-container" style="min-height: 800px;">
        <div class="layui-row layui-col-space15 main">
            <div class="layui-col-md9 layui-col-lg9">
                @yield('content')
            </div>
            @include('frontend::layouts.sidebar')
        </div>
    </div>
    @include('frontend::layouts.footer')
@endsection