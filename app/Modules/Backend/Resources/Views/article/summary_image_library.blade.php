@extends('backend::layouts.default')
@section('css')
    <style>
        td>div.layui-table-cell {
            height: 100px;
            line-height: 100px;
        }
    </style>
@endsection
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>摘要图片库</legend>
    </fieldset>
    <div class="layui-main">
        <button id="add_image" type="button" class="layui-btn layui-btn-sm layui-btn-normal">添加图片</button>
        <table id="summary_image_list"  lay-filter="list"></table>
    </div>
    <script type="text/html" id="action">
        <a class="layui-btn layui-btn-sm layui-btn-normal" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>修改</a>
        <a class="layui-btn layui-btn-sm layui-btn-danger" lay-event="delete"><i class="layui-icon layui-icon-delete"></i>删除</a>
    </script>
@endsection
@section('scripts')
    <script>
        layui.use('table', function(){
            var table = layui.table;
            var $ = layui.$;
            var tableIns = table.render({
                elem: '#summary_image_list',
                url: "{{route('admin::article.summary_image_paginate')}}",
                page: true,
                parseData: function (res) {
                    return {
                        "code": 0,
                        "msg": '',
                        "count": res.total,
                        "data": res.data
                    };
                },
                cols: [[
                    {field: 'id', title: 'ID', align: 'center', sort: true, fixed: 'left'},
                    {field: 'url', title: '图片', align: 'center', templet: function (d) {
                        return '<img src="' + d.url + '" alt="' + d.desc + '" onclick="previewImage(\'' + d.url + '\');">';
                    }},
                    {field: 'desc', title: '描述', align: 'center'},
                    {field: 'created_at', title: '创建时间', align: 'center', sort: true},
                    {field: 'updated_at', title: '最后更新时间', align: 'center', sort: true},
                    {field: 'action', title: '操作', align: 'center', toolbar: "#action"}
                ]],
                style: 'height: auto;'
            });

            $('#add_image').on('click', function () {
                layer.open({
                    type: 2,
                    area: ['50%', '60%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "添加图片",
                    btn: ['确定', '取消'],
                    yes: function (index) {
                        var form_data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('admin::article.create_or_update_summary_image')}}",
                            data: form_data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("添加摘要图片成功", {icon:1});
                                    tableIns.reload();
                                } else {
                                    layer.msg("添加摘要图片失败:"+data.msg, {icon:2});
                                    return false;
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                layer.close(load_index);
                                layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                                return false;
                            }
                        });
                    },
                    content: "{{route('admin::article.create_or_update_summary_image_page')}}"
                });
            });

            table.on('tool(list)', function(obj){
                var data = obj.data;

                if ('edit' == obj.event) {
                    layer.open({
                        type: 2,
                        area: ['50%', '60%'],
                        fix: false,
                        skin: 'layui-layer-rim',
                        maxmin: true,
                        shade: 0.5,
                        anim: 4,
                        title: "修改图片",
                        btn: ['确定', '取消'],
                        yes: function (index) {
                            var form_data = $(layer.getChildFrame('body',index)).find('form').serialize();
                            var load_index = layer.load();
                            $.ajax({
                                method: "post",
                                url: "{{route('admin::article.create_or_update_summary_image')}}",
                                data: form_data,
                                success: function (data) {
                                    layer.close(load_index);
                                    if ('success' == data.status) {
                                        layer.close(index);
                                        layer.msg("修改图片成功", {icon:1});
                                        tableIns.reload();
                                    } else {
                                        layer.msg("修改图片失败:"+data.msg, {icon:2});
                                        return false;
                                    }
                                },
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    layer.close(load_index);
                                    layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                                    return false;
                                }
                            });
                        },
                        content: "{{route('admin::article.create_or_update_summary_image_page')}}?summary_image_id=" + data.id
                    });

                }else if ('delete' == obj.event) {
                    layer.confirm("确认要删除该图片？", {icon: 3, title:"确认"}, function (index) {
                        layer.close(index);
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('admin::article.delete_summary_image')}}",
                            data: {summary_image_id: data.id},
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.msg("图片删除成功", {icon:1});
                                    tableIns.reload();
                                } else {
                                    layer.msg("图片删除失败:"+data.msg, {icon:2});
                                    return false;
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                layer.close(load_index);
                                layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                                return false;
                            }
                        });
                    });
                }
            });
        });
    </script>
@endsection