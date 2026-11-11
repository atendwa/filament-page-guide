<?php

declare(strict_types=1);

namespace Atendwa\PageGuide\Concerns;

use Filament\Actions\Action;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View;
use Throwable;

trait HasPageGuide
{
    public function getPageGuide(): ?string
    {
        return null;
    }

    public function getPageGuideContent(): ViewContract|string|null|Htmlable
    {
        return $this->resolvePageGuideView();
    }

    public function getPageGuideHeading(): string
    {
        $heading = $this->getHeading();

        return ($heading instanceof Htmlable ? strip_tags($heading->toHtml()) : $heading) . ' Guide';
    }

    public function getPageGuideIcon(): string
    {
        return 'heroicon-o-book-open';
    }

    public function hasPageGuide(): bool
    {
        $name = $this->getPageGuide();

        return filled($name) && view()->exists($name);
    }

    /**
     * @return array<int, Action>
     *
     * @throws Throwable
     */
    protected function actions(): array
    {
        return [
            $this->pageGuideAction(),
        ];
    }

    /**
     * @throws Throwable
     */
    protected function pageGuideAction(): Action
    {
        return Action::make('view-page-guide')->modalWidth('screen')
            ->visible($this->hasPageGuide())->icon('heroicon-o-book-open')
            ->modalHeading($this->getPageGuideHeading())->color('gray')
            ->modalSubmitAction(action: false)->modalIconColor('info')
            ->modalContent(fn () => $this->getPageGuideContent())->modal()
            ->label('Guide')->modalIcon($this->getPageGuideIcon())
            ->modalCancelAction(
                fn (Action $action): Action => $action
                    ->extraAttributes(['class' => 'guide-close-btn'])
                    ->icon('heroicon-o-x-mark')
                    ->label('Close')
            );
    }

    protected function resolvePageGuideView(): ?ViewContract
    {
        if ($this->getPageGuide() === null || ! $this->hasPageGuide()) {
            return null;
        }

        return View::file(View::getFinder()->find($this->getPageGuide()));
    }
}
