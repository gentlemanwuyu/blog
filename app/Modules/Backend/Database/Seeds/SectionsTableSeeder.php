<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/8
 * Time: 15:56
 */

namespace App\Modules\Backend\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Backend\Models\Section;

class SectionsTableSeeder extends Seeder
{
    public function run()
    {
        Section::create(['name' => '码农']);
        Section::create(['name' => '股民']);
    }
}