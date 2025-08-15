<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class submitButtons extends Component
{
    public string $submitLabel;
    public string $cancelLabel;

    /**
     * Create a new component instance.
     */
    public function __construct(string $submitLabel = 'Güncelle', string $cancelLabel = 'İptal')
    {
        $this->submitLabel = $submitLabel;
        $this->cancelLabel = $cancelLabel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.submit-buttons');
    }
}
