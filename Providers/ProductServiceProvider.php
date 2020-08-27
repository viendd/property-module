<?php

namespace Modules\Product\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Product\Repositories\Cache\BrandCacheMongoRepository;
use Modules\Product\Repositories\Cache\BrandCacheRepository;
use Modules\Product\Repositories\Cache\ProductCacheRepository;
use Modules\Product\Repositories\Cache\ProductCategoryCacheRepository;
use Modules\Product\Repositories\Cache\ProductTagCacheRepository;
use Modules\Product\Repositories\Cache\PropertyCacheMongoRepository;
use Modules\Product\Repositories\Cache\PropertyGroupCacheMongoRepository;
use Modules\Product\Repositories\Contracts\BrandRepositoryInterface;
use Modules\Product\Repositories\Contracts\ProductCategoryRepositoryInterface;
use Modules\Product\Repositories\Contracts\ProductRepositoryInterface;
use Modules\Product\Repositories\Contracts\ProductTagRepositoryInterface;
use Modules\Product\Repositories\Contracts\PropertyGroupRepositoryInterface;
use Modules\Product\Repositories\Contracts\PropertyRepositoryInterface;

class ProductServiceProvider extends ServiceProvider
{
    public $bindings = [
        ProductCategoryRepositoryInterface::class => ProductCategoryCacheRepository::class,
        BrandRepositoryInterface::class           => BrandCacheMongoRepository::class,
        ProductTagRepositoryInterface::class      => ProductTagCacheRepository::class,
        ProductRepositoryInterface::class         => ProductCacheRepository::class,
        PropertyGroupRepositoryInterface::class   => PropertyGroupCacheMongoRepository::class,
        PropertyRepositoryInterface::class        => PropertyCacheMongoRepository::class,
    ];

    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Product';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'product';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        if ( ! config('core.saas_enable')) {
            $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        }
        if (config('core.saas_enable')) {
            $this->app->bind(\Modules\Product\Entities\Brand::class, \Modules\Product\Entities\Tenants\Brand::class);
            $this->app->bind(\Modules\Product\Entities\Product::class, \Modules\Product\Entities\Tenants\Product::class);
            $this->app->bind(\Modules\Product\Entities\ProductTranslation::class, \Modules\Product\Entities\Tenants\ProductTranslation::class);
            $this->app->bind(\Modules\Product\Entities\ProductCategory::class, \Modules\Product\Entities\Tenants\ProductCategory::class);
            $this->app->bind(\Modules\Product\Entities\ProductCategoryTranslation::class, \Modules\Product\Entities\Tenants\ProductCategoryTranslation::class);
            $this->app->bind(\Modules\Product\Entities\ProductTag::class, \Modules\Product\Entities\Tenants\ProductTag::class);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if ( ! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path($this->moduleName, 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }

        return $paths;
    }
}
