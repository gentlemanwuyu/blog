<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/1
 * Time: 17:07
 */

namespace App\Modules\Backend\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Backend\Models\Friendlink;

class FriendlinksTableSeeder extends Seeder
{
    public function run()
    {
        Friendlink::create(['name' => '宁采陈', 'link' => 'https://www.echo.so/', 'desc' => '宁采陈的网站']);
        Friendlink::create(['name' => '欣汉生', 'link' => 'http://www.hspcb168.com/', 'desc' => '欣汉生的网站']);
        Friendlink::create(['name' => '睿程科技', 'link' => 'https://www.raytrend.com/', 'desc' => '睿程科技的网站']);
        Friendlink::create(['name' => '百度', 'link' => 'https://www.baidu.com/', 'desc' => '百度的网站']);
        Friendlink::create(['name' => '腾讯网', 'link' => 'https://www.qq.com/', 'desc' => '腾讯网的网站']);
        Friendlink::create(['name' => '京东', 'link' => 'https://www.jd.com/', 'desc' => '京东的网站']);
    }
}