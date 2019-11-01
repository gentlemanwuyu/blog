@extends('backend::layouts.default')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>标签列表</legend>
    </fieldset>
    <div class="layui-main">
        <button id="add_label" type="button" class="layui-btn layui-btn-sm layui-btn-normal">新增标签</button>
        <table id="label_list"></table>
    </div>
@endsection
@section('scripts')
    <script>
        layui.use('table', function(){
            var table = layui.table;
            var tableIns = table.render({
                elem: '#label_list',
                url: "{{route('admin::label.paginate')}}",
                page: true,
                parseData: function (res) {
                    return {
                        "code": 0,
                        "msg": '',
                        "count": res.total,
                        "data": res.data
                    };
                },
                cols: [[ //表头
                    {field: 'id', title: 'ID', align: 'center', sort: true, fixed: 'left'},
                    {field: 'name', title: '用户名', align: 'center'},
                    {field: 'created_at', title: '创建时间', align: 'center', sort: true},
                    {field: 'updated_at', title: '最后更新时间', align: 'center', sort: true},
                    {field: 'action', title: '操作', align: 'center', templet: function (data) {
                        var html = '';
                        html += '<button type="button" class="layui-btn layui-btn-sm layui-btn-normal"><i class="layui-icon layui-icon-edit"></i>修改</button>';
                        html += '<button type="button" class="layui-btn layui-btn-sm layui-btn-danger"><i class="layui-icon layui-icon-delete"></i>删除</button>';
                        return html;
                    }}
                ]]
            });

            var $ = layui.$;
            $('#add_label').on('click', function () {
                layer.prompt({
                    title: "添加标签"
                }, function(value, index, elem){
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('admin::label.create_or_update_label')}}",
                        data: {name: value},
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.close(index);
                                layer.msg("添加标签成功", {icon:1});
                                tableIns.reload();
                            } else {
                                layer.msg("添加标签失败:"+data.msg, {icon:2});
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
        });
    </script>
@endsection