<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/8
 * Time: 18:00
 */

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Modules\Backend\Models\Section;
use App\Modules\Backend\Models\SystemConfig;

class FrontComposer
{
    public function compose(View $view)
    {
        $system_configs = array_column(SystemConfig::all()->toArray(), 'value', 'name');

        if ('frontend::layouts.header' == $view->name()) {
            $view->with([
                'blog_name' => $system_configs['name'],
                'navs' => $this->handleNavs(),
            ]);
        }
    }

    protected function handleNavs()
    {
        $current_uri = '/' . trim(request()->path(), '/');

        $navs = [];
        $navs[] = ['title' => '首页', 'url' => '/'];
        $sections = Section::all();
        foreach ($sections as $section) {
            $navs[] = ['title' => $section->name, 'url' => '#'];
        }
        $navs[] = ['title' => '关于', 'url' => '/about.html'];

        foreach ($navs as $key => $nav) {
            if ($current_uri == $nav['url']) {
                $nav['active'] = true;
            }
            $navs[$key] = $nav;
        }

        return $navs;
    }
}