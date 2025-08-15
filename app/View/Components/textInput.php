<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textInput extends Component
{
    public ?string $namePrefix;
    public string $column;
    public $model;
    public bool $required;

    /**
     * Create a new component instance.
     */
    public function __construct(string $column, $model, bool $required = false, ?string $namePrefix = null)
    {
        $this->column = $column;
        $this->model = $model;
        $this->required = $required;
        $this->namePrefix = $namePrefix;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-input');
    }
}
