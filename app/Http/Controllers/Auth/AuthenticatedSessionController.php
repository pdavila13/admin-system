<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $ldapUser = Auth::user();
        $memberOf = $ldapUser->getAttribute('memberof');
        if (!is_array($memberOf)) {
            $memberOf = [];
        }
        $role = 'user';
        if (in_array('CN=Sistemes,OU=Administradors Informàtica,DC=parcsanitari,DC=local', $memberOf)) {
            $role = 'admin';
        }

        $user = Auth::user();
        $user->assignRole($role);

        $username = $user->username;
        $avatar = config('app.avatar_url') . $username;

        $user->update(['avatar' => $avatar]);

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Login successfully.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
