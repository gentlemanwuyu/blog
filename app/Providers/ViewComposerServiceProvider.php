<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/1
 * Time: 18:14
 */

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\ViewComposers\GlobalComposer;
use App\ViewComposers\AdminComposer;
use App\ViewComposers\FrontComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', GlobalComposer::class);
        View::composer(['backend::layouts.default'], AdminComposer::class);
        View::composer(['frontend::layouts.header'], FrontComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}