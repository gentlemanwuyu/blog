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
                    $.get("{{route('admin::category.get_tree')}}?section_id=" + this.element.attr('data-section_id'), callback);
                },
                "themes": {"icons": false}
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