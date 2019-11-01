@extends('backend::layouts.template')
@section('body')
    <div class="row">
        <div class="layui-col-xs6 layui-col-xs-offset3" style="margin-top: 20px;">
            <form class="layui-form" action="">
                @if(isset($friendlink_id))
                    <input type="hidden" name="friendlink_id" value="{{$friendlink_id}}">
                @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" required placeholder="网站名称" class="layui-input" value="{{$friendlink->name or ''}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接</label>
                    <div class="layui-input-block">
                        <input type="text" name="link" required placeholder="链接" class="layui-input" value="{{$friendlink->link or ''}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection