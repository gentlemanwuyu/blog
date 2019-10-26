@extends('frontend::layouts.default')
@section('content')
    <div class="title-article text-center">
        <h1>关于</h1>
    </div>
    <div class="text" itemprop="articleBody">
        <div id="md_content_2" class="md_content markdown-body editormd-html-preview" style="min-height: 50px;"><p>94年不甘现状而又无力改变的孤狼一条<img src="//cdn.staticfile.org/emoji-cheat-sheet/1.0.0/pensive.png" class="emoji" title=":pensive:" alt=":pensive:"></p>
            <h3 id="h3-u4E2Au4EBAu4FE1u606F"><a name="个人信息" class="reference-link"></a><span class="header-link octicon octicon-link"></span>个人信息</h3><ul>
                <li>昵称：宁采陈</li><li>职业：攻城狮</li><li>城市：大南宁</li></ul>
            <h3 id="h3-u5EFAu535Au521Du8877"><a name="建博初衷" class="reference-link"></a><span class="header-link octicon octicon-link"></span>建博初衷</h3><p>平常开发中经常会遇到一些问题难点,而好不容易解决之后，却懒得做笔记，所以常常隔一段时间后，相同或者相似的问题再重现时，又刚好把之前的解决方案忘得差不多了。常言道:”好记性不如烂笔头”确实如此，每当此时我都后悔当初没有记录下来，所以趁着五一放假时间还是抽空搭建了个博客出来，用作平常记录之用。希望此博给我提供便利之余，也能给大家一些或多或少的帮助！</p>
            <h3 id="h3-u8054u7CFBu65B9u5F0F"><a name="联系方式" class="reference-link"></a><span class="header-link octicon octicon-link"></span>联系方式</h3><p><a href="mailto:admin@echo.so">admin@echo.so</a></p>
        </div>
    </div>
    @include('frontend::layouts.comments')
@endsection