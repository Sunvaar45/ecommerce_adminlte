<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class idInput extends Component
{
    public ?string $namePrefix;
    public $model;

    /**
     * Create a new component instance.
     */
    public function __construct(?string $namePrefix, $model)
    {
        $this->namePrefix = $namePrefix;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.id-input');
    }
}
