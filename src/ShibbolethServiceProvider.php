<?php namespace H3r2on\Shibboleth;

use Illuminate\Support\ServiceProvider;

/**
 *
 */
class ShibbolethServiceProvider extends ServiceProvider
{

	/**
	* Register bindings in the container.
	*
	* @return void
	*/
	public function register()
	{

		$this->app['auth']->extend('shibboleth', function($app){
			return new Providers\ShibbolethUserProvider($app['hash'], $this->app['config']['auth.model']);
		});

	}

	/**
 * Perform post-registration booting of services.
 *
 * @return void
 */
	public function boot()
	{

		// publish our config file
		$this->publishes([
			__DIR__ . '/../config/config.php' => config_path('shibboleth.php')
		], 'config');

		$this->publishes([
			__DIR__ . '/../database/migrations/' => database_path('migrations')
		], 'migrations');

		// load our package specific routes
		if(! $this->app->routesAreCached()) {
			require __DIR__ . '/Http/routes.php';
		}
	}
}
