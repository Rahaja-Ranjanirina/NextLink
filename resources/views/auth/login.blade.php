<!DOCTYPE html>
<html lang="fr" id="login-html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Connexion | NextLink</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');

        * { margin:0; padding:0; box-sizing:border-box; }

        /* ---- Variables Dark (défaut) ---- */
        [data-theme="dark"] {
            --bg-primary:    #0a0c10;
            --card-bg:       rgba(255,255,255,0.04);
            --card-border:   rgba(255,255,255,0.07);
            --card-border-hover: rgba(99,102,241,0.3);
            --text-primary:  #e8edf2;
            --text-secondary:#9ca3af;
            --text-muted:    #6b7280;
            --input-bg:      rgba(10,12,16,0.85);
            --input-border:  rgba(255,255,255,0.09);
            --input-text:    #e8edf2;
            --input-placeholder: #4b5563;
            --modal-bg:      linear-gradient(135deg,#0f1222 0%,#0a0e1a 100%);
            --modal-border:  rgba(255,255,255,0.10);
            --divider-glow:  linear-gradient(90deg,transparent,rgba(255,255,255,0.08),transparent);
            --title-gradient:linear-gradient(135deg,#ffffff 0%,#c7d2fe 50%,#a5b4fc 100%);
            --accent-primary:#6366f1;
            --accent-secondary:#8b5cf6;
            --shadow-sm: 0 4px 12px rgba(0,0,0,0.30);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.40);
            --toggle-bg:     rgba(255,255,255,0.04);
            --toggle-border: rgba(255,255,255,0.07);
            --footer-border: rgba(255,255,255,0.07);
            --footer-color: var(--text-secondary);
            --scrollbar-track: rgba(255,255,255,0.03);
        }

        /* ---- Variables Light ---- */
        [data-theme="light"] {
            --bg-primary:    #f0f2f8;
            --card-bg:       rgba(255,255,255,0.92);
            --card-border:   rgba(0,0,0,0.08);
            --card-border-hover: rgba(79,70,229,0.35);
            --text-primary:  #1e2433;
            --text-secondary:#4b5563;
            --text-muted:    #9ca3af;
            --input-bg:      rgba(255,255,255,0.95);
            --input-border:  rgba(0,0,0,0.12);
            --input-text:    #1e2433;
            --input-placeholder: #9ca3af;
            --modal-bg:      linear-gradient(135deg,#ffffff 0%,#f8fafc 100%);
            --modal-border:  rgba(0,0,0,0.10);
            --divider-glow:  linear-gradient(90deg,transparent,rgba(0,0,0,0.07),transparent);
            --title-gradient:linear-gradient(135deg,#1e2433 0%,#4f46e5 50%,#7c3aed 100%);
            --accent-primary:#4f46e5;
            --accent-secondary:#7c3aed;
            --shadow-sm: 0 4px 12px rgba(0,0,0,0.07);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.10);
            --toggle-bg:     rgba(0,0,0,0.04);
            --toggle-border: rgba(0,0,0,0.08);
            --footer-border: rgba(0,0,0,0.07);
            --footer-color: var(--text-muted);
            --scrollbar-track: rgba(0,0,0,0.04);
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: var(--bg-primary);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed; top:0; left:0; right:0; bottom:0;
            background: url('https://images.pexels.com/photos/2653362/pexels-photo-2653362.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=2') center/cover no-repeat;
            opacity: var(--bg-overlay-image-opacity, 0.08);
            pointer-events: none; z-index: 0;
            transition: opacity 0.3s ease;
        }

        [data-theme="light"] body::before { opacity: 0.04; }

        body::after {
            content: '';
            position: fixed; top:-50%; left:-50%; width:200%; height:200%;
            background: radial-gradient(circle at 30% 40%, var(--accent-light) 0%, transparent 50%);
            pointer-events: none; z-index: 0;
        }

        /* ---- Theme Toggle ---- */
        .theme-toggle {
            position: fixed; bottom: 24px; right: 24px; z-index: 9999;
            background: var(--toggle-bg); backdrop-filter: blur(12px);
            border: 1px solid var(--toggle-border); border-radius: 100px;
            padding: 11px; cursor: pointer; transition: all 0.3s ease;
            display: flex; align-items: center; justify-content: center;
            box-shadow: var(--shadow-sm); color: var(--text-secondary);
        }
        .theme-toggle:hover { transform: scale(1.08); border-color: var(--accent-primary); color: var(--accent-primary); }
        .theme-toggle svg { width: 20px; height: 20px; }

        [data-theme="dark"]  .sun-icon  { display: block; }
        [data-theme="dark"]  .moon-icon { display: none; }
        [data-theme="light"] .sun-icon  { display: none; }
        [data-theme="light"] .moon-icon { display: block; }

        /* ---- Login Card ---- */
        .login-card {
            position: relative; z-index: 1;
            max-width: 440px; width: 100%;
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--card-border);
            border-radius: 32px; padding: 40px 36px;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }
        .login-card:hover { border-color: var(--card-border-hover); }

        .login-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px; box-shadow: 0 8px 20px rgba(99,102,241,0.3);
        }
        .login-icon svg { width: 32px; height: 32px; color: var(--text-primary); }

        .login-title {
            font-size: 28px; font-weight: 700; text-align: center;
            background: var(--title-gradient);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            margin-bottom: 8px;
        }

        .login-subtitle { text-align: center; color: var(--text-secondary); font-size: 13px; margin-bottom: 28px; }

        .divider-custom { display: flex; align-items: center; gap: 12px; margin: 20px 0 24px 0; }
        .divider-line { flex: 1; height: 1px; background: var(--divider-glow); }
        .divider-dot  { width: 4px; height: 4px; background: var(--accent-primary); border-radius: 50%; opacity: 0.5; }

        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block; font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px;
            color: var(--text-secondary); margin-bottom: 6px;
        }

        .form-input {
            width: 100%; background: var(--input-bg);
            border: 1px solid var(--input-border); border-radius: 14px;
            padding: 12px 16px; color: var(--input-text); font-size: 14px;
            transition: all 0.2s ease; font-family: 'Inter', sans-serif;
        }
        .form-input::placeholder { color: var(--input-placeholder); }
        .form-input:focus {
            outline: none; border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }

        .password-wrapper { position: relative; }
        .password-toggle {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; color: var(--text-secondary);
            font-size: 11px; font-weight: 500; cursor: pointer; transition: color 0.2s;
        }
        .password-toggle:hover { color: var(--accent-primary); }

        .forgot-link { text-align: right; margin-top: 6px; }
        .forgot-link button {
            background: none; border: none; color: var(--accent-primary);
            font-size: 12px; font-weight: 500; cursor: pointer; transition: color 0.2s;
        }
        .forgot-link button:hover { color: var(--accent-secondary); }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg,var(--accent-primary) 0%,var(--accent-secondary) 100%);
            border: none; color: var(--text-primary); font-weight: 600;
            padding: 12px 24px; border-radius: 100px;
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            font-size: 13px; cursor: pointer;
            transition: all 0.3s cubic-bezier(0.2,0.9,0.4,1.1);
            box-shadow: 0 4px 12px rgba(99,102,241,0.25); margin-top: 8px;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(99,102,241,0.40); }

        .error-message {
            background: rgba(239,68,68,0.10); border: 1px solid rgba(239,68,68,0.25);
            border-radius: 14px; padding: 12px 16px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px; color: #f87171; font-size: 12px; font-weight: 500;
        }

        .login-footer {
            margin-top: 28px; text-align: center; padding-top: 20px;
            border-top: 1px solid var(--footer-border);
        }
        .login-footer p { color: var(--footer-color); font-size: 11px; }

        /* ---- Modal ---- */
        .modal-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.7); backdrop-filter: blur(4px);
            z-index: 1000; align-items: center; justify-content: center; padding: 20px;
        }
        .modal-overlay.active { display: flex; }

        .modal-content {
            background: var(--modal-bg); border: 1px solid var(--modal-border);
            border-radius: 24px; padding: 28px; width: 90%; max-width: 450px; position: relative;
            box-shadow: var(--shadow-md);
        }

        .modal-close {
            position: absolute; top: 16px; right: 16px;
            background: var(--btn-secondary-bg); border: none; border-radius: 100px;
            width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--text-secondary); transition: all 0.2s; font-size: 14px;
        }
        [data-theme="light"] .modal-close { background: rgba(0,0,0,0.05); }
        .modal-close:hover { color: var(--text-primary); }

        .modal-title {
            font-size: 20px; font-weight: 700; color: var(--text-primary);
            margin-bottom: 20px; text-align: center;
        }

        .modal-btn {
            width: 100%;
            background: linear-gradient(135deg,var(--accent-primary) 0%,var(--accent-secondary) 100%);
            border: none; color: var(--text-primary); font-weight: 600;
            padding: 10px 20px; border-radius: 100px; cursor: pointer;
            transition: all 0.3s ease; margin-top: 16px; font-size: 13px;
        }
        .modal-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(99,102,241,0.35); }

        /* ---- Animations ---- */
        @keyframes fadeInUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
        .animate-fade-up { animation: fadeInUp 0.5s ease forwards; }

        /* ---- Scrollbar ---- */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--scrollbar-track); border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: var(--accent-primary); border-radius: 10px; }

        /* ---- Responsive ---- */
        @media (max-width: 480px) {
            .login-card { padding: 28px 20px; border-radius: 24px; }
            .login-title { font-size: 24px; }
            .login-icon { width: 52px; height: 52px; }
            .login-icon svg { width: 26px; height: 26px; }
            .modal-content { padding: 20px; }
            .theme-toggle { bottom: 16px; right: 16px; }
        }
    </style>
</head>
<body>

    <!-- Theme Toggle Button -->
    <button class="theme-toggle" id="themeToggle" aria-label="Changer de thème">
        <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
        </svg>
    </button>

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
    // Theme toggle management
    (function() {
        const toggle = document.getElementById('themeToggle');
        const html = document.getElementById('login-html');
        const saved = localStorage.getItem('theme') || 'dark';
        html.setAttribute('data-theme', saved);

        if (toggle) {
            toggle.addEventListener('click', () => {
                const current = html.getAttribute('data-theme');
                const next = current === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-theme', next);
                localStorage.setItem('theme', next);
            });
        }
    })();
</script>

</body>
</html>