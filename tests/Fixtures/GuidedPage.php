<?php

declare(strict_types=1);

namespace Atendwa\PageGuide\Tests\Fixtures;

use Atendwa\PageGuide\Concerns\HasPageGuide;
use Illuminate\Contracts\Support\Htmlable;

final readonly class GuidedPage
{
    use HasPageGuide;

    public function __construct(private ?string $guide, private string|Htmlable $heading) {}

    public function getPageGuide(): ?string
    {
        return $this->guide;
    }

    public function getHeading(): string|Htmlable
    {
        return $this->heading;
    }
}
