<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Partner;
use App\Models\Etudiant;
use App\Models\User;
use App\Models\Offre;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Mail\StudentCredentialsMail;
use App\Mail\PartnerCredentialsMail;
use App\Mail\TeacherCredentialsMail;

class DashboardController extends Controller
{
    // Page dashboard admin (liste des étudiants)
   public function index()
{
    $students = Student::with('etudiant')->get();
    
    // Debug - afficher la valeur de is_moderator pour le premier étudiant
    \Log::info('Test is_moderator', [
        'first_student' => $students->first() ? [
            'id' => $students->first()->id,
            'name' => $students->first()->name,
            'is_moderator' => $students->first()->is_moderator
        ] : 'no student'
    ]);
    
    $partners = Partner::all();
    $enseignants = User::where('role', 'enseignant')->get();

    return view('admin.dashboard', compact('students', 'partners', 'enseignants'));
}

    // ==================== MÉTHODES POUR LE DASHBOARD ÉTUDIANT ====================
    
    /**
     * Dashboard étudiant
     */
    public function studentDashboard()
    {
        // Récupérer les offres récentes (4 dernières)
        $offres = Offre::latest()->take(4)->get();
        
        // Récupérer les candidatures de l'utilisateur connecté (3 dernières)
        $mesCandidatures = auth()->user()->candidatures()->latest()->take(3)->get();
        
        // Récupérer tous les étudiants (sauf l'utilisateur connecté)
        $allEtudiants = User::where('role', 'etudiant')
                            ->where('id', '!=', auth()->id())
                            ->with('etudiant')
                            ->get();
        
        // Récupérer tous les enseignants
        $allEnseignants = User::where('role', 'enseignant')->get();
        
        return view('student.dashboard', compact('offres', 'mesCandidatures', 'allEtudiants', 'allEnseignants'));
    }

    // ==================== CRUD ÉTUDIANTS ====================
    
    // Ajouter étudiant + email automatique
    public function storeStudent(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'registration_number' => 'required|string|unique:etudiants,numero_inscription',
            'email' => 'required|email|unique:users',
        ]);

        $password = Str::random(8);

        $student = Student::create([
            'name' => $request->last_name,
            'prenom' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'etudiant',
        ]);

        Etudiant::create([
            'user_id' => $student->id,
            'added_by' => Auth::id(),
            'numero_inscription' => $request->registration_number,
        ]);

        Mail::to($student->email)->send(new StudentCredentialsMail($student, $password));

        return back()->with('success', 'Étudiant ajouté et email envoyé !');
    }

    public function editStudent(Student $student)
    {
        $student->load('etudiant');
        return view('admin.students.edit', compact('student'));
    }

    public function updateStudent(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users', 'email')->ignore($student->id)],
            'registration_number' => ['required','string', Rule::unique('etudiants', 'numero_inscription')->ignore($student->etudiant->id ?? null)],
        ]);

        $student->update([
            'prenom' => $request->first_name,
            'name' => $request->last_name,
            'email' => $request->email,
        ]);

        $student->etudiant()->updateOrCreate([
            'user_id' => $student->id,
        ], [
            'numero_inscription' => $request->registration_number,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Étudiant mis à jour.');
    }

    public function destroyStudent(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Étudiant supprimé.');
    }

    // ==================== CRUD PARTENAIRES ====================
    
    public function storePartner(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);

        $password = Str::random(8);

        $partner = Partner::create([
            'name' => $request->name,
            'prenom' => null,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'entreprise',
        ]);

        Mail::to($partner->email)->send(new PartnerCredentialsMail($partner, $password));

        return back()->with('success', 'Partenaire ajouté et email envoyé !');
    }

    // ==================== CRUD ENSEIGNANTS ====================
    
    public function storeEnseignant(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);

        $password = Str::random(8);

        $enseignant = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'enseignant',
        ]);

        Mail::to($enseignant->email)->send(new TeacherCredentialsMail($enseignant, $password));

        return back()->with('success', 'Enseignant ajouté et email envoyé !');
    }

    public function editEnseignant(User $enseignant)
    {
        abort_unless($enseignant->role === 'enseignant', 404);
        return view('admin.enseignants.edit', compact('enseignant'));
    }

    public function updateEnseignant(Request $request, User $enseignant)
    {
        abort_unless($enseignant->role === 'enseignant', 404);

        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users', 'email')->ignore($enseignant->id)],
        ]);

        $enseignant->update([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Enseignant mis à jour.');
    }

    public function destroyEnseignant(User $enseignant)
    {
        abort_unless($enseignant->role === 'enseignant', 404);
        $enseignant->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Enseignant supprimé.');
    }

    // ==================== GESTION DES MODÉRATEURS ====================
    
    /**
     * Désigner un utilisateur (étudiant ou enseignant) comme modérateur
     */
    public function makeModerator(Request $request, User $user)
    {
        $user->update(['is_moderator' => true]);
        
        $message = $user->prenom . ' ' . $user->name . ' est maintenant modérateur.';
        return back()->with('success', $message);
    }

    /**
     * Retirer le statut de modérateur à un utilisateur
     */
    public function removeModerator(Request $request, User $user)
    {
        $user->update(['is_moderator' => false]);
        
        $message = $user->prenom . ' ' . $user->name . ' n\'est plus modérateur.';
        return back()->with('success', $message);
    }
}