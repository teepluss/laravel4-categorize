<?php namespace Teepluss\Categorize;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Teepluss\Categorize\Categories\Provider as CategoryProvider;
use Teepluss\Categorize\CategoryRelates\Provider as CategoryRelateProvider;
use Teepluss\Categorize\CategoryHierarchy\Provider as CategoryHierarchyProvider;

class CategorizeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap classes for packages.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('teepluss/categorize');

		// Auto create app alias with boot method.
		$loader = AliasLoader::getInstance();
		$loader->alias('Categorize', 'Teepluss\Categorize\Facades\Categorize');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCategoryProvider();
		$this->registerCategoryRelateProvider();
		$this->registerCategoryHierarchyProvider();

		$this->app['categorize'] = $this->app->share(function($app)
		{
			return new Categorize(
				$app['config'],
				$app['categorize.category'],
				$app['categorize.categoryRelate'],
				$app['categorize.categoryHierarchy']
			);
		});
	}

	/**
	 * Register category provider.
	 *
	 * @return \CategoryProvider
	 */
	protected function registerCategoryProvider()
	{
		$this->app['categorize.category'] = $this->app->share(function($app)
		{
			$model = $app['config']->get('categorize::categories.model');

			return new CategoryProvider($model);
		});
	}

	/**
	 * Register category hierarchy provider.
	 *
	 * @return \CategoryHierarchyProvider
	 */
	protected function registerCategoryHierarchyProvider()
	{
		$this->app['categorize.categoryHierarchy'] = $this->app->share(function($app)
		{
			$model = $app['config']->get('categorize::categoryHierarchy.model');

			return new CategoryHierarchyProvider($model);
		});
	}

	/**
	 * Register category relate provider.
	 *
	 * @return \CategoryHierarchyProvider
	 */
	protected function registerCategoryRelateProvider()
	{
		$this->app['categorize.categoryRelate'] = $this->app->share(function($app)
		{
			$model = $app['config']->get('categorize::categoryRelates.model');

			return new CategoryRelateProvider($model);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('categorize');
	}

}