@extends('app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl text-white font-semibold">Enseignants</h1>
            <p class="text-gray-300">Liste des enseignants du système.</p>
        </div>
        <a href="{{ route('superadmin.enseignants.create') }}" class="rounded-full bg-indigo-500 px-6 py-3 text-white hover:bg-indigo-400">Ajouter un enseignant</a>
    </div>

    @if($enseignants->isEmpty())
        <div class="rounded-3xl bg-white/10 border border-white/10 p-6 text-gray-300">Aucun enseignant enregistré.</div>
    @else
        <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/5">
            <table class="min-w-full divide-y divide-white/10 text-left text-sm text-gray-200">
                <thead class="bg-slate-950/80">
                    <tr>
                        <th class="px-4 py-3">Nom</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Étudiants ajoutés</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10 bg-slate-950/70">
                    @foreach($enseignants as $enseignant)
                        <tr>
                            <td class="px-4 py-3">{{ $enseignant->prenom }} {{ $enseignant->name }}</td>
                            <td class="px-4 py-3">{{ $enseignant->email }}</td>
                            <td class="px-4 py-3">{{ $enseignant->etudiantsAjoutes_count ?? 0 }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('superadmin.enseignants.edit', $enseignant) }}" class="text-sky-300">Modifier</a>
                                <form method="POST" action="{{ route('superadmin.enseignants.destroy', $enseignant) }}" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cet enseignant ?');">
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
