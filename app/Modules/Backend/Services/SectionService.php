<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/8
 * Time: 16:04
 */

namespace App\Modules\Backend\Services;

use App\Modules\Backend\Models\Section;

class SectionService
{
    public function __construct()
    {

    }

    public function paginate($request)
    {
        return Section::orderBy('id', 'desc')->paginate($request->get('limit'));
    }

    /**
     * 创建/修改版块
     *
     * @param $request
     * @return array
     */
    public function createOrUpdateSection($request)
    {
        try {
            $data = [
                'name' => $request->get('name'),
            ];

            Section::updateOrCreate(['id' => $request->get('section_id')], $data);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 删除版块
     *
     * @param $id
     * @return array
     */
    public function deleteSection($id)
    {
        try {
            $section = Section::find($id);

            $section->delete();

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}