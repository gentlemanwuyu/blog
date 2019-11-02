@extends('backend::layouts.default')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>评论列表</legend>
    </fieldset>
    <div class="layui-main">
        <table id="comment_list"  lay-filter="list"></table>
    </div>
    <script type="text/html" id="action">
        <a class="layui-btn layui-btn-sm layui-btn-danger" lay-event="delete"><i class="layui-icon layui-icon-delete"></i>删除</a>
    </script>
@endsection
@section('scripts')
    <script>
        layui.use('table', function(){
            var table = layui.table;

            var tableIns = table.render({
                elem: '#comment_list',
                url: "{{route('admin::comment.paginate')}}",
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
                    {field: 'content', title: '内容', align: 'center'},
                    {field: 'article_id', title: '文章', align: 'center'},
                    {field: 'username', title: '用户', align: 'center'},
                    {field: 'email', title: '邮箱', align: 'center'},
                    {field: 'link', title: '链接', align: 'center'},
                    {field: 'parent_id', title: '主评论', align: 'center'},
                    {field: 'created_at', title: '创建时间', align: 'center', sort: true},
                    {field: 'action', title: '操作', align: 'center', toolbar: "#action"}
                ]]
            });

            table.on('tool(list)', function(obj){
                var data = obj.data;

                if ('delete' == obj.event) {
                    layer.confirm("确认要删除该评论？", {icon: 3, title:"确认"}, function (index) {
                        layer.close(index);
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('admin::comment.delete_comment')}}",
                            data: {comment_id: data.id},
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.msg("评论删除成功", {icon:1});
                                    tableIns.reload();
                                } else {
                                    layer.msg("评论删除失败:"+data.msg, {icon:2});
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