<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use App\Models\Inventory\Centro;
use App\Models\Inventory\Elemento;
use Illuminate\Contracts\View\View;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = User::count();
        view()->share('user',$user);

        $element = Elemento::where('tipo','=',9)->count();
        view()->share('element',$element);

        $center = Centro::count();
        view()->share('center',$center);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard');
    }
}
