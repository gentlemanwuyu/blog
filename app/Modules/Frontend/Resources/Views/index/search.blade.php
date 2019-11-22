@extends('frontend::layouts.article_list')
@section('title')包含关键词{{$search}}的文章{{$blog_name ? ' | ' . $blog_name : ''}}@endsection