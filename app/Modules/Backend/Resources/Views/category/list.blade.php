@extends('backend::layouts.default')
@section('css')
    <style>
        .vakata-context, .jstree-contextmenu, .jstree-default-contextmenu{z-index: 1000;}
    </style>
@endsection
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>分类管理</legend>
    </fieldset>
    <div class="layui-tab">
        <ul class="layui-tab-title">
            @foreach(config('sections') as $section_id => $section)
                <li @if(1 == $section_id)class="layui-this"@endif>{{$section['name']}}</li>
            @endforeach
        </ul>
        <div class="layui-tab-content">
            @foreach(config('sections') as $section_id => $section)
                <div class="layui-tab-item @if(1 == $section_id) layui-show @endif">
                    <div class="layui-main">
                        <button type="button" class="layui-btn layui-btn-sm layui-btn-normal add_category" data-section_id="{{$section_id}}">添加一级分类</button>
                        <div class="category_tree" style="margin-top: 20px;" data-section_id="{{$section_id}}">

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.category_tree').jstree({
            "plugins": ['contextmenu', "state", "types"],
            "core" : {
                "data" : function (node, callback) {
                    $.get("{{route('admin::category.get_tree')}}?section_id=" + this.element.attr('data-section_id'), function (data) {
                        $.each(data, function (key, val) {
                            val.text = val.name;
                            val.li_attr = {"data-level": 1};
                            if (val.children) {
                                $.each(val.children, function (c_key, c_val) {
                                    c_val.text = c_val.name;
                                    c_val.li_attr = {"data-level": 2};
                                });
                            }
                        });
                        callback(data);
                    });
                },
                "themes": {"icons": false}
            },
            "contextmenu": {
                "items": function (node) {
                    var category_id = node.id;
                    var category_name = node.text;
                    var category_level = node.li_attr['data-level'];
                    var that = this;
                    var items = {
                        "add": {
                            "label": "添加子分类",
                            "icon": "layui-icon layui-icon-add-1",
                            "action": function () {
                                layer.prompt({
                                    title: "添加子分类"
                                }, function(value, index, elem){
                                    var load_index = layer.load();
                                    $.ajax({
                                        method: "post",
                                        url: "{{route('admin::category.create_or_update_category')}}",
                                        data: {name: value, parent_id: category_id},
                                        success: function (data) {
                                            layer.close(load_index);
                                            if ('success' == data.status) {
                                                layer.close(index);
                                                layer.msg("添加子分类成功", {icon:1});
                                                that.refresh();
                                            } else {
                                                layer.msg("添加子分类失败:"+data.msg, {icon:2});
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
                        },
                        "edit": {
                            "label": "编辑",
                            "icon": "layui-icon layui-icon-edit",
                            "action": function () {
                                layer.prompt({
                                    value: category_name,
                                    title: "编辑分类"
                                }, function(value, index, elem){
                                    var load_index = layer.load();
                                    $.ajax({
                                        method: "post",
                                        url: "{{route('admin::category.create_or_update_category')}}",
                                        data: {name: value, category_id: category_id},
                                        success: function (data) {
                                            layer.close(load_index);
                                            if ('success' == data.status) {
                                                layer.close(index);
                                                layer.msg("编辑分类成功", {icon:1});
                                                that.refresh();
                                            } else {
                                                layer.msg("编辑分类失败:"+data.msg, {icon:2});
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
                        },
                        "delete": {
                            "label": "删除",
                            "icon": "layui-icon layui-icon-delete",
                            "action": function () {
                                layer.confirm("确认要删除该分类？", {icon: 3, title:"确认"}, function (index) {
                                    layer.close(index);
                                    var load_index = layer.load();
                                    $.ajax({
                                        method: "post",
                                        url: "{{route('admin::category.delete_category')}}",
                                        data: {category_id: category_id},
                                        success: function (data) {
                                            layer.close(load_index);
                                            if ('success' == data.status) {
                                                layer.msg("分类删除成功", {icon:1});
                                                that.refresh();
                                            } else {
                                                layer.msg("分类删除失败:"+data.msg, {icon:2});
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
                        }
                    };

                    // 最多两级分类，两级分类的右键菜单不显示添加子分类
                    if (2 == category_level) {
                        delete items.add;
                    }

                    return items;
                }
            }
        }).on('ready.jstree', function () {$(this).jstree('open_all')});

        $('.add_category').on('click', function () {
            var section_id = $(this).attr('data-section_id');
            var this_button = this;
            layer.prompt({
                title: "添加一级分类"
            }, function(value, index, elem){
                var load_index = layer.load();
                $.ajax({
                    method: "post",
                    url: "{{route('admin::category.create_or_update_category')}}",
                    data: {name: value, section_id: section_id},
                    success: function (data) {
                        layer.close(load_index);
                        if ('success' == data.status) {
                            layer.close(index);
                            layer.msg("添加一级分类成功", {icon:1});
                            $(this_button).parents().find('.category_tree').jstree(true).refresh();
                        } else {
                            layer.msg("添加一级分类失败:"+data.msg, {icon:2});
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
    </script>
@endsection