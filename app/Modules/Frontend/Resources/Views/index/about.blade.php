@extends('frontend::layouts.default')
@section('title')关于{{$blog_name ? ' | ' . $blog_name : ''}}@endsection
@section('content')
    <div class="title-article text-center">
        <h1>关于</h1>
    </div>
    <div class="text" itemprop="articleBody" style="margin-bottom: 10px;">
        <div id="md_content_2" class="md_content markdown-body editormd-html-preview" style="min-height: 50px;">
            {!! $about !!}
        </div>
    </div>
    <div class="comment-text layui-form">
        <div id="comments" data-paginate_total="{{$paginate_total}}">

        </div>
        <div id="paginate">

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/assets/js/frontend/about.js')}}"></script>
@endsection