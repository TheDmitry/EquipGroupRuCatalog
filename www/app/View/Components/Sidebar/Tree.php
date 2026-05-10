<?php

namespace App\View\Components\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use App\Models\Group;

class Tree extends Component
{
    public Collection $groups;

    public Group $parent;

    public array $path;

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $groups, Group $parent, array $path)
    {
        $this->groups = $groups;
        $this->parent = $parent;
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar.tree');
    }
}
