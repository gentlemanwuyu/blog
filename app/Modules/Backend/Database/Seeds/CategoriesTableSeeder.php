<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/31
 * Time: 15:55
 */

namespace App\Modules\Backend\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Backend\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $category = Category::create([
            'name' => 'PHP',
            'section_id' => 1,
        ]);
        Category::create([
            'name' => 'Laravel',
            'section_id' => 1,
            'parent_id' => $category->id,
        ]);
        $category = Category::create([
            'name' => 'Mysql',
            'section_id' => 1,
        ]);
        $category = Category::create([
            'name' => 'Linux',
            'section_id' => 1,
        ]);
        $category = Category::create([
            'name' => 'Nginx',
            'section_id' => 1,
        ]);
        $category = Category::create([
            'name' => 'Redis',
            'section_id' => 1,
        ]);
        $category = Category::create([
            'name' => '编辑器',
            'section_id' => 1,
        ]);
        Category::create([
            'name' => 'phpstorm',
            'section_id' => 1,
            'parent_id' => $category->id,
        ]);
        Category::create([
            'name' => 'sublime',
            'section_id' => 1,
            'parent_id' => $category->id,
        ]);
        $category = Category::create([
            'name' => '前端',
            'section_id' => 1,
        ]);
        Category::create([
            'name' => 'HTML',
            'section_id' => 1,
            'parent_id' => $category->id,
        ]);
        Category::create([
            'name' => 'CSS',
            'section_id' => 1,
            'parent_id' => $category->id,
        ]);
        Category::create([
            'name' => 'Jquery',
            'section_id' => 1,
            'parent_id' => $category->id,
        ]);
        $category = Category::create([
            'name' => 'Git',
            'section_id' => 1,
        ]);

        $category = Category::create([
            'name' => '个股研究',
            'section_id' => 2,
        ]);
        $category = Category::create([
            'name' => '大V原创',
            'section_id' => 2,
        ]);
        Category::create([
            'name' => '风生水起',
            'section_id' => 2,
            'parent_id' => $category->id,
        ]);
        Category::create([
            'name' => '闲来一坐s话投资',
            'section_id' => 2,
            'parent_id' => $category->id,
        ]);
        $category = Category::create([
            'name' => '投资周记',
            'section_id' => 2,
        ]);
    }
}