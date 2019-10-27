@extends('backend::layouts.default')
@section('content')
    <div class="layui-tab">
        <ul class="layui-tab-title">
            @foreach(config('sections') as $section_id => $section)
                <li @if(1 == $section_id)class="layui-this"@endif>{{$section['name']}}</li>
            @endforeach
        </ul>
        <div class="layui-tab-content">
            @foreach(config('sections') as $section_id => $section)
                <div class="layui-tab-item @if(1 == $section_id) layui-show @endif">{{$section['name']}}</div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        layui.use('element', function(){
            var element = layui.element;


        });
    </script>
@endsection