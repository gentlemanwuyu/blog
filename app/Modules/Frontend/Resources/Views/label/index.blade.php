@extends('frontend::layouts.article_list')
@section('title')包含标签{{$label->name}}的文章{{$blog_name ? ' | ' . $blog_name : ''}}@endsection