<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/2
 * Time: 16:58
 */

namespace App\Modules\Backend\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Backend\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        $comment = Comment::create([
            'article_id' => 0,
            'content' => '模板非常漂亮，请问博客，留言页面和广告位怎么操作啊，还有如何把关于改为about.html',
            'username' => '盖壮实',
            'email' => '492444775@qq.com',
            'link' => 'https://www.woozee.com.cn/',
            'parent_id' => 0,
        ]);

        Comment::create([
            'article_id' => 0,
            'content' => '留言页面：后台-创建页面。关于改为about.html，在创建页面的时候，标题下方有个设置链接缩略名的。',
            'username' => '宁采陈',
            'email' => '492444775@qq.com',
            'link' => 'https://www.woozee.com.cn/',
            'parent_id' => $comment->id,
        ]);

        $comment = Comment::create([
            'article_id' => 0,
            'content' => '小哥，你的站点可以申请google adsense了。',
            'username' => '天使漫步',
            'email' => '492444775@qq.com',
            'link' => 'https://www.woozee.com.cn/',
            'parent_id' => 0,
        ]);

        $comment = Comment::create([
            'article_id' => 0,
            'content' => '每天只有百来个ip，应该也没什么收益。试试看吧。',
            'username' => '宁采陈',
            'email' => '492444775@qq.com',
            'link' => 'https://www.woozee.com.cn/',
            'parent_id' => $comment->id,
        ]);

        $comment = Comment::create([
            'article_id' => 0,
            'content' => '我擦，你在南宁啊。',
            'username' => '天使漫步',
            'email' => '492444775@qq.com',
            'link' => 'https://www.woozee.com.cn/',
            'parent_id' => $comment->id,
        ]);

        Comment::create([
            'article_id' => 0,
            'content' => '嗯，在南宁。',
            'username' => '宁采陈',
            'email' => '492444775@qq.com',
            'link' => 'https://www.woozee.com.cn/',
            'parent_id' => $comment->id,
        ]);
    }
}