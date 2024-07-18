<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
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

    /**
     * Handle api authentication request.
     */
    public function apiLogin(LoginRequest $request): RedirectResponse | \Illuminate\Http\JsonResponse
    {
        $request->validated();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $access_token = Auth::user()->createToken(Auth::user()->email)->plainTextToken;
            return response()->json(['message' => 'Authenticated', 'access_token' => $access_token], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 403);
        }
    }
}
