@extends('app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-white mb-6">Créer un enseignant</h1>

    <form method="POST" action="{{ route('superadmin.enseignants.store') }}" class="space-y-5 rounded-3xl bg-white/10 border border-white/10 p-6">
        @csrf
        <div>
            <label class="block text-gray-300 mb-2">Prénom</label>
            <input name="prenom" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white" />
        </div>
        <div>
            <label class="block text-gray-300 mb-2">Nom</label>
            <input name="name" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white" />
        </div>
        <div>
            <label class="block text-gray-300 mb-2">Email</label>
            <input name="email" type="email" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white" />
        </div>
        <div>
            <label class="block text-gray-300 mb-2">Âge</label>
            <input name="age" type="number" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white" />
        </div>
        <button type="submit" class="rounded-full bg-indigo-500 px-6 py-3 text-white font-semibold hover:bg-indigo-400">Créer l'enseignant</button>
    </form>
</div>
@endsection
