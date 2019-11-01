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
            $item['name'] = $category->name;
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
            if ($request->get('parent_id')) {
                $data['parent_id'] = $request->get('parent_id');
                $parent_category = Category::find($request->get('parent_id'));
                if (!$parent_category) {
                    throw new \Exception("找不到父分类[" . $request->get('parent_id') . "]");
                }
                $data['section_id'] = $parent_category->section_id;
            }

            Category::updateOrCreate(['id' => $request->get('category_id')], $data);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 删除分类
     *
     * @param $id
     * @return array
     */
    public function deleteCategory($id)
    {
        try {
            $category = Category::find($id);

            if (!$category->children->isEmpty()) {
                throw new \Exception("该分类下还有子分类，不能删除");
            }

            // TODO: 判断分类下是否含有文章

            $category->delete();

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}