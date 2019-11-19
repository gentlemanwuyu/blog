@extends('backend::layouts.default')
@section('css')
    <style>
        .img_container {
            width: 208px!important;
            height: 208px;
            border: 1px dashed #8D8D8D;
            padding: 3px;
            border-radius: 3px;
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        .img_container>img {
            width: auto;
            height: 200px;
        }
    </style>
@endsection
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>发布文章</legend>
    </fieldset>
    <form class="layui-form" lay-filter="article" style="padding-left: 20px;padding-right: 20px;">
        <input type="hidden" name="article_id" value="{{$article_id or ''}}">
        <div class="layui-form-item">
            <label class="layui-form-label required">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" placeholder="" class="layui-input" value="{{$article['title'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">关键词</label>
            <div class="layui-input-block">
                <input type="text" name="keywords" placeholder="多个关键词以英文逗号分隔" class="layui-input" value="{{$article['keywords'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label required">内容</label>
            <div class="layui-input-block">
                <textarea name="content" placeholder="" class="layui-textarea">{{htmlentities($article['content'])}}</textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label required">摘要</label>
            <div class="layui-input-block">
                <textarea name="summary" placeholder="" class="layui-textarea">{{$article['summary'] or ''}}</textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <input type="hidden" name="summary_image_url" value="{{$article->summary_image_url or ''}}">
            <label class="layui-form-label required">摘要图片</label>
            <div class="layui-input-block">
                <button type="button" class="layui-btn" id="upload_img">上传图片</button>
                <button type="button" class="layui-btn" id="select_img">从图库中选择</button>
            </div>
        </div>
        <div class="layui-form-item layui-form-text" @if(!isset($article) || !$article->summary_image_url) style="display: none;" @endif>
            <div class="layui-input-block">
                <div class="img_container">
                    @if(isset($article) && $article->summary_image_url)
                        <img src="{{$article->summary_image_url}}">
                    @endif
                </div>
            </div>
        </div>
        <div class="layui-form-item layui-form-text" style="display: none;">
            <div class="layui-input-block">
                <input type="checkbox" name="is_sync_summary_image" value="1" title="同步到摘要图库" lay-skin="primary">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">摘要图片描述</label>
            <div class="layui-input-block">
                <input type="text" name="summary_image_desc" placeholder="" class="layui-input" value="{{$article->summary_image_desc or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
                @foreach($categories as $category)
                    @if(empty($category['children']))
                        <input type="radio" name="category_id" value="{{$category['id']}}" title="{{$category['name']}}" @if(isset($article) && $article->category_id == $category['id']) checked @endif>
                    @else
                        @foreach($category['children'] as $child)
                            <input type="radio" name="category_id" value="{{$child['id']}}" title="<span style='color: rgba(0,0,0,.4);line-height:100%;'>{{$category['name']}}&nbsp;/&nbsp;</span>{{$child['name']}}" @if(isset($article) && $article->category_id == $child['id']) checked @endif>
                        @endforeach
                    @endif
                    <br>
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
            plugins: 'lists,advlist image codesample link paste table',
            toolbar:'bold italic underline strikethrough alignleft aligncenter alignright alignjustify forecolor backcolor styleselect formatselect fontselect fontsizeselect bullist numlist outdent indent blockquote undo redo removeformat subscript superscript link image codesample table',
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

        layui.use(['form', 'upload'], function () {
            var form = layui.form
            ,upload = layui.upload;

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

            var uploadInst = upload.render({
                elem: '#upload_img' //绑定元素
                ,url: '{{route('admin::article.upload')}}' //上传接口
                ,accept: 'images'
                ,headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                ,field: 'image'
                ,before: function(obj){
                    layer.load();
                }
                ,done: function(res, index, upload){
                    layer.closeAll('loading');
                    if (res.status) {
                        $('.img_container').html('<img src="' + res.url + '">');
                        $('.img_container').parents('div.layui-form-item').show();
                        $('input[name=is_sync_summary_image]').parents('.layui-form-item').show();
                        $('input[name=summary_image_url]').val(res.url);
                    }else {
                        layer.msg("图片上传失败", {icon:2});
                        $('.img_container').html('');
                        $('.img_container').parents('div.layui-form-item').hide();
                        $('input[name=summary_image_url]').val('');
                    }
                }
                ,error: function(index, upload){
                    layer.closeAll('loading');
                    $('.img_container').html('');
                    $('.img_container').parents('div.layui-form-item').hide();
                    $('input[name=summary_image_url]').val('');
                }
            });

            $('#select_img').on('click', function () {
                layer.open({
                    type: 2,
                    area: ['80%', '80%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "选择摘要图片",
                    btn: ['确定', '取消'],
                    yes: function (index) {
                        var form_data = array_column($(layer.getChildFrame('body',index)).find('form').serializeArray());
                        $('input[name=is_sync_summary_image]').prop('checked', false);
                        form.render(null, 'article');
                        $('input[name=summary_image_url]').val(form_data.summary_image_url);
                        $('input[name=summary_image_desc]').val(form_data.summary_image_desc);
                        $('.img_container').html('<img src="' + form_data.summary_image_url + '">');
                        $('.img_container').parents('div.layui-form-item').show();
                        $('input[name=is_sync_summary_image]').parents('.layui-form-item').hide();
                        layer.close(index);
                    },
                    content: "{{route('admin::article.select_summary_image_page')}}"
                });
            });
        });
    </script>
@endsection