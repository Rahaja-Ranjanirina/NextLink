<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Notification;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function partnerJoinJitsi(Offre $offre, Candidature $candidature)
    {
        $this->authorizePartnerCandidature($offre, $candidature);

        $partner = Auth::guard('partner')->user();
        $partnerName = $partner ? trim($partner->prenom . ' ' . $partner->name) : 'Recruteur';

        return view('meet.jitsi', [
            'candidature' => $candidature,
            'roomName' => $this->meetingRoomName($candidature),
            'displayName' => $partnerName,
            'returnUrl' => route('partner.candidatures.show', ['offre' => $offre, 'candidature' => $candidature]),
        ]);
    }

    public function startJitsiMeeting(Offre $offre, Candidature $candidature)
    {
        $this->authorizePartnerCandidature($offre, $candidature);

        $partner = Auth::guard('partner')->user();

        Notification::createForUser(
            $candidature->etudiant_id,
            'jitsi_meeting',
            $partner->full_name . ' a lancé une visioconférence Jitsi pour votre candidature à "' . $offre->titre . '".',
            $candidature
        );

        return redirect()->route('partner.candidatures.jitsi', ['offre' => $offre, 'candidature' => $candidature]);
    }

    public function studentJoinJitsi(Candidature $candidature)
    {
        abort_unless($candidature->etudiant_id === Auth::id(), 403);

        // Mark the Jitsi meeting notification as read
        Notification::where('user_id', Auth::id())
            ->where('type', 'jitsi_meeting')
            ->where('notifiable_id', $candidature->id)
            ->where('notifiable_type', get_class($candidature))
            ->update(['is_read' => true]);

        return view('meet.jitsi', [
            'candidature' => $candidature,
            'roomName' => $this->meetingRoomName($candidature),
            'displayName' => Auth::user()->full_name ?? 'Étudiant',
            'returnUrl' => route('student.candidatures'),
        ]);
    }

    private function authorizePartnerCandidature(Offre $offre, Candidature $candidature): void
    {
        abort_unless($candidature->offre_id === $offre->id, 404);
        abort_unless($offre->user_id === Auth::guard('partner')->id(), 403);
    }

    private function meetingRoomName(Candidature $candidature): string
    {
        return 'NextLink-Candidature-' . $candidature->id;
    }
}
