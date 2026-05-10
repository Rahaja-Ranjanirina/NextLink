<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureSingleSessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->role === 'superadmin') {
            $request->session()->regenerate();
            $request->session()->put('auth_guard', 'web');
            $request->session()->put('auth_user_id', Auth::id());
            EnsureSingleSessionGuard::rememberCurrentDevice($request);
            return redirect()->intended('/admin/dashboard');
        }

        Auth::logout();

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
