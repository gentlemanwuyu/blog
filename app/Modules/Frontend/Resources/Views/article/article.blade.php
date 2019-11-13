@extends('frontend::layouts.default')
@section('content')
    <div class="title-article">
        <h1>{{$article->title}}</h1>
        <div class="title-msg">
            <span><i class="layui-icon">&#xe612;</i>吴宇</span>
            <span><i class="layui-icon">&#xe60e;</i>{{$article->create_date}}</span>
            <span><i class="layui-icon">&#xe62c;</i>6580℃</span>
            <span><i class="layui-icon">&#xe63a;</i>{{$article->comment_total or 0}}条</span>
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
        <i class="layui-icon">&#xe66e;</i>标签: {!! implode('', $article->labels->map(function ($label) {
            return '<a class="layui-btn layui-btn-xs layui-btn-primary" href="#">' . $label->name . '</a>';
        })->toArray()) !!}
    </div>
    <div class="copy-text">
        <div>
            <p>非特殊说明，本博所有文章均为博主原创。</p>
            <p class="hidden-xs">如若转载，请注明出处：{{url()->current()}} </p>
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
        <div id="comments" data-paginate_total="{{$article->paginate_total}}" data-article_id="{{$article->id}}">

        </div>
        <div class="page-navigator" id="paginate">

        </div>
    </div>
@endsection
@section('scripts')
<script src="{{asset('/assets/js/frontend/article.js')}}"></script>
@endsection