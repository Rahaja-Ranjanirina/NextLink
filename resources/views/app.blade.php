<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NextLink - Plateforme étudiante</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        /* ========================================
           NEXTLINK — DESIGN SYSTEM COMPLET
           Dark Mode & Light Mode — Fully Adaptive
           ======================================== */

        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
        }

        /* ==========================================
           THÈME SOMBRE (par défaut)
        ========================================== */
        [data-theme="dark"] {
            --bg-primary:    #0a0c10;
            --bg-secondary:  #0f1322;
            --bg-tertiary:   #0d1020;

            --card-bg:           rgba(255,255,255,0.04);
            --card-bg-hover:     rgba(255,255,255,0.07);
            --card-bg-solid:     #0f1525;
            --card-border:       rgba(255,255,255,0.07);
            --card-border-hover: rgba(99,102,241,0.4);

            --text-primary:   #e8edf2;
            --text-secondary: #9ca3af;
            --text-muted:     #6b7280;
            --text-on-card:   #e8edf2;

            --title-gradient: linear-gradient(135deg,#ffffff 0%,#c7d2fe 50%,#a5b4fc 100%);
            --subtitle-color: rgba(156,163,175,0.85);

            --accent-primary:   #6366f1;
            --accent-secondary: #8b5cf6;
            --accent-hover:     #a5b4fc;
            --accent-light:     rgba(99,102,241,0.15);
            --accent-border:    rgba(99,102,241,0.25);

            --success: #4ade80;
            --warning: #fbbf24;
            --error:   #f87171;
            --info:    #60a5fa;

            --input-bg:          rgba(10,12,16,0.85);
            --input-bg-focus:    rgba(10,12,16,0.98);
            --input-border:      rgba(255,255,255,0.09);
            --input-text:        #e8edf2;
            --input-placeholder: #4b5563;

            --modal-bg:          linear-gradient(135deg,#0f1222 0%,#0a0e1a 100%);
            --modal-border:      rgba(255,255,255,0.10);
            --modal-close-bg:    rgba(255,255,255,0.05);
            --modal-close-hover: rgba(255,255,255,0.12);

            --divider:      rgba(255,255,255,0.07);
            --divider-glow: linear-gradient(90deg,transparent,rgba(255,255,255,0.08),transparent);

            --badge-bg:     rgba(99,102,241,0.15);
            --badge-border: rgba(99,102,241,0.25);
            --badge-text:   #a5b4fc;

            --nav-bg:                 linear-gradient(135deg,rgba(255,255,255,0.04) 0%,rgba(255,255,255,0.01) 100%);
            --nav-link-color:         rgba(255,255,255,0.6);
            --nav-link-hover-bg:      rgba(99,102,241,0.1);
            --nav-link-hover-color:   #c7d2fe;
            --nav-active-bg:          linear-gradient(135deg,rgba(99,102,241,0.15),rgba(139,92,246,0.1));
            --nav-active-color: var(--badge-text);
            --nav-icon-bg:            rgba(255,255,255,0.04);

            --btn-secondary-bg:       rgba(255,255,255,0.04);
            --btn-secondary-border:   rgba(255,255,255,0.09);
            --btn-secondary-color: var(--text-muted);
            --btn-secondary-hover-bg: rgba(255,255,255,0.09);

            --btn-logout-bg:          rgba(239,68,68,0.10);
            --btn-logout-border:      rgba(239,68,68,0.20);
            --btn-logout-color:       #f87171;
            --btn-logout-hover-bg:    rgba(239,68,68,0.20);
            --btn-logout-hover-border:rgba(239,68,68,0.40);

            --scrollbar-track: rgba(255,255,255,0.03);

            --shadow-sm: 0 4px 12px rgba(0,0,0,0.30);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.40);
            --shadow-lg: 0 12px 36px rgba(0,0,0,0.50);

            --glass-bg:     linear-gradient(135deg,rgba(255,255,255,0.04) 0%,rgba(255,255,255,0.01) 100%);
            --glass-border: rgba(255,255,255,0.07);

            --shimmer: linear-gradient(90deg,transparent,rgba(255,255,255,0.03),transparent);
        }

        /* ==========================================
           THÈME CLAIR
        ========================================== */
        [data-theme="light"] {
            --bg-primary:   #f0f2f8;
            --bg-secondary: #ffffff;
            --bg-tertiary:  #e8eaf4;

            --card-bg:           rgba(255,255,255,0.88);
            --card-bg-hover:     rgba(255,255,255,1.0);
            --card-bg-solid:     #ffffff;
            --card-border:       rgba(0,0,0,0.08);
            --card-border-hover: rgba(79,70,229,0.45);

            --text-primary:   #1e2433;
            --text-secondary: #4b5563;
            --text-muted:     #9ca3af;
            --text-on-card:   #1e2433;

            --title-gradient: linear-gradient(135deg,#1e2433 0%,#4f46e5 50%,#7c3aed 100%);
            --subtitle-color: var(--text-secondary);

            --accent-primary:   #4f46e5;
            --accent-secondary: #7c3aed;
            --accent-hover:     #6366f1;
            --accent-light:     rgba(79,70,229,0.12);
            --accent-border:    rgba(79,70,229,0.25);

            --success: #16a34a;
            --warning: #d97706;
            --error:   #dc2626;
            --info:    #2563eb;

            --input-bg:          rgba(255,255,255,0.95);
            --input-bg-focus:    #ffffff;
            --input-border:      rgba(0,0,0,0.12);
            --input-text:        #1e2433;
            --input-placeholder: #9ca3af;

            --modal-bg:          linear-gradient(135deg,#ffffff 0%,#f8fafc 100%);
            --modal-border:      rgba(0,0,0,0.10);
            --modal-close-bg:    rgba(0,0,0,0.05);
            --modal-close-hover: rgba(0,0,0,0.10);

            --divider:      rgba(0,0,0,0.07);
            --divider-glow: linear-gradient(90deg,transparent,rgba(0,0,0,0.07),transparent);

            --badge-bg:     rgba(79,70,229,0.12);
            --badge-border: rgba(79,70,229,0.25);
            --badge-text:   #4f46e5;

            --nav-bg:                 linear-gradient(135deg,rgba(255,255,255,0.92) 0%,rgba(248,250,252,0.85) 100%);
            --nav-link-color:         #4b5563;
            --nav-link-hover-bg:      rgba(79,70,229,0.08);
            --nav-link-hover-color:   #4f46e5;
            --nav-active-bg:          linear-gradient(135deg,rgba(79,70,229,0.12),rgba(124,58,237,0.08));
            --nav-active-color:       #4f46e5;
            --nav-icon-bg:            rgba(0,0,0,0.04);

            --btn-secondary-bg:       rgba(0,0,0,0.04);
            --btn-secondary-border:   rgba(0,0,0,0.10);
            --btn-secondary-color:    #4b5563;
            --btn-secondary-hover-bg: rgba(0,0,0,0.08);

            --btn-logout-bg:          rgba(220,38,38,0.08);
            --btn-logout-border:      rgba(220,38,38,0.20);
            --btn-logout-color:       #dc2626;
            --btn-logout-hover-bg:    rgba(220,38,38,0.15);
            --btn-logout-hover-border:rgba(220,38,38,0.35);

            --scrollbar-track: rgba(0,0,0,0.04);

            --shadow-sm: 0 4px 12px rgba(0,0,0,0.07);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.10);
            --shadow-lg: 0 12px 36px rgba(0,0,0,0.14);

            --glass-bg:     linear-gradient(135deg,rgba(255,255,255,0.92) 0%,rgba(248,250,252,0.85) 100%);
            --glass-border: rgba(0,0,0,0.07);

            --shimmer: linear-gradient(90deg,transparent,rgba(255,255,255,0.5),transparent);
        }

        /* ---- Body ---- */
        body { background: var(--bg-primary); color: var(--text-primary); }

        /* ---- Theme Toggle ---- */
        .theme-toggle {
            position: fixed; bottom: 24px; right: 24px; z-index: 9999;
            background: var(--card-bg); backdrop-filter: blur(12px);
            border: 1px solid var(--card-border); border-radius: 100px;
            padding: 12px; cursor: pointer; transition: all 0.3s ease;
            display: flex; align-items: center; justify-content: center;
            box-shadow: var(--shadow-sm); color: var(--text-secondary);
        }
        .theme-toggle:hover { transform: scale(1.08); border-color: var(--accent-primary); color: var(--accent-primary); }
        .theme-toggle svg { width: 22px; height: 22px; transition: transform 0.4s ease; }

        [data-theme="dark"]  .theme-toggle .sun-icon  { display: block; }
        [data-theme="dark"]  .theme-toggle .moon-icon { display: none; }
        [data-theme="light"] .theme-toggle .sun-icon  { display: none; }
        [data-theme="light"] .theme-toggle .moon-icon { display: block; }

        /* ---- Selection ---- */
        ::selection, ::-moz-selection { background: var(--accent-primary); color: #fff; }

        /* ---- Scrollbar ---- */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: var(--scrollbar-track); border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: var(--accent-primary); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent-secondary); }

        /* ---- Typography ---- */
        h1, h2, h3, h4, .font-serif { font-family: 'Playfair Display', serif; }

        .title-gradient {
            background: var(--title-gradient);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        /* ---- Glass Card ---- */
        .glass-card {
            background: var(--glass-bg); backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border); border-radius: 24px; transition: all 0.3s ease;
        }
        .glass-card:hover { border-color: var(--card-border-hover); background: var(--card-bg-hover); }

        /* ---- Buttons ---- */
        .btn-primary {
            background: linear-gradient(135deg,var(--accent-primary) 0%,var(--accent-secondary) 100%);
            border: none; color: var(--text-primary); font-weight: 600; padding: 12px 28px; border-radius: 100px;
            transition: all 0.3s cubic-bezier(0.2,0.9,0.4,1.1); cursor: pointer;
            display: inline-flex; align-items: center; gap: 8px; font-size: 14px;
            box-shadow: 0 4px 12px rgba(99,102,241,0.25);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(99,102,241,0.35); }

        .btn-secondary {
            background: var(--btn-secondary-bg); border: 1px solid var(--btn-secondary-border);
            color: var(--btn-secondary-color); font-weight: 500; padding: 12px 28px; border-radius: 100px;
            transition: all 0.3s ease; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-size: 14px;
        }
        .btn-secondary:hover { background: var(--btn-secondary-hover-bg); border-color: var(--accent-primary); transform: translateY(-1px); }

        /* ---- Form Elements ---- */
        .form-input, .form-textarea, .form-select {
            width: 100%; background: var(--input-bg); border: 1px solid var(--input-border);
            border-radius: 14px; padding: 12px 18px; color: var(--input-text);
            font-size: 14px; transition: all 0.2s ease; font-family: 'Inter', sans-serif;
        }
        .form-input::placeholder, .form-textarea::placeholder { color: var(--input-placeholder); }
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none; border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12); background: var(--input-bg-focus);
        }
        .form-label {
            display: block; font-size: 11px; font-weight: 600; text-transform: uppercase;
            letter-spacing: 0.5px; color: var(--text-secondary); margin-bottom: 6px;
        }

        /* ---- Container ---- */
        .container-custom { max-width: 1280px; margin: 0 auto; padding: 0 24px; }

        /* ---- Badges ---- */
        .badge { display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 100px; font-size: 12px; font-weight: 500; }
        .badge-warning { background: rgba(245,158,11,0.15); color: var(--warning); border: 1px solid rgba(245,158,11,0.25); }
        .badge-success { background: rgba(34,197,94,0.15);  color: var(--success); border: 1px solid rgba(34,197,94,0.25);  }
        .badge-error   { background: rgba(239,68,68,0.15);  color: var(--error);   border: 1px solid rgba(239,68,68,0.25);  }

        /* ---- Animations ---- */
        @keyframes fadeInUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
        @keyframes spin { to { transform: rotate(360deg); } }
        .animate-fade-up { animation: fadeInUp 0.6s ease forwards; }

        /* ---- Divider ---- */
        .divider-line { flex: 1; height: 1px; background: var(--divider-glow); }
        .divider-dot  { width: 5px; height: 5px; background: var(--accent-primary); border-radius: 50%; opacity: 0.5; }

        /* ==========================================
           GLOBAL OVERRIDES — MODE CLAIR
           Couvrent toutes les vues automatiquement
        ========================================== */

        /* Backgrounds */
        [data-theme="light"] .welcome-bg,
        [data-theme="light"] .partner-bg,
        [data-theme="light"] .dashboard-bg,
        [data-theme="light"] .page-bg { background: var(--bg-primary) !important; }

        [data-theme="light"] .welcome-bg::before,
        [data-theme="light"] .partner-bg::before,
        [data-theme="light"] .dashboard-bg::before,
        [data-theme="light"] .page-bg::before { opacity: 0.04 !important; }

        /* Cards */
        [data-theme="light"] .stat-card,
        [data-theme="light"] .glass-card,
        [data-theme="light"] .premium-card,
        [data-theme="light"] .support-card,
        [data-theme="light"] .user-card,
        [data-theme="light"] .main-content,
        [data-theme="light"] .sidebar-nav,
        [data-theme="light"] .offre-card,
        [data-theme="light"] .login-card,
        [data-theme="light"] .modal-content {
            background: var(--card-bg) !important;
            border-color: var(--card-border) !important;
            box-shadow: var(--shadow-sm);
        }
        [data-theme="light"] .stat-card:hover,
        [data-theme="light"] .glass-card:hover,
        [data-theme="light"] .premium-card:hover,
        [data-theme="light"] .support-card:hover,
        [data-theme="light"] .user-card:hover,
        [data-theme="light"] .offre-card:hover {
            background: var(--card-bg-hover) !important;
            border-color: var(--card-border-hover) !important;
            box-shadow: var(--shadow-md);
        }

        /* Titres (gradient adaptatif) */
        [data-theme="light"] .stat-number,
        [data-theme="light"] .section-title,
        [data-theme="light"] .modal-title,
        [data-theme="light"] .empty-title,
        [data-theme="light"] .user-name,
        [data-theme="light"] .stat-title,
        [data-theme="light"] .greeting-title,
        [data-theme="light"] .partner-title,
        [data-theme="light"] .login-title {
            background: var(--title-gradient) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
        }

        /* Textes secondaires */
        [data-theme="light"] .stat-label,
        [data-theme="light"] .nav-section-title,
        [data-theme="light"] .stat-text,
        [data-theme="light"] .data-label,
        [data-theme="light"] .empty-text,
        [data-theme="light"] .greeting-subtitle,
        [data-theme="light"] .partner-subtitle,
        [data-theme="light"] .login-subtitle,
        [data-theme="light"] .user-email,
        [data-theme="light"] .form-label { color: var(--text-secondary) !important; }

        [data-theme="light"] .stat-text strong,
        [data-theme="light"] .data-value { color: var(--text-primary) !important; }

        /* Nav */
        [data-theme="light"] .nav-link { color: var(--nav-link-color) !important; }
        [data-theme="light"] .nav-link:hover { background: var(--nav-link-hover-bg) !important; color: var(--nav-link-hover-color) !important; }
        [data-theme="light"] .nav-link.active { background: var(--nav-active-bg) !important; color: var(--nav-active-color) !important; border-color: var(--accent-border) !important; }
        [data-theme="light"] .nav-icon { background: var(--nav-icon-bg) !important; }

        /* Logout */
        [data-theme="light"] .logout-btn,
        [data-theme="light"] .btn-logout { background: var(--btn-logout-bg) !important; border-color: var(--btn-logout-border) !important; color: var(--btn-logout-color) !important; }
        [data-theme="light"] .logout-btn:hover,
        [data-theme="light"] .btn-logout:hover { background: var(--btn-logout-hover-bg) !important; border-color: var(--btn-logout-hover-border) !important; }

        /* Inputs */
        [data-theme="light"] input,
        [data-theme="light"] textarea,
        [data-theme="light"] select,
        [data-theme="light"] .form-input,
        [data-theme="light"] .modal-input {
            background: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--input-text) !important;
        }
        [data-theme="light"] input::placeholder,
        [data-theme="light"] textarea::placeholder { color: var(--input-placeholder) !important; }

        /* Modal */
        [data-theme="light"] .modal-content { background: var(--modal-bg) !important; border-color: var(--modal-border) !important; }
        [data-theme="light"] .modal-close { background: var(--modal-close-bg) !important; color: var(--text-secondary) !important; }
        [data-theme="light"] .modal-close:hover { background: var(--modal-close-hover) !important; color: var(--text-primary) !important; }

        /* Dividers */
        [data-theme="light"] .divider-line { background: var(--divider-glow) !important; }
        [data-theme="light"] .section-header,
        [data-theme="light"] .data-row,
        [data-theme="light"] .login-footer,
        [data-theme="light"] .logout-area { border-color: var(--divider) !important; }

        /* Badges */
        [data-theme="light"] .welcome-badge,
        [data-theme="light"] .partner-badge,
        [data-theme="light"] .premium-badge,
        [data-theme="light"] .moderator-badge {
            background: var(--badge-bg) !important;
            border-color: var(--badge-border) !important;
            color: var(--badge-text) !important;
        }

        /* Scrollbar tracks */
        [data-theme="light"] .sidebar-nav::-webkit-scrollbar-track,
        [data-theme="light"] .main-content::-webkit-scrollbar-track { background: var(--scrollbar-track) !important; }

        /* Shimmer */
        [data-theme="light"] .stat-card::before { background: var(--shimmer) !important; }

        /* Login footer */
        [data-theme="light"] .login-footer p { color: var(--text-muted) !important; }

        /* Login card body background */
        [data-theme="light"] body.login-page { background: var(--bg-primary) !important; }

        /* ---- Responsive ---- */
        @media (max-width: 768px) {
            .container-custom { padding: 0 16px; }
            .theme-toggle { bottom: 16px; right: 16px; padding: 10px; }
            .theme-toggle svg { width: 18px; height: 18px; }
        }
    </style>
</head>
<body>
    <main>
        @yield('content')
    </main>

    <!-- Theme Toggle Button -->
    <button class="theme-toggle" id="themeToggle" aria-label="Changer de thème">
        <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
        </svg>
    </button>

    <!-- Toast Container -->
    <div id="toast-container" style="position:fixed;bottom:24px;left:24px;z-index:9998;display:flex;flex-direction:column;gap:12px;"></div>

    <script>
        // ---- Theme management ----
        (function() {
            const html   = document.documentElement;
            const toggle = document.getElementById('themeToggle');
            const saved  = localStorage.getItem('theme') || 'dark';
            html.setAttribute('data-theme', saved);

            if (toggle) {
                toggle.addEventListener('click', () => {
                    const current  = html.getAttribute('data-theme');
                    const next     = current === 'dark' ? 'light' : 'dark';
                    html.setAttribute('data-theme', next);
                    localStorage.setItem('theme', next);
                    showToast(next === 'dark' ? '🌙 Mode sombre activé' : '☀️ Mode clair activé', 'info');
                });
            }
        })();

        // ---- Toast system ----
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;
            const toast = document.createElement('div');
            const color = type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--error)' : 'var(--info)';
            toast.style.cssText = `
                background: var(--card-bg); border: 1px solid var(--card-border);
                backdrop-filter: blur(12px); border-radius: 14px; padding: 12px 16px;
                display: flex; align-items: center; gap: 10px;
                box-shadow: var(--shadow-md); animation: fadeInUp 0.3s ease forwards;
                min-width: 220px;
            `;
            toast.innerHTML = `<span style="color:${color};font-size:16px;">●</span><span style="color:var(--text-primary);font-size:13px;font-weight:500;">${message}</span>`;
            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>