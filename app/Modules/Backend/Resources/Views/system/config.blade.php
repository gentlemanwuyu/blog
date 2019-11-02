@extends('backend::layouts.default')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>系统设置</legend>
    </fieldset>
    <div class="row">
        <div class="layui-col-xs6">
            <form class="layui-form" lay-filter="system_config">
                <div class="layui-form-item">
                    <label class="layui-form-label">博客标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" placeholder="" class="layui-input" value="{{$all_configs['title'] or ''}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">关键字</label>
                    <div class="layui-input-block">
                        <input type="text" name="keywords" placeholder="多个关键字以英文逗号分隔" class="layui-input" value="{{$all_configs['keywords'] or ''}}">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="desc" placeholder="" class="layui-textarea">{{$all_configs['desc'] or ''}}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">ICP备案号</label>
                    <div class="layui-input-block">
                        <input type="text" name="icp" placeholder="" class="layui-input" value="{{$all_configs['icp'] or ''}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" lay-submit lay-filter="system_config">提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        layui.use(['form'], function () {
            var form = layui.form;

            form.on('submit(system_config)', function(data){
                console.log(this);
                var load_index = layer.load();
                $.ajax({
                    method: "post",
                    url: "{{route('admin::system.save_config')}}",
                    data: data.field,
                    success: function (data) {
                        layer.close(load_index);
                        if ('success' == data.status) {
                            layer.msg("系统配置保存成功", {icon:1});
                            location.reload();
                        } else {
                            layer.msg("系统配置保存失败:"+data.msg, {icon:2});
                            return false;
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        layer.close(load_index);
                        layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                        return false;
                    }
                });

                return false;
            });
        });
    </script>
@endsection