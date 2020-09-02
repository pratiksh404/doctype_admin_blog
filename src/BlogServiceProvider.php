<?php

namespace doctype_admin\Blog;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap Doctype Admin Blog Services
     *
     *@return void
     */

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
        $this->registerResources();
    }

    /**
     * Register Doctype Admin Blog Services
     * 
     * @return void
     */

    public function register()
    {
        $this->commands([
            Console\DoctypeAdminBlogInstallerCommand::class
        ]);
    }

    /**
     * Return Package resources
     *
     */

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migartions');
        $this->loadFactoriesFrom(__DIR__ . '/../database/factories');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blog');
        $this->registerRoutes();
    }

    /**
     * Register Congig File
     *
     */
    protected function registerPublishing()
    {
        /* Config file publish */
        $this->publishes([
            __DIR__ . '/../config/blog.php' => config_path('blog.php')
        ], 'blog-config');
        /* Views File Publish */
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/blog'),
        ], 'blog-views');
        /* Migration File Publish */
        $this->publishes([
            __DIR__ . '/../database/migartions' => database_path('migrations')
        ], 'blog-migrations');
        /* Seed File Publish */
        $this->publishes([
            __DIR__ . '/../database/seeds' => database_path('seeds')
        ], 'blog-seeds');
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
        Route::group($this->apiRouteConfguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    private function routeConfiguration()
    {
        return [
            'prefix' => config('blog.prefix', 'admin/blog'),
            'namespace' => 'doctype_admin\Blog\Http\Controllers',
            'middleware' => config('blog.middleware', ['web', 'auth', 'activity', 'role:admin'])
        ];
    }

    private function apiRouteConfguration()
    {
        return [
            'prefix' => 'api/blog',
            'namespace' => 'doctype_admin\Blog\Http\Controllers\APIs',
            'middleware' => []
        ];
    }
}
