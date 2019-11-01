<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/1
 * Time: 11:57
 */

namespace App\Modules\Backend\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Backend\Models\Label;

class LabelsTableSeeder extends Seeder
{
    public function run()
    {
        Label::create(['name' => 'PHP']);
        Label::create(['name' => 'Mysql']);
        Label::create(['name' => 'Nginx']);
        Label::create(['name' => 'Linux']);
        Label::create(['name' => 'Python']);
        Label::create(['name' => '风生水起']);
        Label::create(['name' => '股票']);
        Label::create(['name' => '技术分析']);
    }
}