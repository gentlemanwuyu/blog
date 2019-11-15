<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/8
 * Time: 18:00
 */

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use Carbon\Carbon;
use App\Modules\Backend\Models\Label;
use App\Modules\Backend\Models\Section;
use App\Modules\Backend\Models\Friendlink;
use App\Modules\Backend\Models\SystemConfig;

class FrontComposer
{
    public function compose(View $view)
    {
        $system_configs = array_column(SystemConfig::all()->toArray(), 'value', 'name');

        if ('frontend::layouts.header' == $view->name()) {
            $view->with([
                'blog_name' => isset($system_configs['name']) ? $system_configs['name'] : '',
                'navs' => $this->handleNavs(),
            ]);
        }
        if ('frontend::layouts.sidebar' == $view->name()) {
            $view->with([
                'friendlinks' => Friendlink::all(['name', 'link', 'desc'])->toArray(),
                'labels' => $this->handleLabels(),
            ]);
        }
        if ('frontend::layouts.footer' == $view->name()) {
            $view->with([
                'year_interval' => 2019 == Carbon::now()->year ? 2019 : '2019~' . Carbon::now()->year,
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
            $navs[] = ['title' => $section->name, 'url' => route('frontend::section.index', ['id' => $section->id], false)];
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

    protected function handleLabels()
    {
        $labels = Label::all(['id', 'name']);

        return $labels->toArray();
    }
}