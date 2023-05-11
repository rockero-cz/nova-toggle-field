<?php

namespace Rockero\NovaToggleField;

use Laravel\Nova\Fields\Boolean;

class Toggle extends Boolean
{
    public $component = 'toggle-field';

    public ?Closure $toggleCallback = null;

    protected bool $toggleOnIndex = false;
    protected string $trueColor = 'rgba(var(--colors-primary-300))';
    protected string $falseColor = 'rgba(var(--colors-gray-300))';

    public function toggleOnIndex(bool $value = true): self
    {
        $this->toggleOnIndex = $value;

        return $this;
    }

    public function toggleUsing(Closure $callback): self
    {
        $this->toggleCallback = $callback;

        return $this;
    }

    public function trueColor(string $color): self
    {
        $this->trueColor = $color;

        return $this;
    }

    public function falseColor(string $color): self
    {
        $this->falseColor = $color;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'toggle' => $this->toggleOnIndex,
            'trueColor' => $this->trueColor,
            'falseColor' => $this->falseColor,
        ]);
    }
}
