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
        return Label::paginate($request->get('limit'));
    }
}