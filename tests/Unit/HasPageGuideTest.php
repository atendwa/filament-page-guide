<?php

declare(strict_types=1);

use Atendwa\PageGuide\Concerns\HasPageGuide;
use Atendwa\PageGuide\Tests\Fixtures\GuidedPage;
use Illuminate\Support\HtmlString;

$makePage = fn (?string $guide): object => new readonly class($guide)
{
    use HasPageGuide;

    public function __construct(private ?string $guide) {}

    public function getPageGuide(): ?string
    {
        return $this->guide;
    }

    public function getHeading(): string
    {
        return 'Widgets';
    }
};

it('reports no guide when none is set', function () use ($makePage): void {
    $page = $makePage(null);

    expect($page->hasPageGuide())->toBeFalse()
        ->and($page->getPageGuideContent())->toBeNull();
});

it('reports no guide when the configured view does not exist', function () use ($makePage): void {
    $page = $makePage('guides::does-not-exist');

    expect($page->hasPageGuide())->toBeFalse()
        ->and($page->getPageGuideContent())->toBeNull();
});

it('finds and resolves a guide when the configured view exists', function () use ($makePage): void {
    $page = $makePage('guides::widgets');

    expect($page->hasPageGuide())->toBeTrue()
        ->and($page->getPageGuideContent())->not->toBeNull();
});

it('derives the guide heading from the page heading', function () use ($makePage): void {
    expect($makePage('guides::widgets')->getPageGuideHeading())->toBe('Widgets Guide');
});

it('reads an HTML page heading as plain text', function (): void {
    expect((new GuidedPage('guides::widgets', new HtmlString('<span>Widgets</span>')))->getPageGuideHeading())->toBe('Widgets Guide');
});
