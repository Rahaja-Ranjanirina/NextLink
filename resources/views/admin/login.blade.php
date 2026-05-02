
@extends('app')

@section('content')

<div class="login-wrapper">
    <h2>Connexion Administrateur</h2>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>
        <button class="login-btn">Se connecter</button>
    </form>
</div>

@endsection
