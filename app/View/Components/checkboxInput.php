<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class checkboxInput extends Component
{
    public ?string $namePrefix;
    public $model;
    public string $column;

    /**
     * Create a new component instance.
     */
    public function __construct(?string $namePrefix, $model, string $column)
    {
        $this->namePrefix = $namePrefix;
        $this->model = $model;
        $this->column = $column;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.checkbox-input');
    }
}
