<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/15
 * Time: 20:47
 */

namespace App\Modules\Backend\Services;

use Illuminate\Support\Facades\Log;
use App\Modules\Backend\Models\Visitor;

class VisitorService
{
    public function __construct()
    {

    }

    /**
     * 记录上报数据
     *
     * @param $request
     * @return array
     */
    public function track($request)
    {
        try {
            Visitor::create([
                'ip' => $request->getClientIp(),
                'url' => $request->get('url'),
                'device' => $request->get('device'),
            ]);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            Log::error('数据上报失败:' . $e->getMessage());
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}