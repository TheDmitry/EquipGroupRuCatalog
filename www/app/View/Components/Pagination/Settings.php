<?php

namespace App\View\Components\Pagination;

use Illuminate\View\Component;

class Settings extends Component
{
    public string $pageSize;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->pageSize = request('pagesize', 12);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.pagination.settings');
    }
}