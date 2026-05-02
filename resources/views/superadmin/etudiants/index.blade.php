@extends('app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-white mb-6">Étudiants</h1>

    @if($etudiants->isEmpty())
        <div class="rounded-3xl bg-white/10 border border-white/10 p-6 text-gray-300">Aucun étudiant dans le tableau de bord.</div>
    @else
        <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/5">
            <table class="min-w-full divide-y divide-white/10 text-left text-sm text-gray-200">
                <thead class="bg-slate-950/80">
                    <tr>
                        <th class="px-4 py-3">Nom</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Inscription</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10 bg-slate-950/70">
                    @foreach($etudiants as $etudiant)
                        <tr>
                            <td class="px-4 py-3">{{ $etudiant->prenom }} {{ $etudiant->name }}</td>
                            <td class="px-4 py-3">{{ $etudiant->email }}</td>
                            <td class="px-4 py-3">{{ $etudiant->etudiant->numero_inscription ?? 'N/A' }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('superadmin.etudiants.edit', $etudiant) }}" class="text-sky-300">Modifier</a>
                                <form method="POST" action="{{ route('superadmin.etudiants.destroy', $etudiant) }}" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-300">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
