<?php

namespace GussiApi;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class GussiApiServiceProvider extends BaseServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../configs/gussi.php' => config_path('gussi.php'),
		]);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../configs/gussi.php', 'gussi'
		);

		$this->app->bind(GussiApiClient::class);
	}
}