<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/1
 * Time: 19:32
 */

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;

class AdminComposer
{
    public function compose(View $view)
    {
        if ('backend::layouts.default' == $view->name()) {
            $view->with([
                'navs' => $this->handleNavs(),
            ]);
        }
    }

    protected function handleNavs()
    {
        $current_uri = '/' . trim(request()->path(), '/');
        $navs = json_decode(json_encode(config('navs')));

        foreach ($navs as $nav) {
            if (!empty($nav->children)) {
                foreach ($nav->children as $sub_nav) {
                    if ($current_uri == $sub_nav->link) {
                        $sub_nav->active = true;
                        $nav->active = true;
                        break;
                    }
                }
            }elseif ($current_uri == $nav->link) {
                $nav->active = true;
            }
        }

        return $navs;
    }
}