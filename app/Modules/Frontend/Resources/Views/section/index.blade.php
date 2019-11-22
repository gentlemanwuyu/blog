@extends('frontend::layouts.article_list')
@section('title'){{$section->name}}{{$blog_name ? ' | ' . $blog_name : ''}}@endsection