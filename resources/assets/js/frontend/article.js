layui.use(['laypage', 'form'], function () {
    var laypage = layui.laypage
        ,$ = layui.$
        ,form = layui.form
        ,paginate_options = {
        elem: 'paginate'
        ,count: $('#comments').attr('data-paginate_total')
        ,groups: 3
        ,prev: '<i class="layui-icon layui-icon-left"></i>'
        ,next: '<i class="layui-icon layui-icon-right"></i>'
        ,jump: function(obj, first){
            $.ajax({
                method: "post",
                url: "/comment/paginate",
                data: {source: 1, article_id: $('#comments').attr('data-article_id'), limit: obj.limit, page: obj.curr},
                success: function (res) {
                    $('div#comments').html(makeCommentHtml(res));
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {

                    return false;
                }
            });
        }
    };

    laypage.render(paginate_options);

    form.on('submit(comment)', function(data){
        data.field.source = 1;
        data.field.article_id = $('#comments').attr('data-article_id');
        var load_index = layer.load();

        if (data.field.author) {
            setCookie('author', data.field.author);
        }
        if (data.field.mail) {
            setCookie('mail', data.field.mail);
        }
        if (data.field.url) {
            setCookie('url', data.field.url);
        }

        $.ajax({
            method: "post",
            url: '/comment/create_comment',
            data: data.field,
            success: function (data) {
                layer.close(load_index);
                if ('success' == data.status) {
                    layer.msg("谢谢您的点评!", {icon:1});
                    laypage.render(paginate_options);
                } else {
                    layer.msg("对不起, 评论失败, 请联系博主!", {icon:2});
                    return false;
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                layer.close(load_index);
                layer.msg("对不起, 评论失败, 请联系博主!", {icon:2});
                return false;
            }
        });

        return false;
    });
});
