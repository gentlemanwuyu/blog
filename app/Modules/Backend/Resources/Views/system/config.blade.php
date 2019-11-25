@extends('backend::layouts.default')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>系统设置</legend>
    </fieldset>
    <form class="layui-form" lay-filter="system_config" style="padding-left: 20px;padding-right: 20px;">
        <div class="layui-form-item">
            <label class="layui-form-label">博客名</label>
            <div class="layui-input-block">
                <input type="text" name="name" placeholder="" class="layui-input" value="{{$all_configs['name'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">博客地址</label>
            <div class="layui-input-block">
                <input type="text" name="address" placeholder="" class="layui-input" value="{{$all_configs['address'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">博主邮箱</label>
            <div class="layui-input-block">
                <input type="text" name="email" placeholder="" class="layui-input" value="{{$all_configs['email'] or ''}}">
            </div>
        </div>
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
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">关于</label>
            <div class="layui-input-block">
                <textarea name="about" placeholder="" class="layui-textarea">{{$all_configs['about'] or ''}}</textarea>
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
@endsection
@section('scripts')
    <script>
        tinymce.init({
            selector: 'textarea[name=about]',
            language:'zh_CN',
            skin: 'oxide',
            plugins: 'lists,advlist image code codesample link paste',
            toolbar:'bold italic underline strikethrough alignleft aligncenter alignright alignjustify forecolor backcolor styleselect formatselect fontselect fontsizeselect bullist numlist outdent indent blockquote undo redo removeformat subscript superscript link image code codesample',
            statusbar: false,
            height: 500,
            rel_list: [
                {title: 'external-nofollow', value: 'external nofollow'}
            ]
        });

        layui.use(['form'], function () {
            var form = layui.form;

            form.on('submit(system_config)', function(data){
                data.field.about = tinyMCE.activeEditor.getContent();
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