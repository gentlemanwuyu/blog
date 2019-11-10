@extends('frontend::layouts.default')
@section('content')
    <div class="title-article">
        <h1>{{$article->title}}</h1>
        <div class="title-msg">
            <span><i class="layui-icon">&#xe612;</i>吴宇</span>
            <span><i class="layui-icon">&#xe60e;</i>{{$article->create_date}}</span>
            <span><i class="layui-icon">&#xe62c;</i>6580℃</span>
            <span><i class="layui-icon">&#xe63a;</i>143条</span>
        </div>
    </div>
    <div class="text" itemprop="articleBody">
        <div id="md_content_2" class="md_content markdown-body editormd-html-preview" style="min-height: 50px;">
            <blockquote>
                <p>{{$article->summary}}</p>
            </blockquote>
            {!! $article->content !!}
        </div>
    </div>
    <div class="tags-text">
        <i class="layui-icon">&#xe66e;</i>标签: php
    </div>
    <div class="copy-text">
        <div>
            <p>非特殊说明，本博所有文章均为博主原创。</p>
            <p class="hidden-xs">如若转载，请注明出处：<a href="#">typecho</a> </p>
        </div>
    </div>
    <div class="page-text">
        @if($article->previous)
            <div>
                <span class="layui-badge layui-bg-gray">上一篇</span>
                <a href="{{route('frontend::article.detail', ['id' => $article->previous->id])}}">{{$article->previous->title}}</a>
            </div>
        @endif
        @if($article->next)
            <div>
                <span class="layui-badge layui-bg-gray">下一篇</span>
                <a href="{{route('frontend::article.detail', ['id' => $article->next->id])}}">{{$article->next->title}}</a>
            </div>
        @endif
    </div>
    <div class="comment-text layui-form">
        <div id="comments">
            <div id="respond-post-41" class="respond">
                <h4 id="response"><i class="layui-icon"></i> 评论啦~</h4>
                <br>
                <form method="post" action="https://www.echo.so/life/41.html/comment" id="comment-form" role="form">
                    <div class="layui-form-item">
                        <textarea rows="5" cols="30" name="text" id="textarea" placeholder="嘿~ 大神，别默默的看了，快来点评一下吧" class="layui-textarea"></textarea>
                    </div>
                    <div class="layui-form-item layui-row layui-col-space5">
                        <div class="layui-col-md4">
                            <input type="text" name="author" id="author" class="layui-input" placeholder="* 怎么称呼" value="" required="">
                        </div>
                        <div class="layui-col-md4">
                            <input type="email" name="mail" id="mail" lay-verify="email" class="layui-input" placeholder="* 邮箱(放心~会保密~.~)" value="123@test.com" required="">
                        </div>
                        <div class="layui-col-md4">
                            <input type="url" name="url" id="url" lay-verify="url" class="layui-input" placeholder="http://您的主页" value="">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button type="submit" class="layui-btn">提交评论</button>
                    </div>
                    <input type="hidden" name="_" value="68bdcf980fbe5ba6f990ba6881442a8d">
                </form>
            </div>
            <br>
            <h3>已有 144 条评论</h3>
            <br>
            <div class="pinglun" id="pinlun">
                <ol class="comment-list">
                    <!-- 单条评论者信息及内容 -->
                    <li id="li-comment-418" class="comment-body comment-parent comment-even">
                        <div id="comment-418" class="pl-dan comment-txt-box">
                            <div class="t-p comment-author">
                                <img class="avatar" src="https://secure.gravatar.com/avatar/072d588effb06043854f7f3b79e2a333?s=40&amp;r=G&amp;d=" alt="居然。" width="40" height="40">        </div>
                            <div class="t-u comment-author">
                                <strong>
                                    <a href="https://www.dyit6.cn" rel="external nofollow">居然。</a>                <span class="layui-badge"></span>
                                </strong>
                                <div><b></b></div>
                                <div class="t-s"><p></p><p>我又来提问了：<br>   首页文章不显示文章里的图片。<br>   这是嘛问题阿。我开始用了图床里的图片显示不出来，然后我又用了本里服务器的图片还是显示不出来。</p><p></p></div>
                                <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=418#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-418', 418);">回复</a> <span class="t-g">2019-10-24 13:03 &nbsp;&nbsp;(Windows 10 x64 Edition&nbsp;/&nbsp;Google Chrome 77.0.3865.120)</span></span>
                            </div>
                        </div>
                    </li>


                    <li id="li-comment-415" class="comment-body comment-parent comment-odd">
                        <div id="comment-415" class="pl-dan comment-txt-box">
                            <div class="t-p comment-author">
                                <img class="avatar" src="https://secure.gravatar.com/avatar/072d588effb06043854f7f3b79e2a333?s=40&amp;r=G&amp;d=" alt="居然。" width="40" height="40">        </div>
                            <div class="t-u comment-author">
                                <strong>
                                    <a href="https://www.dyit6.cn" rel="external nofollow">居然。</a>                <span class="layui-badge"></span>
                                </strong>
                                <div><b></b></div>
                                <div class="t-s"><p></p><p>对了，代码怎么才能高亮</p><p></p></div>
                                <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=415#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-415', 415);">回复</a> <span class="t-g">2019-10-23 22:48 &nbsp;&nbsp;(Windows 10 x64 Edition&nbsp;/&nbsp;Google Chrome 77.0.3865.120)</span></span>
                            </div><!-- 单条评论者信息及内容 -->
                        </div>
                        <div class="pl-list comment-children">
                            <ol class="comment-list">
                                <li id="li-comment-416" class="comment-body comment-child comment-level-odd comment-odd comment-by-author">
                                    <div id="comment-416" class="pl-dan comment-txt-box">
                                        <div class="t-p comment-author">
                                            <img class="avatar" src="https://secure.gravatar.com/avatar/108e214ad25b4d5050cfee16bb9bac44?s=40&amp;r=G&amp;d=" alt="宁采陈" width="40" height="40">        </div>
                                        <div class="t-u comment-author">
                                            <strong>
                                                <a href="https://www.echo.so" rel="external nofollow">宁采陈</a>                <span class="layui-badge">博主</span>
                                            </strong>
                                            <div><b><a href="#comment-415">@居然。</a></b></div>
                                            <div class="t-s"><p></p><p>网上有代码高亮插件。</p><p></p></div>
                                            <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=416#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-416', 416);">回复</a> <span class="t-g">2019-10-24 09:00 &nbsp;&nbsp;(Mac OS X 10.14.5&nbsp;/&nbsp;Google Chrome 77.0.3865.120)</span></span>
                                        </div><!-- 单条评论者信息及内容 -->
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </li>

                    <!-- 有回复 -->
                    <li id="li-comment-414" class="comment-body comment-parent comment-even">
                        <div id="comment-414" class="pl-dan comment-txt-box">
                            <div class="t-p comment-author">
                                <img class="avatar" src="https://secure.gravatar.com/avatar/072d588effb06043854f7f3b79e2a333?s=40&amp;r=G&amp;d=" alt="居然。" width="40" height="40">        </div>
                            <div class="t-u comment-author">
                                <strong>
                                    <a href="https://www.dyit6.cn" rel="external nofollow">居然。</a>                <span class="layui-badge"></span>
                                </strong>
                                <div><b></b></div>
                                <div class="t-s"><p></p><p>文章里边的代码没隐藏。<br>但是点进文章代码又是隐藏了的。</p><p></p></div>
                                <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=414#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-414', 414);">回复</a> <span class="t-g">2019-10-23 21:42 &nbsp;&nbsp;(Windows 10 x64 Edition&nbsp;/&nbsp;Google Chrome 77.0.3865.120)</span></span>
                            </div>
                        </div>
                    </li>

                    <!-- 多条回复 -->
                    <li id="li-comment-403" class="comment-body comment-parent comment-odd">
                        <div id="comment-403" class="pl-dan comment-txt-box">
                            <div class="t-p comment-author">
                                <img class="avatar" src="https://secure.gravatar.com/avatar/6cbd6bad82f8739d1a41318c434eb0cc?s=40&amp;r=G&amp;d=" alt="zbxm" width="40" height="40">        </div>
                            <div class="t-u comment-author">
                                <strong>
                                    <a href="http://zhengbanxianmian.com" rel="external nofollow">zbxm</a>                <span class="layui-badge"></span>
                                </strong>
                                <div><b></b></div>
                                <div class="t-s"><p></p><p>大神大神，我在网上搜索到在function那里添加自定义缩略图的代码</p>/*
                                    * 文章缩略图自定义字段
                                    */
                                    function themeFields($layout) {
                                    $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('自定义缩略图'), _t('输入缩略图地址(仅文章有效)'));
                                    $layout-&gt;addItem($thumb);
                                    }<p>我在function那里加了进去能添加，但是请问要如何显示我添加的网址的缩略图呀，我没有学过编程~</p><p></p></div>
                                <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=403#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-403', 403);">回复</a> <span class="t-g">2019-10-18 10:16 &nbsp;&nbsp;(Windows 10 x64 Edition&nbsp;/&nbsp;Google Chrome 77.0.3865.90)</span></span>
                            </div>
                        </div>
                        <div class="pl-list comment-children">
                            <ol class="comment-list">
                                <li id="li-comment-411" class="comment-body comment-child comment-level-odd comment-even comment-by-author">
                                    <div id="comment-411" class="pl-dan comment-txt-box">
                                        <div class="t-p comment-author">
                                            <img class="avatar" src="https://secure.gravatar.com/avatar/108e214ad25b4d5050cfee16bb9bac44?s=40&amp;r=G&amp;d=" alt="宁采陈" width="40" height="40">        </div>
                                        <div class="t-u comment-author">
                                            <strong>
                                                <a href="https://www.echo.so" rel="external nofollow">宁采陈</a>                <span class="layui-badge">博主</span>
                                            </strong>
                                            <div><b><a href="#comment-403">@zbxm</a></b></div>
                                            <div class="t-s"><p></p><p>你要使用$this-&gt;fields-&gt;thumb();来输出你文章填写的缩略图地址。然后在index.php显示缩略图的地方替换修改。</p><p></p></div>
                                            <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=411#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-411', 411);">回复</a> <span class="t-g">2019-10-23 09:25 &nbsp;&nbsp;(Mac OS X 10.14.5&nbsp;/&nbsp;Google Chrome 77.0.3865.120)</span></span>
                                        </div><!-- 单条评论者信息及内容 -->
                                    </div>
                                    <div class="pl-list comment-children">
                                        <ol class="comment-list">
                                            <li id="li-comment-413" class="comment-body comment-child comment-level-even comment-odd">
                                                <div id="comment-413" class="pl-dan comment-txt-box">
                                                    <div class="t-p comment-author">
                                                        <img class="avatar" src="https://secure.gravatar.com/avatar/d8e56b76a663487445ef68989753e7b2?s=40&amp;r=G&amp;d=" alt="liwenbus" width="40" height="40">        </div>
                                                    <div class="t-u comment-author">
                                                        <strong>
                                                            liwenbus                <span class="layui-badge"></span>
                                                        </strong>
                                                        <div><b><a href="#comment-411">@宁采陈</a></b></div>
                                                        <div class="t-s"><p></p><p>好的，我试试，谢谢啦</p><p></p></div>
                                                        <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=413#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-413', 413);">回复</a> <span class="t-g">2019-10-23 12:00 &nbsp;&nbsp;(Windows 10 x64 Edition&nbsp;/&nbsp;Google Chrome 77.0.3865.90)</span></span>
                                                    </div><!-- 单条评论者信息及内容 -->
                                                </div>
                                            </li>

                                        </ol>        </div>
                                </li>


                                <li id="li-comment-404" class="comment-body comment-child comment-level-odd comment-odd">
                                    <div id="comment-404" class="pl-dan comment-txt-box">
                                        <div class="t-p comment-author">
                                            <img class="avatar" src="https://secure.gravatar.com/avatar/6cbd6bad82f8739d1a41318c434eb0cc?s=40&amp;r=G&amp;d=" alt="zbxm" width="40" height="40">        </div>
                                        <div class="t-u comment-author">
                                            <strong>
                                                <a href="http://zhengbanxianmian.com" rel="external nofollow">zbxm</a>                <span class="layui-badge"></span>
                                            </strong>
                                            <div><b><a href="#comment-403">@zbxm</a></b></div>
                                            <div class="t-s"><p></p><p>我搜不到如何显示这个自定义添加缩略图~</p><p></p></div>
                                            <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=404#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-404', 404);">回复</a> <span class="t-g">2019-10-18 10:18 &nbsp;&nbsp;(Windows 10 x64 Edition&nbsp;/&nbsp;Google Chrome 77.0.3865.90)</span></span>
                                        </div><!-- 单条评论者信息及内容 -->
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </li>






                    <li id="li-comment-278" class="comment-body comment-parent comment-odd">
                        <div id="comment-278" class="pl-dan comment-txt-box">
                            <div class="t-p comment-author">
                                <img class="avatar" src="https://secure.gravatar.com/avatar/487f87505f619bf9ea08f26bb34f8118?s=40&amp;r=G&amp;d=" alt="有课" width="40" height="40">        </div>
                            <div class="t-u comment-author">
                                <strong>
                                    有课                <span class="layui-badge"></span>
                                </strong>
                                <div><b></b></div>
                                <div class="t-s"><p></p><p>前排支持</p><p></p></div>
                                <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=278#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-278', 278);">回复</a> <span class="t-g">2019-08-23 12:09 &nbsp;&nbsp;(Android 9&nbsp;/&nbsp;Google Chrome 67.0.3396.87)</span></span>
                            </div><!-- 单条评论者信息及内容 -->
                        </div>
                    </li>


                    <li id="li-comment-267" class="comment-body comment-parent comment-even">
                        <div id="comment-267" class="pl-dan comment-txt-box">
                            <div class="t-p comment-author">
                                <img class="avatar" src="https://secure.gravatar.com/avatar/be213e12192a2dba08f3d98863e1e5c0?s=40&amp;r=G&amp;d=" alt="BIO" width="40" height="40">        </div>
                            <div class="t-u comment-author">
                                <strong>
                                    <a href="https://jocry.com" rel="external nofollow">BIO</a>                <span class="layui-badge"></span>
                                </strong>
                                <div><b></b></div>
                                <div class="t-s"><p></p><p>dalao.归档页无限长条可以限定多少条折叠吗？</p><p></p></div>
                                <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=267#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-267', 267);">回复</a> <span class="t-g">2019-08-22 15:54 &nbsp;&nbsp;(Windows 7 x64 Edition&nbsp;/&nbsp;Google Chrome 74.0.3729.169)</span></span>
                            </div><!-- 单条评论者信息及内容 -->
                        </div>
                        <div class="pl-list comment-children">
                            <ol class="comment-list">
                                <li id="li-comment-281" class="comment-body comment-child comment-level-odd comment-odd comment-by-author">
                                    <div id="comment-281" class="pl-dan comment-txt-box">
                                        <div class="t-p comment-author">
                                            <img class="avatar" src="https://secure.gravatar.com/avatar/108e214ad25b4d5050cfee16bb9bac44?s=40&amp;r=G&amp;d=" alt="宁采陈" width="40" height="40">        </div>
                                        <div class="t-u comment-author">
                                            <strong>
                                                <a href="https://www.echo.so" rel="external nofollow">宁采陈</a>                <span class="layui-badge">博主</span>
                                            </strong>
                                            <div><b><a href="#comment-267">@BIO</a></b></div>
                                            <div class="t-s"><p></p><p>你好，归档页就是为了方便查询、阅读文章，一目了然。最近看到几个几年的老博客也是长长的一页，也没做折叠。所以不打算做折叠了，等有空再做个新的紧凑点的归档页吧。</p><p></p></div>
                                            <span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=281#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-281', 281);">回复</a> <span class="t-g">2019-08-23 23:15 &nbsp;&nbsp;(Mac OS X 10.14.3&nbsp;/&nbsp;Google Chrome 76.0.3809.100)</span></span>
                                        </div><!-- 单条评论者信息及内容 -->
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="page-navigator">
                <div class="layui-laypage layui-laypage-molv">
                    <a href="https://www.echo.so/life/41.html/comment-page-1#comments" class="current">1</a>
                    <a href="https://www.echo.so/life/41.html/comment-page-2#comments">2</a>
                    <span>...</span>
                    <a href="https://www.echo.so/life/41.html/comment-page-4#comments">4</a>
                    <a href="https://www.echo.so/life/41.html/comment-page-2#comments" class="next">»</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function renderComment(data) {
            var html = '';
            $.each(data, function (key, val) {
                html += '<li id="li-comment-418" class="comment-body comment-parent comment-even">';
                html += '<div id="comment-418" class="pl-dan comment-txt-box">';
                html += '<div class="t-p comment-author">';
                html += '<img class="avatar" src="https://secure.gravatar.com/avatar/072d588effb06043854f7f3b79e2a333?s=40&amp;r=G&amp;d=" alt="居然。" width="40" height="40">';
                html += '</div>';
                html += '<div class="t-u comment-author">';
                html += '<strong>';
                html += '<a href="https://www.dyit6.cn" rel="external nofollow">居然。</a>';
                html += '<span class="layui-badge"></span>';
                html += '</strong>';
                html += '<div><b></b></div>';
                html += '<div class="t-s"><p></p><p>我又来提问了：<br>   首页文章不显示文章里的图片。<br>   这是嘛问题阿。我开始用了图床里的图片显示不出来，然后我又用了本里服务器的图片还是显示不出来。</p><p></p></div>';
                html += '<span class="t-btn"><a href="https://www.echo.so/life/41.html/comment-page-1?replyTo=418#respond-post-41" rel="nofollow" onclick="return TypechoComment.reply('comment-418', 418);">回复</a> <span class="t-g">2019-10-24 13:03 &nbsp;&nbsp;(Windows 10 x64 Edition&nbsp;/&nbsp;Google Chrome 77.0.3865.120)</span></span>';
                html += '</div>';
                html += '</div>';
                html += '</li>';
                html += '';
            });

            return html;
        }

        layui.use(['laypage'], function () {
            var laypage = layui.laypage;
            var $ = layui.$;
            //总页数大于页码总数
            laypage.render({
                elem: 'pinlun'
                ,count: 70 //数据总数
                ,groups: 3
                ,prev: '<i class="layui-icon layui-icon-left"></i>'
                ,next: '<i class="layui-icon layui-icon-right"></i>'
                ,jump: function(obj, first){
                    $.ajax({
                        method: "post",
                        url: "{{route('frontend::comment.paginate')}}",
                        data: {resource: 'article', article_id: 98},
                        success: function (res) {
                            var html = '';
                            html += '<ol class="comment-list">';
                            html += renderComment(res.data);
                            html += '</ol>';
                            console.log(html);

                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {

                            return false;
                        }
                    });
                }
            });
        });
    </script>
@endsection