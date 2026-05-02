<?php

namespace App\Http\Controllers;

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

        if (Auth::guard('partner')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('partner.dashboard');
        }

        return back()->with('error', 'Email ou mot de passe incorrect. Vérifiez les identifiants envoyés par email.');
    }

    public function logout()
    {
        Auth::guard('partner')->logout();
        return redirect()->route('partner.login');
    }

    public function dashboard()
    {
        return view('partner.dashboard');
    }
}
