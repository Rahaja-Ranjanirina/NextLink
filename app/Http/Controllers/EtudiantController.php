<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Notification;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EtudiantController extends Controller
{
    // ────────────────────────────────────────────────────────
    // Dashboard & Offres
    // ────────────────────────────────────────────────────────
    public function dashboard()
    {
        $offres = Offre::where('is_active', '=', true, 'and')
            ->with(['publisher', 'medias'])
            ->latest()
            ->paginate(10);

        $mesCandidatures = Candidature::where('etudiant_id', '=', Auth::id(), 'and')
            ->with('offre.publisher')
            ->latest()
            ->get();

        $activeJitsiMeetings = Notification::where('user_id', '=', Auth::id(), 'and')
            ->where('type', '=', 'jitsi_meeting', 'and')
            ->where('is_read', '=', false, 'and')
            ->with(['notifiable.offre.publisher'])
            ->get();

        // Liste communauté (étudiants + enseignants) pour les étudiants du système
        $etudiants = \App\Models\User::where('role', '=', 'etudiant', 'and')
            ->with('etudiant')
            ->orderByDesc('id')
            ->get();

        $enseignants = \App\Models\User::where('role', '=', 'enseignant', 'and')
            ->orderByDesc('id')
            ->get();

        return view('student.dashboard', compact('offres', 'mesCandidatures', 'activeJitsiMeetings', 'etudiants', 'enseignants'));
    }

    public function offres()
    {
        $offres = Offre::where('is_active', '=', true, 'and')
            ->with(['publisher', 'medias'])
            ->latest()
            ->paginate(12);

        $offresPostulees = Candidature::where('etudiant_id', '=', Auth::id(), 'and')
            ->pluck('offre_id')
            ->toArray();

        return view('student.offres.index', compact('offres', 'offresPostulees'));
    }

    public function showOffre(Offre $offre)
    {
        $offre->load(['publisher', 'medias', 'candidatures']);
        $dejaPostule = Candidature::where('offre_id', '=', $offre->id, 'and')
            ->where('etudiant_id', '=', Auth::id(), 'and')
            ->exists();

        return view('student.offres.show', compact('offre', 'dejaPostule'));
    }

    // ────────────────────────────────────────────────────────
    // Postuler
    // ────────────────────────────────────────────────────────
    public function postuler(Request $request, Offre $offre)
    {
        // Vérifier qu'il n'a pas déjà postulé
        if (Candidature::where('offre_id', '=', $offre->id, 'and')->where('etudiant_id', '=', Auth::id(), 'and')->exists()) {
            return back()->with('error', 'Vous avez déjà postulé à cette offre.');
        }

        $validated = $request->validate([
            'message'          => 'nullable|string|max:2000',
            'cv'               => 'nullable|file|mimes:pdf|max:5120',
            'lettre_motivation' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $cvPath = null;
        $lmPath = null;

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('candidatures/cv', 'public');
        }

        if ($request->hasFile('lettre_motivation')) {
            $lmPath = $request->file('lettre_motivation')->store('candidatures/lm', 'public');
        }

        $candidature = Candidature::create([
            'offre_id'          => $offre->id,
            'etudiant_id'       => Auth::id(),
            'message'           => $validated['message'] ?? null,
            'cv'                => $cvPath,
            'lettre_motivation' => $lmPath,
        ]);

        // Notifier le publisher de l'offre
        Notification::createForUser(
            $offre->user_id,
            'nouvelle_candidature',
            Auth::user()->full_name . ' a postulé à votre offre "' . $offre->titre . '"',
            $candidature
        );

        return redirect()
            ->route('student.offres')
            ->with('success', 'Candidature envoyée avec succès !');
    }

    // ────────────────────────────────────────────────────────
    // Profil étudiant
    // ────────────────────────────────────────────────────────
    public function profil()
    {
        $user     = Auth::user()->load('etudiant');
        $etudiant = $user->etudiant;

        return view('student.profil', compact('user', 'etudiant'));
    }

    public function updateProfil(Request $request)
    {
        $user     = Auth::user();
        $etudiant = $user->etudiant;

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'prenom'      => 'required|string|max:255',
            'age'         => 'nullable|integer',
            'phone'       => 'nullable|string|max:20',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'bio'         => 'nullable|string|max:1000',
            'filiere'     => 'nullable|string',
            'niveau'      => 'nullable|string',
            'linkedin'    => 'nullable|url',
            'github'      => 'nullable|url',
            'competences' => 'nullable|string', // CSV ou JSON string
            'langues'     => 'nullable|string',
        ]);

        // Photo de profil
        if ($request->hasFile('photo')) {
            if ($user->photo) Storage::disk('public')->delete($user->photo);
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $user->update([
            'name'   => $validated['name'],
            'prenom' => $validated['prenom'],
            'age'    => $validated['age'] ?? $user->age,
            'phone'  => $validated['phone'] ?? $user->phone,
            'photo'  => $validated['photo'] ?? $user->photo,
        ]);

        // Compétences : on accepte une chaîne séparée par virgules
        $competences = array_filter(array_map('trim', explode(',', $validated['competences'] ?? '')));
        $langues     = array_filter(array_map('trim', explode(',', $validated['langues'] ?? '')));

        $etudiant->update([
            'bio'              => $validated['bio'] ?? $etudiant->bio,
            'filiere'          => $validated['filiere'] ?? $etudiant->filiere,
            'niveau'           => $validated['niveau'] ?? $etudiant->niveau,
            'linkedin'         => $validated['linkedin'] ?? $etudiant->linkedin,
            'github'           => $validated['github'] ?? $etudiant->github,
            'competences'      => $competences ?: $etudiant->competences,
            'langues'          => $langues ?: $etudiant->langues,
            'profile_completed' => true,
        ]);

        return redirect()
            ->route('student.profil')
            ->with('success', 'Profil mis à jour !');
    }

    public function updateExperiences(Request $request)
    {
        $request->validate([
            'experiences'   => 'nullable|array',
            'experiences.*.poste'     => 'required|string',
            'experiences.*.entreprise' => 'required|string',
            'experiences.*.debut'     => 'required|string',
            'experiences.*.fin'       => 'nullable|string',
            'experiences.*.description' => 'nullable|string',
        ]);

        Auth::user()->etudiant->update([
            'experiences' => $request->experiences ?? [],
        ]);

        return back()->with('success', 'Expériences mises à jour.');
    }

    public function updateFormations(Request $request)
    {
        $request->validate([
            'formations'            => 'nullable|array',
            'formations.*.diplome'  => 'required|string',
            'formations.*.ecole'    => 'required|string',
            'formations.*.annee'    => 'required|string',
        ]);

        Auth::user()->etudiant->update([
            'formations' => $request->formations ?? [],
        ]);

        return back()->with('success', 'Formations mises à jour.');
    }

    // ────────────────────────────────────────────────────────
    // Mes Candidatures
    // ────────────────────────────────────────────────────────
    public function mesCandidatures()
    {
        $candidatures = Candidature::where('etudiant_id', '=', Auth::id(), 'and')
            ->with('offre.publisher')
            ->latest()
            ->paginate(10);

        return view('student.candidatures', compact('candidatures'));
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id', '=', Auth::id(), 'and')
            ->latest()
            ->paginate(15);

        return view('student.notifications', compact('notifications'));
    }

    public function markNotificationRead(Notification $notification)
    {
        abort_unless($notification->user_id === Auth::id(), 403);

        $notification->update(['is_read' => true]);

        return back();
    }
}
