<?php

namespace App\View\Components;

use App\Models\GroupVpn;
use App\Models\Company;
use App\Models\Petition;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = User::count();
        view()->share('user',$user);

        $company = Company::count();
        view()->share('company',$company);
        
        $group_vpn = GroupVpn::count();
        view()->share('group_vpn',$group_vpn);

        $petition = Petition::count();
        view()->share('petition',$petition);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard');
    }
}
