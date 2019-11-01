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
        return Label::orderBy('updated_at', 'desc')->paginate($request->get('limit'));
    }

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
}