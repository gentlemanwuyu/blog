@extends('backend::layouts.template')
@section('css')
    <style>
        img {
            width: auto;
            height: 200px;
        }
        .img_container {
            width: 212px!important;
            height: 212px;
            border: 1px dashed #8D8D8D;
            padding: 5px;
            border-radius: 3px;
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
    </style>
@endsection
@section('body')
    <div class="row" style="margin-top: 20px;">
        <div class="layui-col-xs6">
            <form class="layui-form" action="">
                <input type="hidden" name="summary_image_id" value="{{$summary_image_id or ''}}">
                <div class="layui-form-item" style="">
                    <div class="layui-input-block">
                        <input type="hidden" name="url" value="{{$summary_image->url or ''}}">
                        <div class="img_container">
                            @if(isset($summary_image))
                                <img src="{{$summary_image->url}}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" id="upload_img">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片描述</label>
                    <div class="layui-input-block">
                        <input type="text" name="desc" placeholder="" class="layui-input" value="{{$summary_image->desc or ''}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        layui.use('upload', function(){
            var upload = layui.upload;

            //执行实例
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
                        $('.img_container').append('<img src="' + res.url + '">');
                        $('input[name=url]').val(res.url);
                    }else {
                        layer.msg("图片上传失败", {icon:2});
                        $('.img_container').html('');
                        $('input[name=url]').val('');
                    }
                }
                ,error: function(index, upload){
                    layer.closeAll('loading');
                    $('.img_container').html('');
                    $('input[name=url]').val('');
                }
            });
        });
    </script>
@endsection