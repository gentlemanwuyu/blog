<?php
namespace App\Modules\Frontend\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class FrontendServiceProvider extends ServiceProvider
{
	/**
	 * Register the Frontend module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Frontend\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Frontend module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('frontend', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('frontend', base_path('resources/views/vendor/frontend'));
		View::addNamespace('frontend', realpath(__DIR__.'/../Resources/Views'));
	}
}
