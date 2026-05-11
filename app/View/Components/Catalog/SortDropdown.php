<?php

namespace App\View\Components\Catalog;

use Illuminate\View\Component;

class SortDropdown extends Component
{
    public string $sort;
    public string $direction;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->sort = request('sort', 'name');
        $this->direction = request('direction', 'asc');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.catalog.sort-dropdown');
    }
}