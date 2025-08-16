<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class priceInput extends Component
{
    public string $namePrefix;
    public string $column;
    public $model;
    public bool $required;

    /**
     * Create a new component instance.
     */
    public function __construct(string $namePrefix, string $column, $model, bool $required)
    {
        $this->namePrefix = $namePrefix;
        $this->column = $column;
        $this->model = $model;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.price-input');
    }
}
