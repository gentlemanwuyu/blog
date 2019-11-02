<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/2
 * Time: 15:30
 */

namespace App\Modules\Backend\Services;

use App\Modules\Backend\Models\SystemConfig;

class SystemService
{
    public function __construct()
    {

    }

    /**
     * 保存配置
     *
     * @param $configs
     * @return array
     */
    public function saveConfig($configs)
    {
        try {
            foreach ($configs as $name => $value) {
                SystemConfig::updateOrCreate(['name' => $name], ['name' => $name, 'value' => $value]);
            }

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}