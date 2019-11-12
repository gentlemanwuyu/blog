var makeCommentHtml = function (res) {
    var html = '';
    html += '<div id="reply_div' + '" class="respond" style="margin-bottom: 15px;position: relative;">';
    html += '<h4 id="response"><i class="layui-icon"></i> 评论啦~</h4>';
    html += '<br>';
    html += '<form method="post" role="form" lay-filter="article">';
    html += '<input type="hidden" name="parent_id">';
    html += '<div class="layui-form-item">';
    html += '<textarea rows="5" cols="30" name="text" id="textarea" placeholder="嘿~ 大神，别默默的看了，快来点评一下吧" class="layui-textarea" lay-verify="required" lay-reqText="请点评一下吧!"></textarea>';
    html += '</div>';
    html += '<div class="layui-form-item layui-row layui-col-space5">';
    html += '<div class="layui-col-md4">';
    html += '<input type="text" name="author" id="author" lay-verify="required" lay-reqText="请问您怎么称呼？" class="layui-input" placeholder="* 怎么称呼" value="' + getCookie('author') + '">';
    html += '</div>';
    html += '<div class="layui-col-md4">';
    html += '<input type="email" name="mail" id="mail" lay-verify="email" class="layui-input" placeholder="* 邮箱(放心~会保密~.~)" value="' + getCookie('mail') + '">';
    html += '</div>';
    html += '<div class="layui-col-md4">';
    html += '<input type="url" name="url" id="url" class="layui-input" placeholder="http://您的主页" value="' + getCookie('url') + '">';
    html += '</div>';
    html += '</div>';
    html += '<div class="layui-inline">';
    html += '<button type="button" class="layui-btn" lay-submit lay-filter="article">提交评论</button>';
    html += '</div>';
    html += '</form>';
    html += '<a href="javascript:closeReply();" id="close_reply" title="关闭" style="display: none;"><i class="layui-icon layui-icon-close" style="color: #FF5722;position: absolute;right: 0;top: 0;"></i></a>';
    html += '</div>';
    html += '<h3>已有 ' + res.comment_total + ' 条评论</h3>';
    html += '<br>';
    html += '<div class="pinglun">';
    html += recursiveMakeCommentsHtml(res.data);
    html += '</div>';

    return html;
}
    ,recursiveMakeCommentsHtml = function (comments) {
    var comments_html = '';
    comments_html += '<ol class="comment-list">';
    comments.forEach(function (val) {
        comments_html += '<li id="li-comment-' + val.id + '" class="comment-body comment-parent comment-even">';
        comments_html += '<div id="comment-' + val.id + '" class="pl-dan comment-txt-box">';
        comments_html += '<div class="t-p comment-author">';
        comments_html += '<img class="avatar" src="' + val.avatar + '" alt="' + val.username + '" width="40" height="40">';
        comments_html += '</div>';
        comments_html += '<div class="t-u comment-author">';
        comments_html += '<strong>';
        comments_html += '<a href="' + val.link + '" rel="external nofollow">' + val.username + '</a>';
        comments_html += '<span class="layui-badge"></span>';
        comments_html += '</strong>';
        if (val.parent_id) {
            comments_html += '<div><b><a href="#comment-' + val.parent_id + '">@' + val.username + '</a></b></div>';
        }
        comments_html += '<div class="t-s">' + val.content + '</div>';
        comments_html += '<span class="t-btn"><a href="javascript: replyComment(' + val.id + ');" rel="nofollow" onclick="">回复</a> <span class="t-g">' + val.created_at + '</span></span>';
        comments_html += '</div>';
        comments_html += '</div>';
        if (val.children) {
            comments_html += '<div class="pl-list comment-children">';
            comments_html += '<ol class="comment-list">';
            comments_html += recursiveMakeCommentsHtml(val.children);
            comments_html += '</ol>';
            comments_html += '</div>';
        }
        comments_html += '</li>';
    });

    comments_html += '</ol>';
    return comments_html;
}
    ,replyComment = function(comment_id) {
    var comment_dom = $('#reply_div')[0];
    $(comment_dom).remove();
    $('#comment-' + comment_id).append(comment_dom);
    $('#close_reply').show();
    $('input[name=parent_id]').val(comment_id);
    initCommentFormValue();
}
    , closeReply = function () {
    var comment_dom = $('#reply_div')[0];
    $(comment_dom).remove();
    $('#comments').prepend(comment_dom);
    $('#close_reply').hide();
    $('input[name=parent_id]').val('');
    initCommentFormValue();
}
    ,initCommentFormValue = function () {
    $('textarea[name=text]').val('');
    $('input[name=author]').val(getCookie('author'));
    $('input[name=mail]').val(getCookie('mail'));
    $('input[name=url]').val(getCookie('url'));
}
    ,setCookie = function(c_name,value,expiredays) {
    var exdate=new Date()
    exdate.setDate(exdate.getDate()+expiredays)
    document.cookie=c_name+ "=" +escape(value)+
        ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}
    ,getCookie = function(c_name) {
    if (document.cookie.length>0)
    {
        c_start=document.cookie.indexOf(c_name + "=")
        if (c_start!=-1)
        {
            c_start=c_start + c_name.length+1
            c_end=document.cookie.indexOf(";",c_start)
            if (c_end==-1) c_end=document.cookie.length
            return unescape(document.cookie.substring(c_start,c_end))
        }
    }
    return ""
}
    ,removeCookie = function(name) {
    setCookie(name,'随便什么值，反正都要被删除了',-1);
}

layui.use(['layer', 'element', 'util'], function(){
    var $ = layui.$,
        layer = layui.layer,
        element = layui.element,
        util = layui.util;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".nav-btn").on('click', function(){
        $('.nav-btn dl').toggleClass('layui-show');
    });

    //友情链接tips
    $(".link div a").mouseover(function(e) {
        if ($.trim(this.title) != '') {
            this.Title = this.title;
            this.title = "";
            layer.tips(this.Title, this, {tips: 3});
        }
    }).mouseout(function() {
        if (this.Title != null) {
            this.title = this.Title;
        }
    })

    //文章图片点击事件(如果为pc端才生效)
    var device = layui.device();
    if(!(device.weixin || device.android || device.ios)){
        $(".text img").click(function() {
            $.previewImage(this.src);
        });
        $.previewImage = function (src) {
            var img = new Image(), index = layer.load(2, {time: 0, scrollbar: false, shade: [0.02, '#000']});
            img.style.background = '#fff', img.style.display = 'none';
            img.src = src;
            document.body.appendChild(img), img.onerror = function () {
                layer.close(index);
            }, img.onload = function () {
                layer.open({
                    type: 1, shadeClose: true, success: img.onerror, content: $(img), title: false,
                    area: img.width > 1140 ? '1140px' : img.width, closeBtn: 1, skin: 'layui-layer-nobg', end: function () {
                        document.body.removeChild(img);
                    }
                });
            };
        };
    }

    //右下角工具箱（返回顶部）
    util.fixbar();

    // 代码加上行号
    $('pre').addClass("line-numbers").css("white-space", "pre-wrap");
});