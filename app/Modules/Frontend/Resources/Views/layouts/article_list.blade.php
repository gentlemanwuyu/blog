@extends('frontend::layouts.default')
@section('content')
    <div class="post">
        <input type="hidden" id="data" @if(!empty($section_id)) data-section_id="{{$section_id}}" @endif @if(!empty($category_id)) data-category_id="{{$category_id}}" @endif data-paginate_total="{{$articles->total()}}">
        @foreach($articles as $article)
            <div class="title-article list-card">
                <div class="list-pic">
                    <a href="{{$article->href}}" title="{{$article->title}}">
                        <img src="{{$article->summary_image_url}}" alt="{{$article->summary_image_desc}}" class="img-full">
                    </a>
                </div>
                <a href="{{$article->href}}">
                    <h1>{{$article->title}}</h1>
                    <p>{{$article->summary}}</p>
                </a>
                <div class="title-msg">
                    <span><i class="layui-icon">&#xe705;</i>&nbsp;{{$article->category_name}}</span>
                    <span><i class="layui-icon">&#xe60e;</i>&nbsp;{{$article->create_date}}</span>
                    <span class="layui-hide-xs"><i class="layui-icon">&#xe62c;</i>&nbsp;1176℃</span>
                    <span class="layui-hide-xs"><i class="layui-icon">&#xe63a;</i>&nbsp;{{$article->comment_total}}条</span>
                </div>
            </div>
        @endforeach
    </div>
    <div id="paginate"></div>
@endsection
@section('scripts')
    <script src="{{asset('/assets/js/frontend/article_list.js')}}"></script>
@endsection