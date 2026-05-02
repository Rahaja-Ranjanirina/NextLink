@extends('app')

@section('content')

<style>
    .login-wrapper {
        max-width: 460px;
        margin: auto;
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(18px);
        border-radius: 22px;
        padding: 45px 40px;
        border: 1px solid rgba(255,255,255,0.12);
        box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        position: relative;
    }

    .login-wrapper h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
        text-align: center;
    }

    .login-wrapper p {
        text-align: center;
        font-size: 14px;
        color: var(--text-dim);
        margin-bottom: 35px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #cbd5f5;
    }

    .form-group input {
        width: 100%;
        padding: 15px 18px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.15);
        background: rgba(255,255,255,0.08);
        color: #fff;
        font-size: 15px;
        outline: none;
        transition: 0.3s;
    }

    .form-group input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 2px rgba(0,210,255,0.2);
    }

    .login-btn {
        width: 100%;
        padding: 16px;
        border-radius: 14px;
        border: none;
        background: linear-gradient(135deg, var(--accent), #4facfe);
        color: #04081a;
        font-weight: 800;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.3s;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        background: #ffffff;
    }

    .info-box {
        margin-top: 28px;
        background: rgba(226, 176, 74, 0.1);
        border: 1px solid rgba(226, 176, 74, 0.35);
        padding: 14px 16px;
        border-radius: 12px;
        font-size: 13px;
        color: #f5deb3;
        text-align: center;
    }

    /* Liens bas de formulaire */
    .login-links {
        display: flex;
        justify-content: space-between;
        margin-top: 18px;
        font-size: 13px;
    }

    .login-links a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
    }

    .login-links a:hover {
        text-decoration: underline;
    }

</style>

<div class="login-wrapper">
    <h2>Connexion Étudiant</h2>
    <p>
        Accédez à la plateforme NextLink avec
        les identifiants envoyés par email.
    </p>

    <form method="POST" action="#">
        @csrf

        <div class="form-group">
            <label>Email universitaire</label>
            <input type="email" name="email" placeholder="exemple@email.com" required>
        </div>

        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" placeholder="Mot de passe" required>
        </div>

        <button class="login-btn">Se connecter</button>

        <div class="login-links">
            <a href="{{ url('/') }}">← Retour à l'interface principale</a>
            <a href="{{ route('forgot.password.request') }}">Mot de passe oublié ?</a>
        </div>
    </form>



@endsection
