@extends('app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="rounded-3xl bg-white/10 border border-white/10 p-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-white">Visioconférence Jitsi</h1>
                <p class="text-gray-300 mt-2">Vous rejoignez la réunion pour la candidature de <strong>{{ $candidature->offre->titre }}</strong>.</p>
            </div>
            <a href="{{ $returnUrl }}" class="inline-flex items-center gap-2 rounded-full bg-slate-800 px-5 py-3 text-sm text-white hover:bg-slate-700 transition">Retour</a>
        </div>

        <div class="mt-8 rounded-3xl overflow-hidden border border-white/10 bg-black" style="min-height: 70vh;">
            <div id="jitsi-meet-container" class="h-[70vh]"></div>
        </div>

        <div class="mt-4 rounded-3xl bg-slate-950/80 border border-white/10 p-5 text-gray-300">
            <p><strong>Salle :</strong> {{ $roomName }}</p>
            <p><strong>Nom d'affichage :</strong> {{ $displayName }}</p>
        </div>
    </div>
</div>

<script src="https://meet.jit.si/external_api.js"></script>
<script>
    const domain = 'meet.jit.si';
    const options = {
        roomName: @json($roomName),
        width: '100%',
        height: '100%',
        parentNode: document.getElementById('jitsi-meet-container'),
        interfaceConfigOverwrite: {
            TOOLBAR_BUTTONS: [
                'microphone', 'camera', 'desktop', 'fullscreen', 'fodeviceselection',
                'hangup', 'chat', 'raisehand', 'tileview', 'settings', 'videoquality',
                'filmstrip', 'stats', 'shortcuts', 'tileview', 'download'
            ],
        },
        configOverwrite: {
            startWithAudioMuted: true,
            startWithVideoMuted: true,
        },
        userInfo: {
            displayName: @json($displayName),
        }
    };

    try {
        const api = new JitsiMeetExternalAPI(domain, options);
    } catch (error) {
        console.error('Erreur Jitsi:', error);
        document.getElementById('jitsi-meet-container').innerHTML = '<div class="p-8 text-center text-white">Impossible de démarrer la visioconférence. Veuillez réessayer.</div>';
    }
</script>
@endsection
