<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class toggleState extends Component
{
    public string $table;
    public $model;
    public string $column;

    /**
     * Create a new component instance.
     */
    public function __construct(string $table, $model, string $column = 'status')
    {
        $this->table = $table;
        $this->model = $model;
        $this->column = $column;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toggle-state');
    }
}