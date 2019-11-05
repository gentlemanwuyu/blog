@extends('backend::layouts.default')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>文章列表</legend>
    </fieldset>
    <div class="layui-main">
        <a class="layui-btn layui-btn-sm layui-btn-normal" href="{{route('admin::article.add_article')}}">发布文章</a>
        <table id="article_list"  lay-filter="list"></table>
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
                elem: '#article_list',
                url: "{{route('admin::article.paginate')}}",
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
                    {field: 'title', title: '标题', align: 'center'},
                    {field: 'keywords', title: '关键词', align: 'center'},
                    {field: 'summary', title: '摘要', align: 'center'},
                    {field: 'category_name', title: '分类', align: 'center'},
                    {field: 'created_at', title: '创建时间', align: 'center', sort: true},
                    {field: 'updated_at', title: '最后更新时间', align: 'center', sort: true},
                    {field: 'action', title: '操作', align: 'center', toolbar: "#action"}
                ]]
            });

            table.on('tool(list)', function(obj){
                var data = obj.data;

                if ('edit' == obj.event) {
                    window.location.href = "{{route('admin::article.add_article')}}?article_id=" + data.id;
                }else if ('delete' == obj.event) {
                    layer.confirm("确认要删除该文章？", {icon: 3, title:"确认"}, function (index) {
                        layer.close(index);
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('admin::article.delete_article')}}",
                            data: {article_id: data.id},
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.msg("文章删除成功", {icon:1});
                                    tableIns.reload();
                                } else {
                                    layer.msg("文章删除失败:"+data.msg, {icon:2});
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