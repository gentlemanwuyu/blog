@extends('frontend::layouts.template')
@section('body')
    @include('frontend::layouts.header')
    <div class="layui-container" style="min-height: 800px;">
        <div class="error-404">
            <img src="{{asset('/assets/img/system/404.png')}}" alt="404">
            <div class="error-content">
                <h2>很抱歉，您访问的页面不存在！</h2>
            </div>
            <img src="{{asset('/assets/img/system/error-bg.png')}}" style="padding:60px 0 120px;">
        </div>
    </div>
    @include('frontend::layouts.footer')
@endsection