<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dropdownInput extends Component
{
    public ?string $namePrefixBracket;
    public ?string $namePrefixDot;
    public $model;
    public string $column;
    public array $options;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $column,
        array $options,
        $model = null,
        ?string $namePrefixBracket = null,
        ?string $namePrefixDot = null,
    ) 
    {
        $this->column = $column;
        $this->options = $options;
        $this->model = $model;
        $this->namePrefixBracket = $namePrefixBracket;
        $this->namePrefixDot = $namePrefixDot;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown-input');
    }
}