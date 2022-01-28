<?php

namespace Rockero\NovaToggleField;

use Closure;
use Laravel\Nova\Fields\Boolean;

class Toggle extends Boolean
{
    public $component = 'toggle-field';
    
    public ?Closure $toggleCallback = null;

    protected static array $defaultColors = [
        'black', 'danger', 'success',
        'warning', 'info', 'primary', 
    ];

    protected bool $toggleOnIndex = false;
    protected string $trueColor = 'var(--primary)'; 
    protected string $falseColor = 'var(--70)';

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
        $this->trueColor = $this->parseColor($color);

        return $this;
    }

    public function falseColor(string $color): self
    {
        $this->falseColor = $this->parseColor($color);

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

    protected function parseColor(string $color): string
    {
        if (in_array($color, self::$defaultColors)) {
            return "var(--{$color})";
        }

        return $color;
    }
}
