<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/15
 * Time: 20:47
 */

namespace App\Modules\Backend\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
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
            $data = [
                'ip' => $request->getClientIp(),
                'url' => $request->get('url'),
                'referer' => $request->get('referer'),
                'device' => $request->get('device'),
            ];

            $request = Request::create($data['url']);
            $route = Route::getRoutes()->match($request);

            if (!$request || !$route) {
                throw new \Exception("Url匹配路由失败");
            }

            $data['route_name'] = $route->getName();
            $data['query_string'] = $request->server('QUERY_STRING');

            switch ($data['route_name']) {
                case 'frontend::article.detail':
                    $data['article_id'] = $route->parameter('id');
                    break;

                case 'frontend::section.index':
                    $data['section_id'] = $route->parameter('id');
                    break;

                case 'frontend::category.index':
                    $data['category_id'] = $route->parameter('id');
                    break;
            }

            Visitor::create($data);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            Log::error('数据上报失败:' . $e->getMessage());
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}