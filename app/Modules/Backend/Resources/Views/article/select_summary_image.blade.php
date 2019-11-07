@extends('backend::layouts.template')
@section('css')
    <style>
        body {
            background: #f2f2f2;
        }
        img {
            max-height: 200px;
            max-width: 200px;
        }
        .layui-card-header {
            text-align: center;
        }
        .layui-card-body {
            height: 200px;
            vertical-align: middle!important;
        }
    </style>
@endsection
@section('body')
    <form class="layui-form" lay-filter="summary_image">
        <input type="hidden" name="summary_image_url">
        <input type="hidden" name="summary_image_desc">
        <div class="row" id="images_container">

        </div>
        <div class="row" style="text-align: center;clear: both;">
            <div id="paginate"></div>

        </div>
    </form>
@endsection
@section('scripts')
    <script>
        layui.use('laypage', function(){
            var laypage = layui.laypage;
            var form = layui.form;
            laypage.render({
                elem: 'paginate'
                ,count: "{{$total or 0}}"
                ,limit: "{{$limit or 12}}"
                ,prev: '<i class="layui-icon layui-icon-left"></i>'
                ,next: '<i class="layui-icon layui-icon-right"></i>'
                ,jump: function(obj, first){
                    $.get("{{route('admin::article.summary_image_paginate')}}?limit=" + obj.limit + "&page=" + obj.curr, function (result) {
                        var html = '';
                        $.each(result.data, function (key, val) {
                            html += '<div class="layui-col-xs2" style="padding: 15px;">';
                            html += '<div class="layui-card">';
                            html += '<div class="layui-card-body">';
                            html += '<img src="' + val.url + '">';
                            html += '</div>';
                            html += '<div class="layui-card-header">';
                            html += '<input type="radio" name="summary_image_id" value="' + val.id + '" title="' + val.desc + '" lay-filter="summary_image" data-url="' + val.url + '">';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        });
                        $('#images_container').html(html);
                        form.render();
                        form.on("radio(summary_image)", function (data) {
                            $('input[name=summary_image_url]').val($(data.elem).attr('data-url'));
                            $('input[name=summary_image_desc]').val($(data.elem).attr('title'));
                        });
                    });
                }
            });
        });
    </script>
@endsection