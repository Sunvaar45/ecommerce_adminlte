<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class updateButtons extends Component
{
    public string $submitLabel;
    public string $cancelLabel;
    public string $route;

    /**
     * Create a new component instance.
     */
    public function __construct(string $submitLabel = 'Güncelle', string $cancelLabel = 'İptal', string $route = 'home')
    {
        $this->submitLabel = $submitLabel;
        $this->cancelLabel = $cancelLabel;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.update-buttons');
    }
}
