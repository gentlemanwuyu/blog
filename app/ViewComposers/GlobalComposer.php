<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/1
 * Time: 18:16
 */

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;

class GlobalComposer
{
    public function compose(View $view)
    {
        // 每个模板都带着所有的请求参数
        $view->with(request()->all());
    }
}