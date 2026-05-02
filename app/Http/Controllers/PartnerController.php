<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Notification;
use App\Models\Offre;
use App\Models\OffreMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function dashboard()
    {
        $partner = Auth::guard('partner')->user();

        $offersCount = $partner->offres()->count();
        $unreadNotifications = $partner->notifications()->where('is_read', false)->count();
        $recentOffers = $partner->offres()
            ->withCount('candidatures')
            ->latest()
            ->take(4)
            ->get();

        return view('partner.dashboard', compact('partner', 'offersCount', 'unreadNotifications', 'recentOffers'));
    }

    public function offres()
    {
        $partner = Auth::guard('partner')->user();
        $offres = $partner->offres()
            ->withCount('candidatures')
            ->with('medias')
            ->latest()
            ->paginate(10);

        return view('partner.offres.index', compact('offres'));
    }

    public function createOffre()
    {
        return view('partner.offres.create');
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
            'user_id'        => Auth::guard('partner')->id(),
            'publisher_type' => 'entreprise',
            'is_active'      => true,
        ]);

        $this->saveMedias($request, $offre);

        return redirect()
            ->route('partner.offres')
            ->with('success', 'Offre publiée avec succès !');
    }

    public function candidatures(Offre $offre)
    {
        $this->authorizeOffre($offre);

        $candidatures = $offre->candidatures()
            ->with('etudiant.etudiant')
            ->latest()
            ->paginate(10);

        Notification::where('user_id', Auth::guard('partner')->id())
            ->where('notifiable_type', Candidature::class)
            ->whereIn('notifiable_id', $candidatures->pluck('id')->toArray())
            ->update(['is_read' => true]);

        return view('partner.offres.candidatures', compact('offre', 'candidatures'));
    }

    public function showCandidature(Offre $offre, Candidature $candidature)
    {
        $this->authorizeOffre($offre);
        abort_unless($candidature->offre_id === $offre->id, 404);

        $candidature->load('etudiant.etudiant');

        return view('partner.offres.candidature', compact('offre', 'candidature'));
    }

    public function inviteCandidature(Request $request, Offre $offre, Candidature $candidature)
    {
        $this->authorizeOffre($offre);
        abort_unless($candidature->offre_id === $offre->id, 404);

        $validated = $request->validate([
            'interview_date' => 'nullable|date',
            'interview_time' => 'nullable|string|max:10',
            'interview_location' => 'nullable|string|max:255',
            'interview_zoom_link' => 'nullable|url|max:1000',
            'partner_message' => 'nullable|string|max:2000',
        ]);

        $candidature->update([
            'interview_date' => $validated['interview_date'] ?? null,
            'interview_time' => $validated['interview_time'] ?? null,
            'interview_location' => $validated['interview_location'] ?? null,
            'interview_zoom_link' => $validated['interview_zoom_link'] ?? null,
            'partner_message' => $validated['partner_message'] ?? null,
            'is_read' => true,
            'statut' => 'vue',
        ]);

        $message = 'Votre candidature pour "' . $offre->titre . '" a reçu une réponse de l’entreprise.';
        if (! empty($validated['partner_message'])) {
            $message .= ' ' . Str::limit($validated['partner_message'], 120);
        }

        Notification::createForUser(
            $candidature->etudiant_id,
            'reponse_candidature',
            $message,
            $candidature
        );

        return back()->with('success', 'La proposition d’entretien a bien été envoyée.');
    }

    public function notifications()
    {
        $partner = Auth::guard('partner')->user();
        $notifications = $partner->notifications()
            ->with('notifiable.offre', 'notifiable.etudiant')
            ->latest()
            ->paginate(15);

        return view('partner.notifications', compact('notifications'));
    }

    public function markNotificationRead(Notification $notification)
    {
        abort_unless($notification->user_id === Auth::guard('partner')->id(), 403);

        $notification->update(['is_read' => true]);

        return back();
    }

    public function downloadCandidature(Candidature $candidature, string $type)
    {
        $this->authorizeOffre($candidature->offre);

        if (! in_array($type, ['cv', 'lettre_motivation'], true)) {
            abort(404);
        }

        $path = $candidature->{$type};

        abort_unless($path, 404);

        return response()->download(storage_path('app/public/' . $path));
    }

    private function authorizeOffre(Offre $offre): void
    {
        abort_unless($offre->user_id === Auth::guard('partner')->id(), 403);
    }

    private function saveMedias(Request $request, Offre $offre): void
    {
        if (! $request->hasFile('medias')) {
            return;
        }

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
