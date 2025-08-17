<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textInput extends Component
{
    public ?string $namePrefixBracket;
    public ?string $namePrefixDot;
    public string $column;
    public $model;
    public bool $required;

    /**
     * Create a new component instance.
     */
    public function __construct(string $column, $model, bool $required = false, ?string $namePrefixBracket = null, ?string $namePrefixDot = null)
    {
        $this->column = $column;
        $this->model = $model;
        $this->required = $required;
        $this->namePrefixBracket = $namePrefixBracket;
        $this->namePrefixDot = $namePrefixDot;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-input');
    }
}
