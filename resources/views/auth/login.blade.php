<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Connexion | NextLink</title>
    <style>
        /* ========================================
           LOGIN PAGE - PREMIUM DESIGN
           Only CSS/HTML changes, no logic touched
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
          
    background: var(--bg-primary);

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
            padding: 40px 36px;
            transition: all 0.3s ease;
        }
        
        .login-card:hover {
            border-color: rgba(99, 102, 241, 0.3);
        }
        
        /* Logo / Icon */
        .login-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }
        
        .login-icon svg {
            width: 32px;
            height: 32px;
            color: white;
        }
        
        /* Title */
        .login-title {
            font-size: 28px;
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
            color: rgba(156, 163, 175, 0.7);
            font-size: 13px;
            margin-bottom: 28px;
        }
        
        /* Divider */
        .divider-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0 24px 0;
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
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #9ca3af;
            margin-bottom: 6px;
        }
        
        .form-input {
            width: 100%;
            background: rgba(10, 12, 16, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            padding: 12px 16px;
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
        
        /* Password Input with Toggle */
        .password-wrapper {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            font-size: 11px;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .password-toggle:hover {
            color: #a5b4fc;
        }
        
        /* Forgot Link */
        .forgot-link {
            text-align: right;
            margin-top: 6px;
        }
        
        .forgot-link button {
            background: none;
            border: none;
            color: #a5b4fc;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .forgot-link button:hover {
            color: #c7d2fe;
        }
        
        /* Button */
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
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
            border-radius: 14px;
            padding: 12px 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #f87171;
            font-size: 12px;
            font-weight: 500;
        }
        
        /* Footer */
        .login-footer {
            margin-top: 28px;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }
        
        .login-footer p {
            color: #6b7280;
            font-size: 11px;
        }
        
        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .modal-overlay.active {
            display: flex;
        }
        
        .modal-content {
            background: linear-gradient(135deg, #0f1222, #0a0e1a);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 28px;
            width: 90%;
            max-width: 450px;
            position: relative;
        }
        
        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(255, 255, 255, 0.05);
            border: none;
            border-radius: 100px;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #9ca3af;
            transition: all 0.2s;
            font-size: 14px;
        }
        
        .modal-close:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .modal-title {
            font-size: 20px;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .modal-btn {
            width: 100%;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 100px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 16px;
            font-size: 13px;
        }
        
        .modal-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
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
                padding: 28px 20px;
            }
            .login-title {
                font-size: 24px;
            }
            .login-icon {
                width: 52px;
                height: 52px;
            }
            .login-icon svg {
                width: 26px;
                height: 26px;
            }
            .modal-content {
                padding: 20px;
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
    <h1 class="login-title">Connexion</h1>
    <p class="login-subtitle">Connectez-vous à votre espace NextLink</p>
    
    <div class="divider-custom">
        <div class="divider-line"></div>
        <div class="divider-dot"></div>
        <div class="divider-line"></div>
    </div>
    
    {{-- Error Message --}}
    @if(session('error'))
        <div class="error-message">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif
    
    {{-- Login Form --}}
    <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" placeholder="exemple@email.com" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Mot de passe</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password-field" class="form-input" placeholder="••••••••" required>
                <button type="button" id="toggle-password" class="password-toggle">Afficher</button>
            </div>
        </div>
        
        <div class="forgot-link">
            <button type="button" id="open-forgot-modal">Mot de passe oublié ?</button>
        </div>
        
        <button type="submit" class="btn-login">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Se connecter
        </button>
    </form>
    
    <div class="login-footer">
        <p>© {{ date('Y') }} NextLink. Tous droits réservés.</p>
    </div>
</div>

{{-- Forgot Password Modal --}}
<div id="forgot-password-modal" class="modal-overlay">
    <div class="modal-content">
        <button id="close-forgot-modal" class="modal-close">✕</button>
        <h3 class="modal-title">Mot de passe oublié</h3>
        
        @if(session('status'))
            <div class="error-message" style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(34, 197, 94, 0.05)); border-color: rgba(34, 197, 94, 0.25); color: #4ade80;">
                {{ session('status') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="error-message">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('forgot.password.email') }}" class="space-y-4">
            @csrf
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="Votre email" required>
            </div>
            <div class="form-group">
                <label class="form-label">Votre âge</label>
                <input type="number" min="10" max="120" name="age" value="{{ old('age') }}" class="form-input" placeholder="Votre âge" required>
            </div>
            <button type="submit" class="modal-btn">
                Recevoir un nouveau mot de passe
            </button>
        </form>
    </div>
</div>

<script>
    // Toggle password visibility
    const toggleButton = document.getElementById('toggle-password');
    const passwordField = document.getElementById('password-field');
    
    if (toggleButton && passwordField) {
        toggleButton.addEventListener('click', () => {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            toggleButton.textContent = type === 'password' ? 'Afficher' : 'Cacher';
        });
    }
    
    // Modal management
    const modal = document.getElementById('forgot-password-modal');
    const openModal = document.getElementById('open-forgot-modal');
    const closeModal = document.getElementById('close-forgot-modal');
    
    if (openModal && modal) {
        openModal.addEventListener('click', () => {
            modal.classList.add('active');
        });
    }
    
    if (closeModal && modal) {
        closeModal.addEventListener('click', () => {
            modal.classList.remove('active');
        });
    }
    
    // Close modal on outside click
    if (modal) {
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.remove('active');
            }
        });
    }
    
    // Auto-open modal if there are errors
    @if(old('age') || session('status'))
        if (modal) {
            modal.classList.add('active');
        }
    @endif
</script>

</body>
</html>