<?php


namespace App\Http\Lib;


use App\Http\Middleware\Authenticate;
use App\Http\Middleware\Pjax;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'admin.auth'       => Authenticate::class,
		'admin.pjax'       => Pjax::class,
		'admin.bootstrap'  => Middleware\Bootstrap::class,
	];
	
	/**
	 * The application's route middleware groups.
	 *
	 * @var array
	 */
	protected $middlewareGroups = [
		'admin' => [
			'admin.auth',
			'admin.pjax',
			'admin.bootstrap',
		],
	];
	
	
	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
//		$this->loadViewsFrom(__DIR__.'/../resources/views', 'admin');
	
	}
	
	public function register()
	{
		
		$this->registerRouteMiddleware();
		
	}
	
	/**
	 * Register the route middleware.
	 *
	 * @return void
	 */
	protected function registerRouteMiddleware()
	{
		// register route middleware.
		foreach ($this->routeMiddleware as $key => $middleware) {
			app('router')->aliasMiddleware($key, $middleware);
		}
		
		// register middleware group.
		foreach ($this->middlewareGroups as $key => $middleware) {
			app('router')->middlewareGroup($key, $middleware);
		}
	}
}