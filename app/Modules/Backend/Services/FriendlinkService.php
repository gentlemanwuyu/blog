<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/1
 * Time: 17:17
 */

namespace App\Modules\Backend\Services;

use App\Modules\Backend\Models\Friendlink;

class FriendlinkService
{
    public function __construct()
    {

    }

    public function paginate($request)
    {
        return Friendlink::orderBy('id', 'desc')->paginate($request->get('limit'));
    }

    /**
     * 创建/修改友链
     *
     * @param $request
     * @return array
     */
    public function createOrUpdateFriendlink($request)
    {
        try {
            $data = [
                'name' => $request->get('name'),
                'link' => $request->get('link'),
            ];

            Friendlink::updateOrCreate(['id' => $request->get('friendlink_id')], $data);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 删除友链
     *
     * @param $id
     * @return array
     */
    public function deleteFriendlink($id)
    {
        try {
            Friendlink::find($id)->delete();

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}