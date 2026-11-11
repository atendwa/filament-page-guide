<?php

declare(strict_types=1);

namespace Atendwa\PageGuide;

use Illuminate\Support\ServiceProvider;

class PageGuideServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/page-guide.php', 'page-guide');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'pageguide');
    }
}
