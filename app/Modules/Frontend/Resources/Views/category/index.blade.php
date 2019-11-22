@extends('frontend::layouts.article_list')
@section('title'){{$category->name}}{{$blog_name ? ' | ' . $blog_name : ''}}@endsection