<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>NextLink - Connexion Partenaire</title>
    <style>
        /* ========================================
           PARTNER LOGIN - PREMIUM DESIGN
           Modern & Elegant Interface
           ======================================== */
        
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            position: relative;
            background: linear-gradient(145deg, #070b17 0%, #0f1322 50%, #0a0e1a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        /* Background image overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.pexels.com/photos/2653362/pexels-photo-2653362.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=2') center/cover no-repeat;
            opacity: 0.08;
            pointer-events: none;
            z-index: 0;
        }
        
        body::after {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 40%, rgba(99, 102, 241, 0.08) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        
        /* Login Card */
        .login-card {
            position: relative;
            z-index: 1;
            max-width: 440px;
            width: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 32px;
            padding: 48px 40px;
            transition: all 0.3s ease;
        }
        
        .login-card:hover {
            border-color: rgba(99, 102, 241, 0.3);
        }
        
        /* Logo / Icon */
        .login-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }
        
        .login-icon svg {
            width: 36px;
            height: 36px;
            color: white;
        }
        
        /* Title */
        .login-title {
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            background: linear-gradient(135deg, #ffffff 0%, #c7d2fe 50%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }
        
        .login-subtitle {
            text-align: center;
            color: rgba(156, 163, 175, 0.8);
            font-size: 14px;
            margin-bottom: 32px;
        }
        
        /* Divider */
        .divider-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0 28px 0;
        }
        
        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
        }
        
        .divider-dot {
            width: 4px;
            height: 4px;
            background: #6366f1;
            border-radius: 50%;
            opacity: 0.5;
        }
        
        /* Form Elements */
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #9ca3af;
            margin-bottom: 8px;
        }
        
        .form-input {
            width: 100%;
            background: rgba(10, 12, 16, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 14px 18px;
            color: #e8edf2;
            font-size: 14px;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: rgba(10, 12, 16, 0.95);
        }
        
        .form-input::placeholder {
            color: #4b5563;
        }
        
        /* Button */
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 14px 28px;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
            margin-top: 8px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
        }
        
        /* Error Message */
        .error-message {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
            border: 1px solid rgba(239, 68, 68, 0.25);
            border-radius: 16px;
            padding: 14px 18px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #f87171;
            font-size: 13px;
            font-weight: 500;
        }
        
        /* Footer Links */
        .login-footer {
            margin-top: 32px;
            text-align: center;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }
        
        .login-footer a {
            color: #a5b4fc;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s;
        }
        
        .login-footer a:hover {
            color: #c7d2fe;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-up {
            animation: fadeInUp 0.5s ease forwards;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 32px 24px;
            }
            .login-title {
                font-size: 26px;
            }
            .login-icon {
                width: 56px;
                height: 56px;
            }
            .login-icon svg {
                width: 28px;
                height: 28px;
            }
        }
    </style>
</head>
<body>

<div class="login-card animate-fade-up">
    
    {{-- Icon --}}
    <div class="login-icon">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
    </div>
    
    {{-- Title --}}
    <h1 class="login-title">Espace Partenaire</h1>
    <p class="login-subtitle">Connectez-vous à votre espace professionnel</p>
    
    <div class="divider-custom">
        <div class="divider-line"></div>
        <div class="divider-dot"></div>
        <div class="divider-line"></div>
    </div>
    
    {{-- Error Message --}}
    @if(session('error'))
        <div class="error-message">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif
    
    {{-- Login Form --}}
    <form method="POST" action="{{ route('partner.login.submit') }}">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Email professionnel</label>
            <input type="email" name="email" class="form-input" placeholder="contact@entreprise.com" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-input" placeholder="••••••••" required>
        </div>
        
        <button type="submit" class="btn-login">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Se connecter
        </button>
    </form>
    
    <div class="login-footer">
        <a href="{{ route('login') }}">← Retour à l'accueil</a>
    </div>
</div>

</body>
</html>