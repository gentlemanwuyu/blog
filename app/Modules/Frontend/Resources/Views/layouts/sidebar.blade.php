<div class="sidebar layui-col-md3 layui-col-lg3">
    <div class="component search">
        <form class="layui-form" action="{{route('frontend::index.search')}}" role="search">
            <div class="layui-inline input">
                <input type="text" name="search" class="layui-input" value="{{$search or ''}}" placeholder="输入关键字搜索" />
            </div>
            <div class="layui-inline">
                <button class="layui-btn layui-btn-sm layui-btn-primary"><i class="layui-icon">&#xe615;</i></button>
            </div>
        </form>
    </div>
    @if(!empty($category_tree))
    <div class="component category">
        <h3 class="title-sidebar"><i class="layui-icon">&#xe705;</i>版块分类</h3>
        <ul class="layui-nav layui-nav-tree layui-inline">
            @foreach($category_tree as $category)
                <?php
                    $href = empty($category['children']) ? route('frontend::category.index', ['id' => $category['id']]) : 'javascript:;';
                    $itemed = false;
                    if (!empty($category['children']) && isset($category_id) && in_array($category_id, array_column($category['children'], 'id'))) {
                        $itemed = true;
                    }
                ?>
            <li class="layui-nav-item @if($itemed) layui-nav-itemed @endif @if(empty($category['children']) && isset($category_id) && $category['id'] == $category_id) layui-this @endif">
                <a href="{{$href}}"><i class="layui-icon layui-icon-release"></i>&nbsp;{{$category['name']}}</a>
                @if(!empty($category['children']))
                    <dl class="layui-nav-child">
                        @foreach($category['children'] as $child)
                        <dd @if(isset($category_id) && $child['id'] == $category_id) class="layui-this" @endif><a href="{{route('frontend::category.index', ['id' => $child['id']])}}"><i class="layui-icon layui-icon-release"></i>&nbsp;{{$child['name']}}</a></dd>
                        @endforeach
                    </dl>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="component hots">
        <h3 class="title-sidebar"><i class="layui-icon">&#xe63c;</i>热门文章</h3>
        <ul class="layui-row layui-col-space5">
            @foreach($hot_articles as $index => $article)
                <li class="layui-col-md12 layui-col-xs6">
                    <a href="{{route('frontend::article.detail', ['id' => $article->id])}}">
                        <span class="layui-col-xs10 hots-title">{{$article->title}}</span>
                        <span class="layui-badge layui-bg-blue"
                              @if(0 == $index)
                                style="background-color: #f54545!important;"
                              @elseif(1 == $index)
                                style="background-color: #ff8547!important;"
                              @elseif(2 == $index)
                                style="background-color: #ffac38!important;"
                              @endif
                        >
                            {{$article->views or 0}}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="component tags">
        <h3 class="title-sidebar"><i class="layui-icon">&#xe66e;</i>标签云</h3>
        <div>
            @foreach($labels as $label)
                <a class="layui-btn layui-btn-xs layui-btn-primary" href="{{route('frontend::label.index', ['id' => $label['id']])}}" style="color: rgb({{mt_rand(130, 220)}}, {{mt_rand(12, 90)}}, {{mt_rand(60, 180)}})">{{$label['name']}}</a>
            @endforeach
        </div>
    </div>
    <div class="component link">
        <h3 class="title-sidebar"><i class="layui-icon">&#xe64c;</i>友情链接</h3>
        <div>
            @foreach($friendlinks as $friendlink)
                <a class="layui-btn layui-btn-xs layui-btn-primary" href="{{$friendlink['link']}}" title='{{$friendlink['desc']}}' target="_blank">{{$friendlink['name']}}</a>
            @endforeach
        </div>
    </div>
</div>