<div class="layui-header header">
    <div class="layui-main">
        <a class="logo" href="/">{{$blog_name or ''}}</a>
        <ul class="layui-nav">
            @foreach($navs as $nav)
                <li class="layui-nav-item layui-hide-xs @if(!empty($nav['active'])) layui-this @endif">
                    <a href="{{$nav['url']}}">{{$nav['title']}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>