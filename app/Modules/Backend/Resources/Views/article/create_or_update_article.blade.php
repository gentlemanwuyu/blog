@extends('backend::layouts.default')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>发布文章</legend>
    </fieldset>
    <form class="layui-form" lay-filter="system_config" style="padding-left: 20px;padding-right: 20px;">
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" placeholder="" class="layui-input" value="{{$all_configs['title'] or ''}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">关键字</label>
            <div class="layui-input-block">
                <input type="text" name="keywords" placeholder="多个关键字以英文逗号分隔" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
                <textarea name="content" placeholder="" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">摘要</label>
            <div class="layui-input-block">
                <textarea name="summary" placeholder="" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
                @foreach($categories as $category)
                    <input type="radio" name="category_id" value="{{$category->id}}" title="{{$category->name}}">
                @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">标签</label>
            <div class="layui-input-block">
                @foreach($labels as $label)
                    <input type="checkbox" name="labels[]" value="{{$label->id}}" title="{{$label->name}}">
                @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit lay-filter="system_config">发布</button>
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
            plugins: 'lists,advlist image code',
            toolbar:'bold italic underline strikethrough alignleft aligncenter alignright alignjustify forecolor backcolor styleselect formatselect fontselect fontsizeselect bullist numlist outdent indent blockquote undo redo removeformat subscript superscript image code',
            statusbar: false,
            height: 500
        });
    </script>
@endsection