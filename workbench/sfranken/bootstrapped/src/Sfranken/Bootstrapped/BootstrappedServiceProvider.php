<?php namespace Sfranken\Bootstrapped;

use Illuminate\Support\ServiceProvider;

class BootstrappedServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('sfranken/bootstrapped');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{	
		$this->app->booting(function() {
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Bootstrapped', 'Sfranken\Bootstrapped\Facades\Bootstrapped');
		});

		$this->app['bootstrapped'] = $this->app->share(function($app) {
			return new Bootstrapped();
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('bootstrapped');
	}

}
