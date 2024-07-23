<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use LdapRecord\Laravel\Auth\ListensForLdapBindFailure;

class AuthenticatedSessionController extends Controller
{
    use ListensForLdapBindFailure;

    protected $username = 'username';

    public function __construct()
    {
        $this->listenForLdapBindFailure();
    }

    protected function handleLdapBindError($message, $code = null)
    {
        if ($code == '773') {
            // The users password has expired. Redirect them.
            abort(redirect('/password-reset'));
        }

        throw ValidationException::withMessages([
            'username' => "Whoops! LDAP server cannot be reached.",
        ]);
    }
    
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
