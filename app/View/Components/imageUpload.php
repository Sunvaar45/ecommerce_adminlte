<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class imageUpload extends Component
{
    public string $column;
    public $model;
    public ?string $namePrefixBracket;
    public ?string $namePrefixDot;
    public ?string $imageDir;
    public string $maxWidth;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $column,
        $model,
        ?string $namePrefixBracket = null,
        ?string $namePrefixDot = null,
        ?string $imageDir = null,
        string $maxWidth
    ) {
        $this->column = $column;
        $this->model = $model;
        $this->namePrefixBracket = $namePrefixBracket;
        $this->namePrefixDot = $namePrefixDot;
        $this->imageDir = $imageDir;
        $this->maxWidth = $maxWidth;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image-upload');
    }
}
