<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textareaInput extends Component
{
    public ?string $namePrefixBracket;
    public ?string $namePrefixDot;
    public string $column;
    public $model;
    public int $rows;
    public bool $required;
    /**
     * Create a new component instance.
     */
    public function __construct(
        ?string $namePrefixBracket = null,
        ?string $namePrefixDot = null,
        string $column,
        $model,
        int $rows = 4,
        bool $required = false
    ) {
        $this->namePrefixBracket = $namePrefixBracket;
        $this->namePrefixDot = $namePrefixDot;
        $this->column = $column;
        $this->model = $model;
        $this->rows = $rows;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea-input');
    }
}