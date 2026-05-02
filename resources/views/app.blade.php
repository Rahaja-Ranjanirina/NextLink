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
           NEXT LINK - DESIGN SYSTEM WITH DARK/LIGHT MODE
           Modern & Elegant Interface
           ======================================== */
        
        /* ----- Import Fonts ----- */
        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap');
        
        /* ----- CSS Reset & Base ----- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            position: relative;
            min-height: 100vh;
        }
        
        /* ========== THEME VARIABLES ========== */
        
        /* Thème sombre (par défaut) */
        [data-theme="dark"] {
            --bg-primary: #0a0c10;
            --bg-secondary: #0f1322;
            --bg-card: rgba(255, 255, 255, 0.04);
            --bg-card-hover: rgba(255, 255, 255, 0.06);
            --border-color: rgba(255, 255, 255, 0.08);
            --text-primary: #e8edf2;
            --text-secondary: #9ca3af;
            --text-muted: #6b7280;
            --accent-primary: #6366f1;
            --accent-secondary: #8b5cf6;
            --accent-hover: #a5b4fc;
            --success: #4ade80;
            --warning: #fbbf24;
            --error: #f87171;
            --info: #60a5fa;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.3);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 12px 36px rgba(0, 0, 0, 0.5);
            --glass-bg: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        }
        
        /* Thème clair */
        [data-theme="light"] {
            --bg-primary: #f3f4f6;
            --bg-secondary: #ffffff;
            --bg-card: rgba(0, 0, 0, 0.02);
            --bg-card-hover: rgba(0, 0, 0, 0.04);
            --border-color: rgba(0, 0, 0, 0.08);
            --text-primary: #1f2937;
            --text-secondary: #4b5563;
            --text-muted: #9ca3af;
            --accent-primary: #4f46e5;
            --accent-secondary: #7c3aed;
            --accent-hover: #6366f1;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --info: #3b82f6;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 12px 36px rgba(0, 0, 0, 0.1);
            --glass-bg: linear-gradient(135deg, rgba(0, 0, 0, 0.02) 0%, rgba(0, 0, 0, 0.01) 100%);
        }
        
        body {
            background: var(--bg-primary);
            color: var(--text-primary);
        }
        
        /* ----- Theme Toggle Button ----- */
        .theme-toggle {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1000;
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: 100px;
            padding: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-sm);
        }
        
        .theme-toggle:hover {
            transform: scale(1.05);
            border-color: var(--accent-primary);
        }
        
        .theme-toggle svg {
            width: 24px;
            height: 24px;
            transition: transform 0.3s ease;
        }
        
        [data-theme="dark"] .theme-toggle .sun-icon {
            display: block;
        }
        
        [data-theme="dark"] .theme-toggle .moon-icon {
            display: none;
        }
        
        [data-theme="light"] .theme-toggle .sun-icon {
            display: none;
        }
        
        [data-theme="light"] .theme-toggle .moon-icon {
            display: block;
        }
        
        /* ----- Selection Color ----- */
        ::selection {
            background: var(--accent-primary);
            color: white;
        }
        
        ::-moz-selection {
            background: var(--accent-primary);
            color: white;
        }
        
        /* ----- Modern Scrollbar ----- */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(128, 128, 128, 0.1);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--accent-primary);
            border-radius: 10px;
            transition: background 0.2s;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-secondary);
        }
        
        /* ----- Typography Premium ----- */
        h1, h2, h3, h4, .font-serif {
            font-family: 'Playfair Display', serif;
        }
        
        /* ----- Glass Effect Utilities ----- */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            transition: all 0.3s ease;
        }
        
        .glass-card:hover {
            border-color: var(--accent-primary);
            background: var(--bg-card-hover);
        }
        
        /* ----- Button Styles ----- */
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 100px;
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.35);
        }
        
        .btn-secondary {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            font-weight: 500;
            padding: 12px 28px;
            border-radius: 100px;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }
        
        .btn-secondary:hover {
            background: var(--bg-card-hover);
            border-color: var(--accent-primary);
            transform: translateY(-1px);
        }
        
        /* ----- Form Elements ----- */
        .form-input, .form-textarea, .form-select {
            width: 100%;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 12px 18px;
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.2s ease;
        }
        
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }
        
        /* ----- Container ----- */
        .container-custom {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }
        
        /* ----- Status Badges ----- */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .badge-warning {
            background: rgba(245, 158, 11, 0.15);
            color: var(--warning);
            border: 1px solid rgba(245, 158, 11, 0.25);
        }
        
        .badge-success {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
            border: 1px solid rgba(34, 197, 94, 0.25);
        }
        
        .badge-error {
            background: rgba(239, 68, 68, 0.15);
            color: var(--error);
            border: 1px solid rgba(239, 68, 68, 0.25);
        }
        
        /* ----- Animations ----- */
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
            animation: fadeInUp 0.6s ease forwards;
        }
        
        /* ----- Loading State ----- */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid var(--border-color);
            border-top-color: var(--accent-primary);
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* ----- Responsive ----- */
        @media (max-width: 768px) {
            .container-custom {
                padding: 0 16px;
            }
            .theme-toggle {
                bottom: 16px;
                right: 16px;
                padding: 10px;
            }
            .theme-toggle svg {
                width: 20px;
                height: 20px;
            }
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
    
    <!-- Notification Toast Container -->
    <div id="toast-container" style="position: fixed; bottom: 24px; left: 24px; z-index: 1000; display: flex; flex-direction: column; gap: 12px;"></div>
    
    <script>
        // Theme management
        (function() {
            const themeToggle = document.getElementById('themeToggle');
            const htmlElement = document.documentElement;
            
            // Get saved theme or default to 'dark'
            const savedTheme = localStorage.getItem('theme') || 'dark';
            htmlElement.setAttribute('data-theme', savedTheme);
            
            function toggleTheme() {
                const currentTheme = htmlElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                htmlElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                // Optional: Show toast notification
                showToast('Theme changé en ' + (newTheme === 'dark' ? 'mode sombre' : 'mode clair'), 'info');
            }
            
            if (themeToggle) {
                themeToggle.addEventListener('click', toggleTheme);
            }
        })();
        
        // Toast notification system
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;
            
            const toast = document.createElement('div');
            toast.className = 'glass-card px-4 py-3 rounded-xl animate-fade-up';
            toast.style.animation = 'fadeInUp 0.3s ease forwards';
            
            const bgColor = type === 'success' ? 'var(--success)' : (type === 'error' ? 'var(--error)' : 'var(--info)');
            
            toast.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <svg width="16" height="16" fill="none" stroke="${bgColor}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${type === 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'}"/>
                    </svg>
                    <span style="color: var(--text-primary); font-size: 13px; font-weight: 500;">${message}</span>
                </div>
            `;
            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(-30px)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>