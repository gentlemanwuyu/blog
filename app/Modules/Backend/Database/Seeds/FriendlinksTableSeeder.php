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
        Friendlink::create(['name' => '宁采陈', 'link' => 'https://www.echo.so/']);
        Friendlink::create(['name' => '欣汉生', 'link' => 'http://www.hspcb168.com/']);
        Friendlink::create(['name' => '睿程科技', 'link' => 'https://www.raytrend.com/']);
        Friendlink::create(['name' => '百度', 'link' => 'https://www.baidu.com/']);
        Friendlink::create(['name' => '腾讯网', 'link' => 'https://www.qq.com/']);
        Friendlink::create(['name' => '京东', 'link' => 'https://www.jd.com/']);
    }
}