# Filament Page Guide

[![Latest Version](https://img.shields.io/packagist/v/atendwa/filament-page-guide)](https://packagist.org/packages/atendwa/filament-page-guide)
[![PHP](https://img.shields.io/packagist/dependency-v/atendwa/filament-page-guide/php)](composer.json)
[![Laravel](https://img.shields.io/packagist/dependency-v/atendwa/filament-page-guide/illuminate%2Fsupport?label=laravel)](composer.json)
[![Filament](https://img.shields.io/packagist/dependency-v/atendwa/filament-page-guide/filament%2Ffilament?label=filament)](composer.json)
[![Tests](https://github.com/atendwa/filament-page-guide/actions/workflows/tests.yml/badge.svg?branch=develop)](https://github.com/atendwa/filament-page-guide/actions/workflows/tests.yml)

Adds a **Guide** button to Filament pages. It opens a full-width modal that shows a Blade view explaining the page: what it is for,
what each part means and how to use it.

- Filament 5, Laravel 12 or 13, PHP 8.3+.
- Guides are plain Blade views, so they live with your application and can use any HTML.
- Nothing is shown when a page has no guide, or when its view does not exist.

## Installation

```bash
composer require atendwa/filament-page-guide
```

Register the plugin on each panel that shows guides (it adds the modal's styles):

```php
use Atendwa\PageGuide\Filament\PageGuidePlugin;

$panel->plugins([
    PageGuidePlugin::make(),
]);
```

Then run `php artisan filament:assets` so the stylesheet is published.

## Adding a guide to a page

Use the trait on any Filament page (list, view, custom pages) and name the guide view:

```php
use Atendwa\PageGuide\Concerns\HasPageGuide;

class ListOrders extends ListRecords
{
    use HasPageGuide;

    public function getPageGuide(): ?string
    {
        return 'guides.orders';
    }
}
```

The trait adds the button through the page's `actions()`. If your page builds its own header actions, include
`$this->pageGuideAction()` where you want the button.

Write the guide with the component the package provides:

```blade
{{-- resources/views/guides/orders.blade.php --}}
<x-pageguide::partials.guide title="Working with orders">
    <p>Orders appear here as soon as they are paid.</p>
    <ul>
        <li><strong>Status:</strong> where the order is in fulfilment.</li>
    </ul>
</x-pageguide::partials.guide>
```

### Optional customisation

| Method | Effect |
|---|---|
| `getPageGuideHeading()` | modal heading; defaults to the page heading followed by "Guide" |
| `getPageGuideIcon()` | modal icon; defaults to `heroicon-o-book-open` |

## Footer and decoration

Both are off by default. Set them on the plugin:

```php
PageGuidePlugin::make()
    ->footer(['Kind regards,', 'The support team', 'support@example.com'])
    ->decoration('components.guide-artwork');
```

- `footer()` takes lines shown at the bottom of every guide (empty lines are skipped). The first line is emphasised.
- `decoration()` takes the name of a Blade component rendered beside the guide on large screens (for example an
  illustration). It receives a `class` attribute to fill the space.

The plugin stores both in the `page-guide.footer` and `page-guide.decoration` config keys, so they can also be set with
`config([...])` in a service provider.

## Testing

```bash
composer install
composer quality   # Pint, Rector, PHPStan (max), Pest
```

## Changelog

See [CHANGELOG.md](CHANGELOG.md).

## License

MIT. See [LICENSE.md](LICENSE.md).
