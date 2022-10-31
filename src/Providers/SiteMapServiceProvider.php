<?php

namespace Ltsat\SitemapGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Ltsat\SitemapGenerator\Commands\SiteMapCommand;
use Ltsat\SitemapGenerator\SiteMapGenerator;
use Ltsat\SitemapGenerator\SiteMapHandler;

class SiteMapServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('siteMap', SiteMapHandler::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SiteMapGenerator::class
            ]);
        }
    }
}