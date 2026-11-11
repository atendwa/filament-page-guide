<?php

declare(strict_types=1);

use Atendwa\PageGuide\Filament\PageGuidePlugin;

it('renders the guide body and title without a footer or decoration by default', function (): void {
    $html = view('guides::widgets')->render();

    expect($html)->toContain('Using widgets')
        ->toContain('Widgets show one number each.')
        ->not->toContain('data-test="decoration"')
        ->not->toContain('italic flex-shrink-0');
});

it('shows the footer lines and decoration the application configures', function (): void {
    PageGuidePlugin::make()->footer(['Kind regards,', null, 'help@example.test'])->decoration('guides::decoration');

    $html = view('guides::widgets')->render();

    expect($html)->toContain('Kind regards,')
        ->toContain('help@example.test')
        ->toContain('data-test="decoration"');
});
