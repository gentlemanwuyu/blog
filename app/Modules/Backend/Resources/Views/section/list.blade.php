@extends('backend::layouts.default')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>版块管理</legend>
    </fieldset>
    <div class="layui-main">
        <button id="add_section" type="button" class="layui-btn layui-btn-sm layui-btn-normal">添加版块</button>
        <table id="section_list"  lay-filter="list"></table>
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
                elem: '#section_list',
                url: "{{route('admin::section.paginate')}}",
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
                    {field: 'name', title: '版块名', align: 'center'},
                    {field: 'created_at', title: '创建时间', align: 'center', sort: true},
                    {field: 'updated_at', title: '最后更新时间', align: 'center', sort: true},
                    {field: 'action', title: '操作', align: 'center', toolbar: "#action"}
                ]]
            });

            $('#add_section').on('click', function () {
                layer.prompt({
                    title: "添加版块"
                }, function(value, index, elem){
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('admin::section.create_or_update_section')}}",
                        data: {name: value},
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.close(index);
                                layer.msg("添加版块成功", {icon:1});
                                tableIns.reload();
                            } else {
                                layer.msg("添加版块失败:"+data.msg, {icon:2});
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
            });

            table.on('tool(list)', function(obj){
                var data = obj.data;

                if ('edit' == obj.event) {
                    layer.prompt({
                        value: data.name,
                        title: "修改版块"
                    }, function(value, index, elem){
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('admin::section.create_or_update_section')}}",
                            data: {name: value, section_id: data.id},
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("修改版块成功", {icon:1});
                                    tableIns.reload();
                                } else {
                                    layer.msg("修改版块失败:"+data.msg, {icon:2});
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
                }else if ('delete' == obj.event) {
                    layer.confirm("确认要删除该版块？", {icon: 3, title:"确认"}, function (index) {
                        layer.close(index);
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('admin::section.delete_section')}}",
                            data: {section_id: data.id},
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.msg("版块删除成功", {icon:1});
                                    tableIns.reload();
                                } else {
                                    layer.msg("版块删除失败:"+data.msg, {icon:2});
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