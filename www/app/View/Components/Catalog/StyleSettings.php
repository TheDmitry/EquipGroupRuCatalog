<?php

namespace App\View\Components\Catalog;

use Illuminate\View\Component;

class StyleSettings extends Component
{
    public string $view;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->view = request('view', 'list') === 'list' ? 'list' : 'grid';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.catalog.style-settings', ['view' => $this->view]);
    }
}