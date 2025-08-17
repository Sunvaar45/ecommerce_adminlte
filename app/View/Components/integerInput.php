<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class integerInput extends Component
{
    public string $column;
    public string $namePrefix;
    public $model;
    public bool $required;

    /**
     * Create a new component instance.
     */
    public function __construct(string $column, string $namePrefix, $model, bool $required = false)
    {
        $this->column = $column;
        $this->namePrefix = $namePrefix;
        $this->model = $model;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.integer-input');
    }
}
