<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/1
 * Time: 13:54
 */

namespace App\Modules\Backend\Services;

use App\Modules\Backend\Models\Label;

class LabelService
{
    public function __construct()
    {

    }

    public function paginate($request)
    {
        return Label::orderBy('id', 'desc')->paginate($request->get('limit'));
    }

    /**
     * 创建/修改标签
     *
     * @param $request
     * @return array
     */
    public function createOrUpdateLabel($request)
    {
        try {
            $data = [
                'name' => $request->get('name'),
            ];

            Label::updateOrCreate(['id' => $request->get('label_id')], $data);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 删除标签
     *
     * @param $id
     * @return array
     */
    public function deleteLabel($id)
    {
        try {
            $label = Label::find($id);

            // TODO: 判断分类下是否含有文章

            $label->delete();

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}