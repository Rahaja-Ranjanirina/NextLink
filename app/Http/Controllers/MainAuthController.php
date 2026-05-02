<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\User;
use App\Mail\ResetPasswordMail;

class MainAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');  // ta page login
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('student.dashboard');
        }

        if (Auth::guard('partner')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('partner.dashboard');
        }

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::guard('web')->user();

            if ($user->role === 'superadmin') {
                return redirect()->route('superadmin.dashboard');
            }

            if ($user->role === 'enseignant') {
                return redirect()->route('enseignant.dashboard');
            }

            return redirect()->route('login');
        }

        return back()->withErrors([
            'email' => 'Ces identifiants ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function showForgotPassword()
    {
        return view('auth.passwords.email');
    }

    public function sendPasswordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'age' => 'required|integer',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || $user->age !== (int) $request->age) {
            return back()->withErrors([
                'email' => 'Email ou âge incorrect.',
            ])->withInput();
        }

        $password = Str::random(8);
        $user->password = Hash::make($password);
        $user->save();

        Mail::to($user->email)->send(new ResetPasswordMail($user, $password));

        return back()->with('status', 'Un nouveau mot de passe a été envoyé par email.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
