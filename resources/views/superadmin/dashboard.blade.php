@extends('app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-white mb-6">Tableau de bord Superadmin</h1>
    <div class="grid gap-6 lg:grid-cols-3 mb-8">
        <div class="rounded-3xl bg-white/10 border border-white/10 p-6">
            <h2 class="text-xl font-semibold text-white mb-2">Enseignants</h2>
            <p class="text-indigo-300 text-4xl">{{ $stats['enseignants'] ?? 0 }}</p>
        </div>
        <div class="rounded-3xl bg-white/10 border border-white/10 p-6">
            <h2 class="text-xl font-semibold text-white mb-2">Étudiants</h2>
            <p class="text-indigo-300 text-4xl">{{ $stats['etudiants'] ?? 0 }}</p>
        </div>
        <div class="rounded-3xl bg-white/10 border border-white/10 p-6">
            <h2 class="text-xl font-semibold text-white mb-2">Entreprises</h2>
            <p class="text-indigo-300 text-4xl">{{ $stats['entreprises'] ?? 0 }}</p>
        </div>
    </div>
    <div class="grid gap-6 lg:grid-cols-2">
        <a href="{{ route('superadmin.enseignants') }}" class="rounded-3xl bg-white/10 border border-white/10 p-6 hover:bg-white/15 transition">
            <h3 class="text-xl font-semibold text-white">Gestion des enseignants</h3>
            <p class="text-gray-300 mt-2">Ajoutez, modifiez ou supprimez un enseignant.</p>
        </a>
        <a href="{{ route('superadmin.etudiants') }}" class="rounded-3xl bg-white/10 border border-white/10 p-6 hover:bg-white/15 transition">
            <h3 class="text-xl font-semibold text-white">Gestion des étudiants</h3>
            <p class="text-gray-300 mt-2">Consultez et modifiez les étudiants.</p>
        </a>
    </div>
</div>
@endsection
