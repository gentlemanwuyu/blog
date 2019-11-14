<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/10/31
 * Time: 15:57
 */

namespace App\Modules\Backend\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * 获取分类树
     *
     * @param $section_id
     * @param int $parent_id
     * @return array
     */
    public static function getTree($section_id, $parent_id = 0)
    {
        $tree = [];
        $categories = self::where('section_id', $section_id)->where('parent_id', $parent_id)->get();
        foreach ($categories as $category) {
            $item = [];
            $item['id'] = $category->id;
            $item['name'] = $category->name;
            $subs = self::getTree($section_id, $category->id);
            if ($subs) {
                $item['children'] = $subs;
            }
            $tree[] = $item;
        }

        return $tree;
    }
}