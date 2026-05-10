<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use App\Http\Middleware\EnsureSingleSessionGuard;

class MainAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');  // ta page login
    }

    private function finishLogin(Request $request, string $route)
    {
        $request->session()->regenerate();
        $request->session()->put('auth_guard', 'web');
        $request->session()->put('auth_user_id', Auth::id());
        EnsureSingleSessionGuard::rememberCurrentDevice($request);

        return redirect()->route($route);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'superadmin') {
                return $this->finishLogin($request, 'admin.dashboard');
            }

            if ($user->role === 'enseignant') {
                return $this->finishLogin($request, 'enseignant.dashboard');
            }

            if ($user->role === 'etudiant') {
                return $this->finishLogin($request, 'student.dashboard');
            }

            if ($user->role === 'entreprise') {
                return $this->finishLogin($request, 'partner.dashboard');
            }

            Auth::logout();
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
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
