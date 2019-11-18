<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>登录 | Woozee后台管理</title>
    <link rel="stylesheet" href="{{asset('/assets/layui-src/dist/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('/assets/layuiadmin/style/login.css')}}" media="all">
</head>
<body class="layui-layout-body">
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>WoozeeAdmin</h2>
            <p>Woozee博客后台管理系统</p>
        </div>
        <form action="{{route('admin::login')}}" method="post">
            <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
            <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                    <input type="text" name="username" placeholder="用户名" class="layui-input" required oninvalid="setCustomValidity('请输入用户名')" oninput="setCustomValidity('');">
                </div>
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                    <input type="password" name="password" placeholder="密码" class="layui-input" required oninvalid="setCustomValidity('请输入密码')" oninput="setCustomValidity('');">
                </div>
                <div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-xs7">
                            <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>
                            <input type="text" name="captcha" placeholder="图形验证码" class="layui-input" required oninvalid="setCustomValidity('请输入验证码')" oninput="setCustomValidity('');">
                        </div>
                        <div class="layui-col-xs5">
                            <div style="margin-left: 10px;">
                                <img src="{{\Mews\Captcha\Facades\Captcha::src('woozee')}}" class="layadmin-user-login-codeimg" alt="captcha" onclick="this.src='{{\Mews\Captcha\Facades\Captcha::src('woozee')}}?'+Math.random()">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <button type="submit" class="layui-btn layui-btn-fluid">登 入</button>
                </div>
            </div>
        </form>
    </div>

    <div class="layui-trans layadmin-user-login-footer">
        <p>© 2019 <a href="http://www.layui.com/" target="_blank">woozee.com.cn</a></p>
    </div>
</div>
<script src="{{asset('/assets/layui-src/dist/layui.js')}}"></script>
<script>
    layui.use(['form', 'layer'], function(){
        @if (isset($errors) && count($errors) > 0)
            layui.layer.msg("{{implode('<br>', $errors->all())}}", {icon:2});
        @endif
    });
</script>
</body>
</html>