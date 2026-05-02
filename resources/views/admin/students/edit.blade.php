@extends('app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-white mb-6">Modifier l'étudiant</h1>

    @if($errors->any())
        <div class="rounded-3xl bg-red-500/10 border border-red-500/20 p-4 text-red-100 mb-6">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.students.update', $student) }}" class="space-y-5 rounded-3xl bg-white/10 border border-white/10 p-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-300 mb-2">Prénom</label>
            <input name="first_name" type="text" value="{{ old('first_name', $student->prenom) }}" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white" />
        </div>

        <div>
            <label class="block text-gray-300 mb-2">Nom</label>
            <input name="last_name" type="text" value="{{ old('last_name', $student->name) }}" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white" />
        </div>

        <div>
            <label class="block text-gray-300 mb-2">Email</label>
            <input name="email" type="email" value="{{ old('email', $student->email) }}" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white" />
        </div>

        <div>
            <label class="block text-gray-300 mb-2">Numéro d'inscription</label>
            <input name="registration_number" type="text" value="{{ old('registration_number', optional($student->etudiant)->numero_inscription) }}" required class="w-full rounded-3xl border border-white/10 bg-slate-950/80 px-4 py-3 text-white" />
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="rounded-full bg-indigo-500 px-6 py-3 text-white font-semibold hover:bg-indigo-400">Enregistrer</button>
            <a href="{{ route('admin.dashboard') }}" class="text-sky-300">Retour au dashboard</a>
        </div>
    </form>
</div>
@endsection
