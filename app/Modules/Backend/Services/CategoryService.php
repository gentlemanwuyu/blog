<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/10/27
 * Time: 22:24
 */

namespace App\Modules\Backend\Services;

use App\Modules\Backend\Models\Category;

class CategoryService
{
    public function __construct()
    {

    }

    /**
     * 获取分类树
     *
     * @param $section_id
     * @param int $parent_id
     * @return array
     */
    public function getTree($section_id, $parent_id = 0)
    {
        $tree = [];
        $categories = Category::where('section_id', $section_id)->where('parent_id', $parent_id)->get();
        foreach ($categories as $category) {
            $item = [];
            $item['id'] = $category->id;
            $item['text'] = $category->name;
            $subs = $this->getTree($section_id, $category->id);
            if ($subs) {
                $item['children'] = $subs;
            }
            $tree[] = $item;
        }

        return $tree;
    }

    /**
     * 创建/修改分类
     *
     * @return array
     */
    public function createOrUpdateCategory($request)
    {
        try {
            $data = [
                'name' => $request->get('name'),
            ];
            if ($request->get('section_id')) {
                $data['section_id'] = $request->get('section_id');
            }

            Category::updateOrCreate(['id' => $request->get('category_id')], $data);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}