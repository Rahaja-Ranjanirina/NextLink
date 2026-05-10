<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EnsureSingleSessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerAuthController extends Controller
{
    public function showLogin()
    {
        return view('partner.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->role === 'entreprise') {
            $request->session()->regenerate();
            $request->session()->put('auth_guard', 'web');
            $request->session()->put('auth_user_id', Auth::id());
            EnsureSingleSessionGuard::rememberCurrentDevice($request);
            return redirect()->route('partner.dashboard');
        }

        Auth::logout();

        return back()->with('error', 'Email ou mot de passe incorrect. Vérifiez les identifiants envoyés par email.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('partner.login');
    }

    public function dashboard()
    {
        return view('partner.dashboard');
    }
}
