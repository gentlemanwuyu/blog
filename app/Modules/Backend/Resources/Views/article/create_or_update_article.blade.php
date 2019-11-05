@extends('backend::layouts.default')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>发布文章</legend>
    </fieldset>
    <form class="layui-form" lay-filter="article" style="padding-left: 20px;padding-right: 20px;">
        <input type="hidden" name="article_id" value="{{$article_id}}">
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" placeholder="" class="layui-input" value="{{$article['title'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">关键字</label>
            <div class="layui-input-block">
                <input type="text" name="keywords" placeholder="多个关键字以英文逗号分隔" class="layui-input" value="{{$article['keywords'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
                <textarea name="content" placeholder="" class="layui-textarea">{{$article['content'] or ''}}</textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">摘要</label>
            <div class="layui-input-block">
                <textarea name="summary" placeholder="" class="layui-textarea">{{$article['summary'] or ''}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
                @foreach($categories as $category)
                    <input type="radio" name="category_id" value="{{$category->id}}" title="{{$category->name}}" @if(isset($article) && $article->category_id == $category->id) checked @endif>
                @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">标签</label>
            <div class="layui-input-block">
                @foreach($labels as $label)
                    <input type="checkbox" name="labels[]" value="{{$label->id}}" title="{{$label->name}}" @if(isset($article) && in_array($label->id, $article->labelIds->pluck('label_id')->toArray())) checked @endif>
                @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit lay-filter="article">发布</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        tinymce.init({
            selector: 'textarea[name=content]',
            language:'zh_CN',
            skin: 'oxide',
            plugins: 'lists,advlist image codesample link paste',
            toolbar:'bold italic underline strikethrough alignleft aligncenter alignright alignjustify forecolor backcolor styleselect formatselect fontselect fontsizeselect bullist numlist outdent indent blockquote undo redo removeformat subscript superscript link image codesample',
            statusbar: false,
            height: 500,
            images_upload_url: "{{route('admin::article.upload')}}",
            paste_data_images: true,
            paste_postprocess: function(plugin, args) {
                $(args.node).find('img').each(function (key, val) {
                    var that = this;
                    var formData = new FormData();
                    formData.append('image_url', val.src);
                    $.ajax({
                        url: '{{route("admin::article.paste_upload")}}',
                        type: 'POST',
                        cache: false,
                        async: false,
                        data: formData,
                        processData: false,
                        contentType: false
                    }).done(function(res) {
                        if (res.status) {
                            that.src = res.url;
                        }else {
                            layer.msg("图片上传失败", {icon:2});
                            that.src = '';
                        }
                    }).fail(function(res) {
                        layer.msg("图片上传失败", {icon:2});
                        that.src = '';
                    });
                });
            },
            images_upload_handler: function (blobInfo, success, failure) {
                var formData = new FormData();
                formData.append('image', blobInfo.blob());
                $.ajax({
                    url: '{{route("admin::article.upload")}}',
                    type: 'POST',
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false
                }).done(function(res) {
                    if (res.status) {
                        success(res.url);
                    }else {
                        failure(res.msg);
                    }
                }).fail(function(res) {
                    failure(res.msg);
                });
            }
        });

        layui.use(['form'], function () {
            var form = layui.form;

            form.on('submit(article)', function(data){
                var form_data = data.field;
                form_data.content = tinyMCE.activeEditor.getContent();
                var load_index = layer.load();
                $.ajax({
                    method: "post",
                    url: "{{route('admin::article.save_article')}}",
                    data: form_data,
                    success: function (data) {
                        layer.close(load_index);
                        if ('success' == data.status) {
                            layer.msg("文章发布成功", {icon:1});
                            window.location.href = "{{route('admin::article.list')}}";
                        } else {
                            layer.msg("文章发布失败:"+data.msg, {icon:2});
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