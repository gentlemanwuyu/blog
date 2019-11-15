@extends('frontend::layouts.default')
@section('content')
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
                <span><i class="layui-icon">&#xe705;</i>&nbsp;{{$article->category->name}}</span>
                <span><i class="layui-icon">&#xe60e;</i>&nbsp;{{$article->create_date}}</span>
                <span class="layui-hide-xs"><i class="layui-icon">&#xe62c;</i>&nbsp;1176℃</span>
                <span class="layui-hide-xs"><i class="layui-icon">&#xe63a;</i>&nbsp;{{$article->comment_total or 0}}条</span>
            </div>
        </div>
    @endforeach
@endsection