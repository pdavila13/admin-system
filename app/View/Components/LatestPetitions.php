<?php

namespace App\View\Components;

use Closure;
use App\Models\Petition;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LatestPetitions extends Component
{
    public $petitions;
    /**
     * Create a new component instance.
     */
    public function __construct($petitions)
    {
        $this->petitions = $petitions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.latest-petitions');
    }
}