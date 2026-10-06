<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->user()?->is_admin) {
            return redirect()->route('admin.panel');
        }

        return view('admin.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => [
                'required',
                'string',
                'max:100',
            ],
            'password' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $username = trim($credentials['username']);

        $throttleKey = 'admin-login:'
            .Str::lower($username)
            .'|'
            .$request->ip();

        $authenticated = RateLimiter::attempt(
            $throttleKey,
            5,
            function () use ($username, $credentials): bool {
                return Auth::attempt([
                    'username' => $username,
                    'password' => $credentials['password'],
                    'is_admin' => true,
                ]);
            },
            60
        );

        if ($authenticated) {
            RateLimiter::clear($throttleKey);

            $request->session()->regenerate();

            return redirect()->intended(
                route('admin.panel')
            );
        }

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()
                ->withErrors([
                    'username' => "Demasiados intentos. Intenta nuevamente en {$seconds} segundos.",
                ])
                ->onlyInput('username');
        }

        return back()
            ->withErrors([
                'username' => 'El usuario o la contraseña son incorrectos.',
            ])
            ->onlyInput('username');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}