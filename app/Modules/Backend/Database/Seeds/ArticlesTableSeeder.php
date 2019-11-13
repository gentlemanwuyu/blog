<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/5
 * Time: 17:08
 */

namespace App\Modules\Backend\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Backend\Models\Article;
use App\Modules\Backend\Models\ArticleLabel;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        $article = Article::create([
            'title' => 'Ubuntu18.04更换国内源',
            'keywords' => 'ubuntu,国内源',
            'content' => '<p>打开/etc/apt/sources.list</p>
<pre class="language-markup"><code>vi /etc/apt/sources.list</code></pre>
<p>将原有的数据注释掉，换上国内镜像</p>
<p>阿里云源</p>
<pre class="language-markup"><code>deb http://mirrors.aliyun.com/ubuntu/ bionic main restricted universe multiverse
deb http://mirrors.aliyun.com/ubuntu/ bionic-security main restricted universe multiverse
deb http://mirrors.aliyun.com/ubuntu/ bionic-updates main restricted universe multiverse
deb http://mirrors.aliyun.com/ubuntu/ bionic-proposed main restricted universe multiverse
deb http://mirrors.aliyun.com/ubuntu/ bionic-backports main restricted universe multiverse
deb-src http://mirrors.aliyun.com/ubuntu/ bionic main restricted universe multiverse
deb-src http://mirrors.aliyun.com/ubuntu/ bionic-security main restricted universe multiverse
deb-src http://mirrors.aliyun.com/ubuntu/ bionic-updates main restricted universe multiverse
deb-src http://mirrors.aliyun.com/ubuntu/ bionic-proposed main restricted universe multiverse
deb-src http://mirrors.aliyun.com/ubuntu/ bionic-backports main restricted universe multiverse</code></pre>
<p>清华源</p>
<pre class="language-markup"><code>deb https://mirrors.tuna.tsinghua.edu.cn/ubuntu/ bionic main restricted universe multiverse
deb https://mirrors.tuna.tsinghua.edu.cn/ubuntu/ bionic-updates main restricted universe multiverse
deb https://mirrors.tuna.tsinghua.edu.cn/ubuntu/ bionic-backports main restricted universe multiverse
deb https://mirrors.tuna.tsinghua.edu.cn/ubuntu/ bionic-security main restricted universe multiverse
deb https://mirrors.tuna.tsinghua.edu.cn/ubuntu/ bionic-proposed main restricted universe multiverse
deb-src https://mirrors.tuna.tsinghua.edu.cn/ubuntu/ bionic main restricted universe multiverse
deb-src https://mirrors.tuna.tsinghua.edu.cn/ubuntu/ bionic-updates main restricted universe multiverse
deb-src https://mirrors.tuna.tsinghua.edu.cn/ubuntu/ bionic-backports main restricted universe multiverse
deb-src https://mirrors.tuna.tsinghua.edu.cn/ubuntu/ bionic-security main restricted universe multiverse
deb-src https://mirrors.tuna.tsinghua.edu.cn/ubuntu/ bionic-proposed main restricted universe multiverse</code></pre>
<p>中科大源</p>
<pre class="language-markup"><code>deb https://mirrors.ustc.edu.cn/ubuntu/ bionic main restricted universe multiverse
deb https://mirrors.ustc.edu.cn/ubuntu/ bionic-updates main restricted universe multiverse
deb https://mirrors.ustc.edu.cn/ubuntu/ bionic-backports main restricted universe multiverse
deb https://mirrors.ustc.edu.cn/ubuntu/ bionic-security main restricted universe multiverse
deb https://mirrors.ustc.edu.cn/ubuntu/ bionic-proposed main restricted universe multiverse
deb-src https://mirrors.ustc.edu.cn/ubuntu/ bionic main restricted universe multiverse
deb-src https://mirrors.ustc.edu.cn/ubuntu/ bionic-updates main restricted universe multiverse
deb-src https://mirrors.ustc.edu.cn/ubuntu/ bionic-backports main restricted universe multiverse
deb-src https://mirrors.ustc.edu.cn/ubuntu/ bionic-security main restricted universe multiverse
deb-src https://mirrors.ustc.edu.cn/ubuntu/ bionic-proposed main restricted universe multiverse</code></pre>
<p>更改完成之后执行以下命令</p>
<pre class="language-markup"><code>apt update
apt upgrade</code></pre>',
            'summary' => 'Ubuntu18.04如何将apt的源更换为国内源，打开/etc/apt/sources.list，将源更新为阿里云源、清华源、中科大源，更新完文件之后，执行apt update和apt upgrade',
            'category_id' => 4,
            'section_id' => 1,
        ]);
        ArticleLabel::create([
            'article_id' => $article->id,
            'label_id' => 4,
        ]);

        $article = Article::create([
            'title' => '解决点击Docker出现windows 正在查找bash.exe。如果想亲自查找文件，请点击“浏览”的问题',
            'keywords' => 'docker,windows,bash.exe',
            'content' => '<p>window7下安装DockerToolbox时，安装成功后，双击桌面的Docker Quickstart Terminal快捷方式，会出现以下弹框：</p>
<p><img src="../../storage/images/article/5dc13a14935c3.png" alt="" /></p>
<p>&nbsp;</p>
<p>&nbsp;可以猜测到时快捷方式所指定的路径不对（因为本人在安装Docker前已经安装好git了，原因就出在这）。</p>
<h3>解决方法</h3>
<p>邮件点击这个图标，点击属性，出现下面的图：</p>
<p><img src="../../storage/images/article/5dc13a14e0862.png" alt="" /></p>
<p>&nbsp;</p>
<p>&nbsp;在&nbsp;目标&nbsp;这一个选项处需要填写正确的 Git bash.exe文件位置来启动docker star.sh文件。我的git安装在D:\Git下，Docker Toolbox安装在C盘。所以我这里写的是：</p>
<div class="cnblogs_Highlighter sh-gutter">
<div id="highlighter_506906" class="syntaxhighlighter  bash">
<pre class="language-markup"><code>"D:\Git\bin\bash.exe" --login -i "D:\Docker Toolbox\start.sh"</code></pre>
</div>
</div>
<p>　　大家可以根据自己的安装配置来调整这块的执行语句。</p>
<p>修改完毕点击引用、确定，再双击图标即可。</p>',
            'summary' => 'window7下安装DockerToolbox时，安装成功后，双击桌面的Docker Quickstart Terminal快捷方式，会出现以下弹框：Windows 正在查找bash.exe。如果想亲自查找文件，请单击“浏览”。',
            'category_id' => 4,
            'section_id' => 1,
        ]);
        ArticleLabel::create([
            'article_id' => $article->id,
            'label_id' => 4,
        ]);



        $article = Article::create([
            'title' => 'mysql服务设置远程连接 解决1251 client does not support ..问题',
            'keywords' => 'mysql,远程连接,1251',
            'content' => '<div id="cnblogs_post_body" class="blogpost-body ">
<p>在navicat中连接虚拟机中的MySQL数据库时出现以下报错：</p>
<p><img src="../../storage/images/article/5dc13b19061f6.png" alt="" /></p>
<p>1、查看用户信息</p>
<div class="cnblogs_Highlighter sh-gutter">
<div id="highlighter_912122" class="syntaxhighlighter  sql">
<pre class="language-markup"><code>select Host,User,plugin,authentication_string from mysql.user ;</code></pre>
</div>
</div>
<p><img src="../../storage/images/article/5dc13b194eed9.png" alt="" /></p>
<p>&nbsp;</p>
<p>&nbsp;备注：host为%表示不限制ip,localhost表示本机使用,plugin非mysql_native_password则需要修改密码</p>
<p>2、修改用户密码</p>
<div class="cnblogs_Highlighter sh-gutter">
<div id="highlighter_638417" class="syntaxhighlighter  sql">
<pre class="language-markup"><code>ALTER USER \'root\'@\'%\' IDENTIFIED WITH mysql_native_password BY \'newpassword\';&lt;br&gt;FLUSH PRIVILEGES;</code></pre>
</div>
</div>
<p>注：这里可能会碰到以下报错：</p>
<div class="cnblogs_Highlighter sh-gutter">
<div id="highlighter_979812" class="syntaxhighlighter  bash">
<pre class="language-markup"><code>ALTER USER \'root\'@\'%\' IDENTIFIED WITH mysql_native_password BY \'newpassword\';&lt;br&gt;FLUSH PRIVILEGES;</code></pre>
</div>
</div>
<p>解决办法：</p>
<p>查看mysql初始的密码策略：</p>
<div class="cnblogs_Highlighter sh-gutter">
<div id="highlighter_769786" class="syntaxhighlighter  bash">
<pre class="language-markup"><code>SHOW VARIABLES LIKE \'validate_password%\';</code></pre>
</div>
</div>
<p><img src="../../storage/images/article/5dc13b19954a2.png" alt="" /></p>
<p>&nbsp;</p>
<p>&nbsp;需要设置密码的验证强度等级，设置 validate_password_policy 的全局参数为 LOW 即可</p>
<div class="cnblogs_Highlighter sh-gutter">
<div id="highlighter_832307" class="syntaxhighlighter  bash">
<pre class="language-markup"><code>SET GLOBAL validate_password_policy = LOW;</code></pre>
</div>
</div>
<p><img src="../../storage/images/article/5dc13b19e1fc5.png" alt="" /></p>
<p>&nbsp;</p>
</div>',
            'summary' => '在navicat中连接虚拟机中的MySQL数据库时出现以下报错：1251 - Client does not support authentication protocol requested by server;consider upgrading MySQL client',
            'category_id' => 3,
            'section_id' => 1,
        ]);
        ArticleLabel::create([
            'article_id' => $article->id,
            'label_id' => 2,
        ]);
        ArticleLabel::create([
            'article_id' => $article->id,
            'label_id' => 4,
        ]);
    }
}