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

        </div>
        <div class="page-navigator" id="paginate">

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        layui.use(['laypage', 'form'], function () {
            var laypage = layui.laypage
                    ,$ = layui.$
                    ,form = layui.form;

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
                        data: {source: 1, article_id: "{{$article->id}}", limit: obj.limit, page: obj.curr},
                        success: function (res) {
                            $('div#comments').html(makeCommentHtml(res));
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {

                            return false;
                        }
                    });
                }
            });

            form.on('submit(article)', function(data){
                data.field.source = 1;
                data.field.article_id = "{{$article->id}}";
                var load_index = layer.load();

                if (data.field.author) {
                    setCookie('author', data.field.author);
                }
                if (data.field.mail) {
                    setCookie('mail', data.field.mail);
                }
                if (data.field.url) {
                    setCookie('url', data.field.url);
                }

                $.ajax({
                    method: "post",
                    url: "{{route('frontend::comment.create_comment')}}",
                    data: data.field,
                    success: function (data) {
                        layer.close(load_index);
                        if ('success' == data.status) {
                            layer.msg("谢谢您的点评!", {icon:1});
                            window.location.reload();
                        } else {
                            layer.msg("对不起, 评论失败, 请联系博主!", {icon:2});
                            return false;
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        layer.close(load_index);
                        layer.msg("对不起, 评论失败, 请联系博主!", {icon:2});
                        return false;
                    }
                });

                return false;
            });
        });
    </script>
@endsection