layui.use(['laypage', 'form'], function () {
    var laypage = layui.laypage
        ,$ = layui.$
        ,paginate_request = {
        section_id: $('#data').attr('data-section_id'),
        category_id: $('#data').attr('data-category_id')
    }
        ,paginate_total = parseInt($('#data').attr('data-paginate_total'))


    if (paginate_total) {
        laypage.render({
            elem: 'paginate'
            ,count: paginate_total
            ,groups: 3
            ,prev: '<i class="layui-icon layui-icon-left"></i>'
            ,next: '<i class="layui-icon layui-icon-right"></i>'
            ,jump: function(obj, first){
                if (!first) {
                    $.ajax({
                        method: "post",
                        url: "/article/paginate",
                        data: Object.assign(paginate_request, {limit: obj.limit, page: obj.curr}),
                        success: function (res) {
                            var html = '';
                            res.data.forEach(function (article) {
                                html += '<div class="title-article list-card">';
                                html += '<div class="list-pic">';
                                html += '<a href="' + article.href + '" title="' + article.title + '">';
                                html += '<img src="' + article.summary_image_url + '" alt="' + article.summary_image_desc + '" class="img-full">';
                                html += '</a>';
                                html += '</div>';
                                html += '<a href="' + article.href + '" title="' + article.title + '">';
                                html += '<h1>' + article.title + '</h1>';
                                html += '<p>' + article.summary + '</p>';
                                html += '</a>';
                                html += '<div class="title-msg">';
                                html += '<span><i class="layui-icon">&#xe705;</i>&nbsp;' + article.category_name + '</span>';
                                html += '<span><i class="layui-icon">&#xe60e;</i>&nbsp;' + article.create_date + '</span>';
                                html += '<span class="layui-hide-xs"><i class="layui-icon">&#xe62c;</i>&nbsp;1176℃</span>';
                                html += '<span class="layui-hide-xs"><i class="layui-icon">&#xe63a;</i>&nbsp;' + article.comment_total + '条</span>';
                                html += '</div>';
                                html += '</div>';
                            });
                            $('.post').html(html);
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {

                            return false;
                        }
                    });
                }
            }
        });
    }else {
        $('.post').html('<h2 class="post-title">没有找到内容</h2>');
    }
});