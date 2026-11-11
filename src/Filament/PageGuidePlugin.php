<?php

declare(strict_types=1);

namespace Atendwa\PageGuide\Filament;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;

class PageGuidePlugin implements Plugin
{
    public function getId(): string
    {
        return 'page-guide';
    }

    public static function make(): self
    {
        return new self;
    }

    /**
     * @param  array<int, string|null>  $lines
     */
    public function footer(array $lines): self
    {
        config(['page-guide.footer' => array_values(array_filter($lines, filled(...)))]);

        return $this;
    }

    public function decoration(?string $component): self
    {
        config(['page-guide.decoration' => $component]);

        return $this;
    }

    public function register(Panel $panel): void
    {
        $css = Css::make(
            'page-guide-styles',
            __DIR__ . '/../../resources/css/page-guide.css',
        );

        FilamentAsset::register([$css], package: 'atendwa/filament-page-guide');
    }

    public function boot(Panel $panel): void {}
}
