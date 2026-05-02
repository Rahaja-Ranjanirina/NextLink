<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEtudiantMail;
use App\Models\Etudiant;
use App\Models\Offre;
use App\Models\OffreMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EnseignantController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! Auth::check() || ! Auth::user()->isEnseignant()) {
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
        $enseignant   = Auth::user();
        $isModerator = $enseignant->is_moderator ?? false;
        
        $nbEtudiants  = Etudiant::where('added_by', $enseignant->id)->count();
        $mesOffres    = Offre::where('user_id', $enseignant->id)->withCount('candidatures')->latest()->take(5)->get();
        
        // Récupérer TOUS les étudiants
        $etudiants = User::where('role', 'etudiant')
            ->with('etudiant')
            ->orderBy('prenom')
            ->get();
        
        // Récupérer TOUS les enseignants
        $enseignants = User::where('role', 'enseignant')
            ->orderBy('prenom')
            ->get();
        
        // Récupérer TOUTES les entreprises (PARTENAIRES)
        $entreprises = User::where('role', 'entreprise')
            ->orderBy('name')
            ->get();

        return view('enseignant.dashboard', compact(
            'enseignant', 'nbEtudiants', 'mesOffres', 
            'etudiants', 'enseignants', 'entreprises', 'isModerator'
        ));
    }

    // ────────────────────────────────────────────────────────
    // Profil étudiant (pour modérateurs)
    // ────────────────────────────────────────────────────────
    /**
     * Afficher le profil d'un étudiant (pour les modérateurs)
     */
 /**
 * Afficher le profil d'un étudiant
 */
public function showStudentProfile(User $user)
{
    // Vérifier que l'utilisateur connecté est un enseignant (pas besoin d'être modérateur)
    if (!Auth::user()->isEnseignant()) {
        abort(403, 'Accès non autorisé.');
    }
    
    // Vérifier que l'utilisateur est bien un étudiant
    if ($user->role !== 'etudiant') {
        abort(404, 'Utilisateur non trouvé.');
    }
    
    $etudiant = $user->load('etudiant');
    
    return view('enseignant.etudiants.show', compact('etudiant'));
}

    // ────────────────────────────────────────────────────────
    // CRUD Étudiants
    // ────────────────────────────────────────────────────────
    public function etudiants()
    {
        $etudiants = Etudiant::where('added_by', Auth::id())
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('enseignant.etudiants.index', compact('etudiants'));
    }

    public function createEtudiant()
    {
        return view('enseignant.etudiants.create');
    }

    public function storeEtudiant(Request $request)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'prenom'             => 'required|string|max:255',
            'email'              => 'required|email|unique:users',
            'age'                => 'required|integer|min:15|max:60',
            'numero_inscription' => 'required|string|unique:etudiants',
        ]);

        // Générer mot de passe 8 caractères
        $plainPassword = Str::random(8);

        // Créer l'utilisateur
        $user = User::create([
            'name'     => $validated['name'],
            'prenom'   => $validated['prenom'],
            'email'    => $validated['email'],
            'age'      => $validated['age'],
            'password' => Hash::make($plainPassword),
            'role'     => 'etudiant',
        ]);

        // Créer le profil étudiant
        Etudiant::create([
            'user_id'            => $user->id,
            'added_by'           => Auth::id(),
            'numero_inscription' => $validated['numero_inscription'],
        ]);

        // Envoyer le mail de bienvenue depuis l'email de l'enseignant
        Mail::to($user->email)->send(
            new WelcomeEtudiantMail($user, $plainPassword, Auth::user())
        );

        return redirect()
            ->route('enseignant.etudiants')
            ->with('success', 'Étudiant ajouté et email envoyé avec succès !');
    }

    public function editEtudiant(Etudiant $etudiant)
    {
        $this->authorizeEtudiant($etudiant);
        return view('enseignant.etudiants.edit', compact('etudiant'));
    }

    public function updateEtudiant(Request $request, Etudiant $etudiant)
    {
        $this->authorizeEtudiant($etudiant);

        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'prenom'             => 'required|string|max:255',
            'email'              => 'required|email|unique:users,email,' . $etudiant->user_id,
            'age'                => 'required|integer',
            'numero_inscription' => 'required|string|unique:etudiants,numero_inscription,' . $etudiant->id,
        ]);

        $etudiant->user->update([
            'name'   => $validated['name'],
            'prenom' => $validated['prenom'],
            'email'  => $validated['email'],
            'age'    => $validated['age'],
        ]);

        $etudiant->update(['numero_inscription' => $validated['numero_inscription']]);

        return redirect()
            ->route('enseignant.etudiants')
            ->with('success', 'Étudiant mis à jour.');
    }

    public function destroyEtudiant(Etudiant $etudiant)
    {
        $this->authorizeEtudiant($etudiant);
        $etudiant->user->delete();

        return redirect()
            ->route('enseignant.etudiants')
            ->with('success', 'Étudiant supprimé.');
    }

    public function showEtudiant(Etudiant $etudiant)
    {
        $this->authorizeEtudiant($etudiant);
        $etudiant->load('user', 'candidatures.offre');
        return view('enseignant.etudiants.show', compact('etudiant'));
    }

    // ────────────────────────────────────────────────────────
    // CRUD Offres
    // ────────────────────────────────────────────────────────
    public function offres()
    {
        $offres = Offre::where('user_id', Auth::id())
            ->withCount('candidatures')
            ->with('medias')
            ->latest()
            ->paginate(10);

        return view('enseignant.offres.index', compact('offres'));
    }

    public function createOffre()
    {
        return view('enseignant.offres.create');
    }

    public function storeOffre(Request $request)
    {
        $validated = $request->validate([
            'titre'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'lien_externe'  => 'nullable|url',
            'type_offre'    => 'required|in:stage,emploi,alternance,these',
            'localisation'  => 'nullable|string',
            'date_limite'   => 'nullable|date',
            'medias.*'      => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:51200',
        ]);

        $offre = Offre::create([
            ...$validated,
            'user_id'        => Auth::id(),
            'publisher_type' => 'enseignant',
        ]);

        $this->saveMedias($request, $offre);

        return redirect()
            ->route('enseignant.offres')
            ->with('success', 'Offre publiée avec succès !');
    }

    public function editOffre(Offre $offre)
    {
        $this->authorizeOffre($offre);
        return view('enseignant.offres.edit', compact('offre'));
    }

    public function updateOffre(Request $request, Offre $offre)
    {
        $this->authorizeOffre($offre);

        $validated = $request->validate([
            'titre'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'lien_externe' => 'nullable|url',
            'type_offre'   => 'required|in:stage,emploi,alternance,these',
            'localisation' => 'nullable|string',
            'date_limite'  => 'nullable|date',
        ]);

        $offre->update($validated);

        return redirect()
            ->route('enseignant.offres')
            ->with('success', 'Offre mise à jour.');
    }

    public function destroyOffre(Offre $offre)
    {
        $this->authorizeOffre($offre);
        $offre->delete();

        return redirect()
            ->route('enseignant.offres')
            ->with('success', 'Offre supprimée.');
    }

    // ────────────────────────────────────────────────────────
    // Helpers privés
    // ────────────────────────────────────────────────────────
    private function authorizeEtudiant(Etudiant $etudiant): void
    {
        // L'enseignant ne peut gérer que ses propres étudiants
        abort_unless(
            $etudiant->added_by === Auth::id() || Auth::user()->isSuperAdmin(),
            403
        );
    }

    private function authorizeOffre(Offre $offre): void
    {
        abort_unless($offre->user_id === Auth::id(), 403);
    }

    private function saveMedias(Request $request, Offre $offre): void
    {
        if ($request->hasFile('medias')) {
            foreach ($request->file('medias') as $file) {
                $mime = $file->getMimeType();
                $type = str_starts_with($mime, 'video') ? 'video' : 'image';
                $path = $file->store('offres/medias', 'public');

                OffreMedia::create([
                    'offre_id' => $offre->id,
                    'path'     => $path,
                    'type'     => $type,
                ]);
            }
        }
    }
}