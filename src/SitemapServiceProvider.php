<?php

namespace Dvomaks\Sitemap;

use Illuminate\Support\ServiceProvider;

class SitemapServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dvomaks-sitemap');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/dvomaks-sitemap'),
        ], 'views');
    }

    public function register()
    {
        //
    }
}
