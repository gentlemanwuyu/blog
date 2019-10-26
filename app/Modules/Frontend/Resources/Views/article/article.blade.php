@extends('frontend::layouts.default')
@section('content')
    <div class="title-article">
        <h1>本站 Typecho 主题 Echo 开源啦！【又更新啦！】(更新至V1.3.1)</h1>
        <div class="title-msg">
            <span><i class="layui-icon">&#xe612;</i>吴宇</span>
            <span><i class="layui-icon">&#xe60e;</i>2019-06-28 PM</span>
            <span><i class="layui-icon">&#xe62c;</i>6580℃</span>
            <span><i class="layui-icon">&#xe63a;</i>143条</span>
        </div>
    </div>
    <div class="text" itemprop="articleBody">
        <div id="md_content_2" class="md_content markdown-body editormd-html-preview" style="min-height: 50px;"><blockquote>
                <p>最近有好多人问我博客主题开不开源，这几天又刚好发现了好几个在仿我主题的。趴站多累啊，是吧！所以还是抽空整理一下发布出来给大家使用吧。</p>
            </blockquote>
            <p><img src="https://www.echo.so/typecho-echo.png" alt=""></p>
            <h4 id="h4--echo-"><a name="主题名为 Echo，取自本站域名。主题极简美观，并进行了响应式布局，使博客在手机和平板电脑上也有更好的浏览阅读体验。" class="reference-link"></a><span class="header-link octicon octicon-link"></span>主题名为 Echo，取自本站域名。主题极简美观，并进行了响应式布局，使博客在手机和平板电脑上也有更好的浏览阅读体验。</h4><p>欢迎大家下载使用！</p>
            <p>下载地址：<a href="https://www.echo.so/echo.zip" title="主题下载">主题下载</a></p>
            <p>最后，希望使用者保留底部主题名称链接，谢谢！</p>
            <h3 id="h3--github-star-star-"><a name="源码已提交至GitHub上，欢迎star:star:。" class="reference-link"></a><span class="header-link octicon octicon-link"></span>源码已提交至GitHub上，欢迎star<img src="//cdn.staticfile.org/emoji-cheat-sheet/1.0.0/star.png" class="emoji" title=":star:" alt=":star:">。</h3><p><a href="https://github.com/yunfeilangwu/echo">https://github.com/yunfeilangwu/echo</a></p>
            <hr>
            <h3 id="h3--"><a name="常见问题：" class="reference-link"></a><span class="header-link octicon octicon-link"></span>常见问题：</h3><p>Q:博主动态和归档是如何设置的？</p>
            <p>A:</p>
            <p>归档页面：后台创建独立页面，自定义模板选择[文章归档]。</p>
            <p>博主动态：后台创建独立页面，自定义模板选择[说说动态]。成功创建后，前台访问该页面，可以进行发布动态。发布框只有博主登录的情况下才会显示。</p>
            <p>Q：博客网站怎么设置logo图片？</p>
            <p>A：在后台-控制台-外观，启用该主题后。点击切换到[设置外观]栏，进行设置。</p>
            <h3 id="h3--v1-3"><a name="版本：V1.3" class="reference-link"></a><span class="header-link octicon octicon-link"></span>版本：V1.3</h3><h4 id="h4--"><a name="更新记录：" class="reference-link"></a><span class="header-link octicon octicon-link"></span>更新记录：</h4><p>V1.2.0 - 2019-7-25： 添加说说动态页，侧边栏增加博主动态和友情链接块。</p>
            <p>V1.2.1 - 2019-7-25： 修复侧边栏博主动态不显示动态列表问题。</p>
            <p>V1.2.2 - 2019-8-03： 修复评论Undefined variable: group in报错问题。</p>
            <p>V1.3.0 - 2019-8-15： </p>
            <p>1、增加外观设置，可设置网站logo。</p>
            <p>2、添加上搜索和标签页底部内容。</p>
            <p>3、增加友情链接小tips功能。</p>
            <p>4、导航栏菜单间距调整。</p>
            <p>5、文章图片居中显示。</p>
            <p>6、文章图片可以点击查看原图。</p>
            <p>V1.3.1 - 2019-8-21： </p>
            <p>1、禁止了移动端点击图片查看原图。</p>
            <p>2、增加了返回顶部功能。</p>
            <p>3、文章行间距调整、并兼容了系统默认markdown排版样式。</p>
            <p>4、修复移动端评论内容英文超出显示问题。</p>
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
        <div>
            <span class="layui-badge layui-bg-gray">上一篇</span>
            mysqldump: Got error: 1044: ***when using LOCK TABLES解决方法
        </div>
        <div>
            <span class="layui-badge layui-bg-gray">下一篇</span>
            Typecho 评论 Emoji 表情报错 Database Query Error 解决方案！
        </div>
    </div>
    @include('frontend::layouts.comments')
@endsection