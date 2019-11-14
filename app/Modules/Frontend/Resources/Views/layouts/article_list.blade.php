@extends('frontend::layouts.default')
@section('content')
    <div id="articles">
        @foreach($articles as $article)
            <div class="title-article list-card">
                <div class="list-pic">
                    <a href="{{route('frontend::article.detail', ['id' => $article->id])}}" title="{{$article->title}}">
                        <img src="{{$article->summary_image_url}}" alt="{{$article->summary_image_desc}}" class="img-full">
                    </a>
                </div>
                <a href="{{route('frontend::article.detail', ['id' => $article->id])}}">
                    <h1>{{$article->title}}</h1>
                    <p>{{$article->summary}}</p>
                </a>
                <div class="title-msg">
                    <span><i class="layui-icon">&#xe705;</i>{{$article->category->name}}</span>
                    <span><i class="layui-icon">&#xe60e;</i>{{$article->create_date}}</span>
                    <span class="layui-hide-xs"><i class="layui-icon">&#xe62c;</i>1176℃</span>
                    <span class="layui-hide-xs"><i class="layui-icon">&#xe63a;</i>{{$article->comment_total or 0}}条</span>
                </div>
            </div>
        @endforeach
    </div>
    <div id="paginate"></div>
@endsection
@section('scripts')
    <script>
        layui.use(['laypage', 'form'], function () {
            var laypage = layui.laypage
                    ,$ = layui.$;

            laypage.render({
                elem: 'paginate'
                ,count: "{{$paginate_total or 0}}"
                ,groups: 3
                ,prev: '<i class="layui-icon layui-icon-left"></i>'
                ,next: '<i class="layui-icon layui-icon-right"></i>'
                ,jump: function(obj, first){
                    if (!first) {
                        $.ajax({
                            method: "post",
                            url: "/article/paginate",
                            data: {section_id: "{{$section_id}}", limit: obj.limit, page: obj.curr},
                            success: function (res) {
                                var html = '';
                                res.data.forEach(function (article) {
                                    html += '<div class="title-article list-card">';
                                    html += '<div class="list-pic">';
                                    html += '<a href="' + article.href + '" title="' + article.title + '">';
                                    html += '<img src="' + article.summary_image_url + '" alt="' + article.summary_image_desc + '" class="img-full">';
                                    html += '</a>';
                                    html += '</div>';
                                    html += '<a href="' + article.href + '" title="' + article.title + '">';
                                    html += '<h1>' + article.title + '</h1>';
                                    html += '<p>' + article.summary + '</p>';
                                    html += '</a>';
                                    html += '<div class="title-msg">';
                                    html += '<span><i class="layui-icon">&#xe705;</i>' + article.category_name + '</span>';
                                    html += '<span><i class="layui-icon">&#xe60e;</i>' + article.create_date + '</span>';
                                    html += '<span class="layui-hide-xs"><i class="layui-icon">&#xe62c;</i>1176℃</span>';
                                    html += '<span class="layui-hide-xs"><i class="layui-icon">&#xe63a;</i>' + article.comment_total + '条</span>';
                                    html += '</div>';
                                    html += '</div>';
                                });
                                $('#articles').html(html);
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {

                                return false;
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection