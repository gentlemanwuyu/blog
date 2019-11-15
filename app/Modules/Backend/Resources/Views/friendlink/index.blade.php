@extends('backend::layouts.default')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>友情链接</legend>
    </fieldset>
    <div class="layui-main">
        <button id="add_friendlink" type="button" class="layui-btn layui-btn-sm layui-btn-normal">添加友链</button>
        <table id="friendlink_list"  lay-filter="list"></table>
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
                elem: '#friendlink_list',
                url: "{{route('admin::friendlink.paginate')}}",
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
                    {field: 'name', title: '用户名', align: 'center'},
                    {field: 'link', title: '链接', align: 'center'},
                    {field: 'desc', title: '描述', align: 'center'},
                    {field: 'created_at', title: '创建时间', align: 'center', sort: true},
                    {field: 'updated_at', title: '最后更新时间', align: 'center', sort: true},
                    {field: 'action', title: '操作', align: 'center', toolbar: "#action"}
                ]]
            });

            $('#add_friendlink').on('click', function () {
                layer.open({
                    type: 2,
                    area: ['50%', '60%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "添加友链",
                    btn: ['确定', '取消'],
                    yes: function (index) {
                        var form_data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('admin::friendlink.create_or_update_friendlink')}}",
                            data: form_data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("添加友链成功", {icon:1});
                                    tableIns.reload();
                                } else {
                                    layer.msg("添加友链失败:"+data.msg, {icon:2});
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
                    content: "{{route('admin::friendlink.create_or_update_friendlink_page')}}"
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
                        title: "修改友链",
                        btn: ['确定', '取消'],
                        yes: function (index) {
                            var form_data = $(layer.getChildFrame('body',index)).find('form').serialize();
                            var load_index = layer.load();
                            $.ajax({
                                method: "post",
                                url: "{{route('admin::friendlink.create_or_update_friendlink')}}",
                                data: form_data,
                                success: function (data) {
                                    layer.close(load_index);
                                    if ('success' == data.status) {
                                        layer.close(index);
                                        layer.msg("修改友链成功", {icon:1});
                                        tableIns.reload();
                                    } else {
                                        layer.msg("修改友链失败:"+data.msg, {icon:2});
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
                        content: "{{route('admin::friendlink.create_or_update_friendlink_page')}}?friendlink_id=" + data.id
                    });




                }else if ('delete' == obj.event) {
                    layer.confirm("确认要删除该友链？", {icon: 3, title:"确认"}, function (index) {
                        layer.close(index);
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('admin::friendlink.delete_friendlink')}}",
                            data: {friendlink_id: data.id},
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.msg("友链删除成功", {icon:1});
                                    tableIns.reload();
                                } else {
                                    layer.msg("友链删除失败:"+data.msg, {icon:2});
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