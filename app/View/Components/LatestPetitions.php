<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LatestPetitions extends Component
{
    public $petitions;
    public $companies;
    public $petitionTypes;
    public $users;
    public $states;

    /**
     * Create a new component instance.
     */
    public function __construct($petitions, $companies, $petitionTypes, $users, $states)
    {
        $this->petitions = $petitions;
        $this->companies = $companies;
        $this->petitionTypes = $petitionTypes;
        $this->users = $users;
        $this->states = $states;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.latest-petitions');
    }
}