<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! Auth::check() || ! Auth::user()->isSuperAdmin()) {
                abort(403);
            }

            return $next($request);
        });
    }

    // ────────────────────────────────────────────────────────
    // Dashboard
    // ────────────────────────────────────────────────────────
    public function dashboard()
    {
        $stats = [
            'enseignants' => User::where('role', 'enseignant')->count(),
            'etudiants'   => User::where('role', 'etudiant')->count(),
            'entreprises' => User::where('role', 'entreprise')->count(),
        ];

        return view('superadmin.dashboard', compact('stats'));
    }

    // ────────────────────────────────────────────────────────
    // Gestion Enseignants
    // ────────────────────────────────────────────────────────
    public function enseignants()
    {
        $enseignants = User::where('role', 'enseignant')
            ->withCount('etudiantsAjoutes')
            ->latest()
            ->paginate(15);

        return view('superadmin.enseignants.index', compact('enseignants'));
    }

    public function createEnseignant()
    {
        return view('superadmin.enseignants.create');
    }

    public function storeEnseignant(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email'  => 'required|email|unique:users',
            'age'    => 'required|integer|min:18|max:100',
        ]);

        $password = Str::random(8);

        $enseignant = User::create([
            ...$validated,
            'role'     => 'enseignant',
            'password' => Hash::make($password),
        ]);

        // On peut envoyer un mail ici si nécessaire
        return redirect()
            ->route('superadmin.enseignants')
            ->with('success', "Enseignant créé. Mot de passe provisoire : {$password}");
    }

    public function editEnseignant(User $enseignant)
    {
        abort_unless($enseignant->role === 'enseignant', 404);
        return view('superadmin.enseignants.edit', compact('enseignant'));
    }

    public function updateEnseignant(Request $request, User $enseignant)
    {
        abort_unless($enseignant->role === 'enseignant', 404);

        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $enseignant->id,
            'age'    => 'required|integer|min:18|max:100',
        ]);

        $enseignant->update($validated);

        return redirect()
            ->route('superadmin.enseignants')
            ->with('success', 'Enseignant mis à jour.');
    }

    public function destroyEnseignant(User $enseignant)
    {
        abort_unless($enseignant->role === 'enseignant', 404);
        $enseignant->delete();

        return redirect()
            ->route('superadmin.enseignants')
            ->with('success', 'Enseignant supprimé.');
    }

    // ────────────────────────────────────────────────────────
    // Gestion Étudiants (par le superadmin)
    // ────────────────────────────────────────────────────────
    public function etudiants()
    {
        $etudiants = User::where('role', 'etudiant')
            ->with('etudiant')
            ->latest()
            ->paginate(20);

        return view('superadmin.etudiants.index', compact('etudiants'));
    }

    public function editEtudiant(User $etudiant)
    {
        abort_unless($etudiant->role === 'etudiant', 404);
        $etudiant->load('etudiant');
        return view('superadmin.etudiants.edit', compact('etudiant'));
    }

    public function updateEtudiant(Request $request, User $etudiant)
    {
        abort_unless($etudiant->role === 'etudiant', 404);

        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $etudiant->id,
            'age'    => 'nullable|integer',
        ]);

        $etudiant->update($validated);

        return redirect()
            ->route('superadmin.etudiants')
            ->with('success', 'Étudiant mis à jour.');
    }

    public function destroyEtudiant(User $etudiant)
    {
        abort_unless($etudiant->role === 'etudiant', 404);
        $etudiant->delete();

        return redirect()
            ->route('superadmin.etudiants')
            ->with('success', 'Étudiant supprimé.');
    }

    // ────────────────────────────────────────────────────────
    // Gestion Entreprises
    // ────────────────────────────────────────────────────────
    public function entreprises()
    {
        $entreprises = User::where('role', 'entreprise')
            ->with('entreprise')
            ->latest()
            ->paginate(15);

        return view('superadmin.entreprises.index', compact('entreprises'));
    }
}