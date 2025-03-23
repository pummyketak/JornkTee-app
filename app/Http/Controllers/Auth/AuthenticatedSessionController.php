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

        if (Auth::check()) {
            if (Auth::user()->type == 2) {
                // ถ้าเป็น SuperAdmin (type = 2) ให้ redirect ไปยัง route ของ SuperAdmin
                return redirect()->route('superadminview');
            }
            return Auth::user()->type == 1
                ? redirect()->route('view') // 🔹 Admin ไปที่ AdminController
                : redirect()->route('userview'); // 🔹 User ไปที่ UserController
        // return redirect()->intended(route('dashboard', absolute: false));
        }
        return redirect()->route('login')->withErrors(['login' => 'Authentication failed.']);
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
