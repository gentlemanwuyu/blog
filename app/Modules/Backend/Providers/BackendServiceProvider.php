<?php
namespace App\Modules\Backend\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
	/**
	 * Register the Backend module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Backend\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Backend module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('backend', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('backend', base_path('resources/views/vendor/backend'));
		View::addNamespace('backend', realpath(__DIR__.'/../Resources/Views'));
	}
}
