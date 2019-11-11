@extends('frontend::layouts.default')
@section('content')
    <div class="title-article">
        <h1>{{$article->title}}</h1>
        <div class="title-msg">
            <span><i class="layui-icon">&#xe612;</i>吴宇</span>
            <span><i class="layui-icon">&#xe60e;</i>{{$article->create_date}}</span>
            <span><i class="layui-icon">&#xe62c;</i>6580℃</span>
            <span><i class="layui-icon">&#xe63a;</i>143条</span>
        </div>
    </div>
    <div class="text" itemprop="articleBody">
        <div id="md_content_2" class="md_content markdown-body editormd-html-preview" style="min-height: 50px;">
            <blockquote>
                <p>{{$article->summary}}</p>
            </blockquote>
            {!! $article->content !!}
        </div>
    </div>
    <div class="tags-text">
        <i class="layui-icon">&#xe66e;</i>标签: php
    </div>
    <div class="copy-text">
        <div>
            <p>非特殊说明，本博所有文章均为博主原创。</p>
            <p class="hidden-xs">如若转载，请注明出处：<a href="#">typecho</a> </p>
        </div>
    </div>
    <div class="page-text">
        @if($article->previous)
            <div>
                <span class="layui-badge layui-bg-gray">上一篇</span>
                <a href="{{route('frontend::article.detail', ['id' => $article->previous->id])}}">{{$article->previous->title}}</a>
            </div>
        @endif
        @if($article->next)
            <div>
                <span class="layui-badge layui-bg-gray">下一篇</span>
                <a href="{{route('frontend::article.detail', ['id' => $article->next->id])}}">{{$article->next->title}}</a>
            </div>
        @endif
    </div>
    <div class="comment-text layui-form">
        <div id="comments">
            <div id="respond-post-41" class="respond">
                <h4 id="response"><i class="layui-icon"></i> 评论啦~</h4>
                <br>
                <form method="post" action="https://www.echo.so/life/41.html/comment" id="comment-form" role="form">
                    <div class="layui-form-item">
                        <textarea rows="5" cols="30" name="text" id="textarea" placeholder="嘿~ 大神，别默默的看了，快来点评一下吧" class="layui-textarea"></textarea>
                    </div>
                    <div class="layui-form-item layui-row layui-col-space5">
                        <div class="layui-col-md4">
                            <input type="text" name="author" id="author" class="layui-input" placeholder="* 怎么称呼" value="" required="">
                        </div>
                        <div class="layui-col-md4">
                            <input type="email" name="mail" id="mail" lay-verify="email" class="layui-input" placeholder="* 邮箱(放心~会保密~.~)" value="123@test.com" required="">
                        </div>
                        <div class="layui-col-md4">
                            <input type="url" name="url" id="url" lay-verify="url" class="layui-input" placeholder="http://您的主页" value="">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button type="submit" class="layui-btn">提交评论</button>
                    </div>
                    <input type="hidden" name="_" value="68bdcf980fbe5ba6f990ba6881442a8d">
                </form>
            </div>
            <br>
            <h3>已有 {{$article->comment_total or 0}} 条评论</h3>
            <br>
            <div class="pinglun">

            </div>
            <div class="page-navigator" id="paginate">

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        layui.use(['laypage'], function () {
            var laypage = layui.laypage;
            var $ = layui.$;
            //总页数大于页码总数
            laypage.render({
                elem: 'paginate'
                ,count: "{{$article->paginate_total}}"
                ,groups: 3
                ,prev: '<i class="layui-icon layui-icon-left"></i>'
                ,next: '<i class="layui-icon layui-icon-right"></i>'
                ,jump: function(obj, first){
                    $.ajax({
                        method: "post",
                        url: "{{route('frontend::comment.paginate')}}",
                        data: {resource: 1, article_id: "{{$article->id}}", limit: obj.limit, page: obj.curr},
                        success: function (res) {
                            $('div.pinglun').html(makeCommentHtml(res.data));
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {

                            return false;
                        }
                    });
                }
            });
        });
    </script>
@endsection