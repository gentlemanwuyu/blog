@extends('backend::layouts.template')
@section('body')
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <a href="{{route('admin::index')}}"><div class="layui-logo">博客后台管理</div></a>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="{{\Creativeorange\Gravatar\Facades\Gravatar::get(\Auth::user()->email)}}" class="layui-nav-img">{{\Auth::user()->name}}
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{route('admin::logout')}}">退出</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
                <ul class="layui-nav layui-nav-tree">
                    @foreach($navs as $nav)
                    <li class="layui-nav-item @if(!empty($nav->children) && !empty($nav->active)) layui-nav-itemed @elseif(empty($nav->children) && !empty($nav->active)) layui-this @endif">
                        <a href="@if(!empty($nav->children))javascript:;@else{{$nav->link}}@endif"><i class="{{$nav->icon}}"></i>&nbsp;&nbsp;{{$nav->title}}</a>
                        @if(!empty($nav->children))
                            <dl class="layui-nav-child">
                                @foreach($nav->children as $sub_nav)
                                    <dd @if(!empty($sub_nav->active)) class="layui-this" @endif><a href="{{$sub_nav->link}}"><i class="{{$sub_nav->icon}}"></i>&nbsp;&nbsp;{{$sub_nav->title}}</a></dd>
                                @endforeach
                            </dl>
                        @endif
                    </li>
                    @endforeach
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
@endsection