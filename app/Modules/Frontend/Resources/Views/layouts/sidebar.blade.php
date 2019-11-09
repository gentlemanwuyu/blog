<div class="sidebar layui-col-md3 layui-col-lg3">
    <div class="component">
        <form class="layui-form" id="search" method="post" action="" role="search">
            <div class="layui-inline input">
                <input type="text" id="s" name="s" class="layui-input" required lay-verify="required" placeholder="输入关键字搜索" />
            </div>
            <div class="layui-inline">
                <button class="layui-btn layui-btn-sm layui-btn-primary"><i class="layui-icon">&#xe615;</i></button>
            </div>
        </form>
    </div>
    <div class="column">
        <h3 class="title-sidebar"><i class="layui-icon">&#xe705;</i>版块分类</h3>
        <ul class="layui-row layui-col-space5">
            <li class="layui-col-md12 layui-col-xs6"><a href="#"><i class="layui-icon">&#xe63c;</i>心情随笔<span class="layui-badge layui-bg-gray">2</span></a></li>
            <li class="layui-col-md12 layui-col-xs6"><a href="#"><i class="layui-icon">&#xe63c;</i>技术杂谈<span class="layui-badge layui-bg-gray">3</span></a></li>
            <li class="layui-col-md12 layui-col-xs6"><a href="#"><i class="layui-icon">&#xe63c;</i>PHP<span class="layui-badge layui-bg-gray">5</span></a></li>
            <li class="layui-col-md12 layui-col-xs6"><a href="#"><i class="layui-icon">&#xe63c;</i>Python<span class="layui-badge layui-bg-gray">4</span></a></li>
        </ul>
    </div>
    <div class="tags">
        <h3 class="title-sidebar"><i class="layui-icon">&#xe66e;</i>标签云</h3>
        <div>
            @foreach($labels as $label)
            <a class="layui-btn layui-btn-xs layui-btn-primary" href="#" title=''>{{$label['name']}}</a>
            @endforeach
        </div>
    </div>
    <div class="link">
        <h3 class="title-sidebar"><i class="layui-icon">&#xe64c;</i>友情链接</h3>
        <div>
            @foreach($friendlinks as $friendlink)
                <a class="layui-btn layui-btn-xs layui-btn-primary" href="{{$friendlink['link']}}" title='{{$friendlink['name']}}' target="_blank">{{$friendlink['name']}}</a>
            @endforeach
        </div>
    </div>
</div>