@extends('app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');

    /* ========== RESET ========== */
    * { margin: 0; padding: 0; box-sizing: border-box; }

    html {
        font-size: clamp(11px, 1vw, 14px); /* ← s'adapte à TOUS les écrans */
        -webkit-text-size-adjust: 100%;
        text-size-adjust: 100%;
    }

    html, body { height: 100%; overflow: hidden; }

    /* ========== CONTAINER ========== */
    .dashboard-container {
        height: 100vh;
        width: 100vw;
        position: relative;
        font-family: 'Inter', sans-serif;
        overflow: hidden;
    }

    /* ========== BACKGROUND ========== */
    .dashboard-bg {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 0;
        background: var(--bg-primary);
    }

    .dashboard-bg::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('https://images.pexels.com/photos/2653362/pexels-photo-2653362.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=2') center/cover no-repeat;
        opacity: var(--bg-overlay-image-opacity, 0.08);
        pointer-events: none;
    }

    .dashboard-bg::after {
        content: '';
        position: absolute;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background: radial-gradient(circle at 30% 40%, var(--accent-light) 0%, transparent 50%);
        pointer-events: none;
    }

    /* ========== CONTENT WRAPPER ========== */
    .dashboard-content {
        position: relative;
        z-index: 1;
        height: 100vh;
        width: 100%;
        padding: clamp(12px, 1.5vh, 24px) clamp(16px, 2.5vw, 48px);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    /* ========== WELCOME SECTION ========== */
    .welcome-section {
        flex-shrink: 0;
        margin-bottom: clamp(10px, 1.5vh, 20px);
    }

    .user-avatar-large {
        width: clamp(40px, 3.5vw, 52px);
        height: clamp(40px, 3.5vw, 52px);
        min-width: clamp(40px, 3.5vw, 52px);
        min-height: clamp(40px, 3.5vw, 52px);
        max-width: 52px;
        max-height: 52px;
        background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
        border-radius: clamp(10px, 1vw, 16px);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 24px rgba(99,102,241,0.3);
        overflow: hidden;
        flex-shrink: 0;
    }

    .user-avatar-large img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-avatar-large span {
        font-size: clamp(14px, 1.2vw, 18px);
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1;
    }

    .welcome-badge {
        background: var(--badge-bg);
        border: 1px solid var(--badge-border);
        border-radius: 100px;
        padding: 2px 10px;
        display: inline-block;
        font-size: clamp(8px, 0.6vw, 9px);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--badge-text);
        margin-bottom: 4px;
    }

    .greeting-title {
        font-size: clamp(14px, 1.4vw, 20px);
        font-weight: 800;
        line-height: 1.2;
        background: var(--title-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 2px;
    }

    .greeting-subtitle {
        color: var(--text-secondary);
        font-size: clamp(9px, 0.7vw, 11px);
        font-weight: 400;
    }

    /* ========== LOGOUT ========== */
    .logout-btn {
        background: var(--btn-secondary-bg);
        border: 1px solid var(--btn-secondary-border);
        color: var(--text-secondary);
        transition: all 0.3s ease;
        padding: clamp(4px, 0.4vh, 6px) clamp(12px, 1vw, 18px);
        border-radius: 100px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        backdrop-filter: blur(10px);
        font-size: clamp(10px, 0.7vw, 12px);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .logout-btn:hover {
        background: var(--btn-secondary-hover-bg);
        color: var(--text-primary);
        border-color: var(--card-border-hover);
    }

    /* ========== STATS ========== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, clamp(180px, 18vw, 300px)));
        gap: clamp(10px, 1vw, 16px);
        flex-shrink: 0;
        margin-bottom: clamp(12px, 1.5vh, 20px);
    }

    .stat-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: clamp(14px, 1.2vw, 20px);
        padding: clamp(10px, 1vh, 14px) clamp(12px, 1vw, 16px);
        transition: all 0.4s cubic-bezier(0.2,0.9,0.4,1.1);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover { transform: translateY(-2px); border-color: var(--card-border-hover); }

    /* ← ICONES STATS : TAILLE ABSOLUMENT FIXE */
    .stat-icon-wrapper {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        min-height: 36px !important;
        max-width: 36px !important;
        max-height: 36px !important;
        background: var(--accent-light);
        border-radius: 10px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
        border: 1px solid var(--accent-border);
        flex-shrink: 0 !important;
        flex-grow: 0 !important;
        overflow: hidden;
    }

    .stat-icon-wrapper svg {
        width: 16px !important;
        height: 16px !important;
        min-width: 16px !important;
        min-height: 16px !important;
        max-width: 16px !important;
        max-height: 16px !important;
        flex-shrink: 0 !important;
        display: block !important;
        overflow: hidden;
    }

    .stat-number {
        font-size: clamp(18px, 1.6vw, 24px);
        font-weight: 800;
        background: var(--title-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 2px;
        line-height: 1;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: clamp(8px, 0.6vw, 10px);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-trend {
        font-size: clamp(8px, 0.6vw, 9px);
        color: var(--success);
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    /* ========== MAIN LAYOUT ========== */
    .main-layout {
        display: grid;
        grid-template-columns: clamp(160px, 16vw, 240px) 1fr;
        gap: clamp(12px, 1.2vw, 20px);
        flex: 1;
        min-height: 0;
        overflow: hidden;
    }

    /* ========== SIDEBAR ========== */
    .sidebar-nav {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: clamp(14px, 1.2vw, 20px);
        padding: clamp(10px, 1vh, 14px) clamp(6px, 0.6vw, 10px);
        height: 100%;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .sidebar-nav::-webkit-scrollbar { width: 3px; }
    .sidebar-nav::-webkit-scrollbar-track { background: var(--scrollbar-track); border-radius: 10px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); border-radius: 10px; }

    .nav-section-title {
        font-size: clamp(8px, 0.6vw, 10px);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--text-muted);
        padding: 0 clamp(8px, 0.8vw, 12px);
        margin-bottom: clamp(8px, 0.8vh, 12px);
        margin-top: clamp(10px, 1vh, 16px);
        white-space: nowrap;
    }

    .nav-section-title:first-of-type { margin-top: 0; }

    .nav-link {
        display: flex;
        align-items: center;
        gap: clamp(6px, 0.6vw, 10px);
        padding: clamp(6px, 0.6vh, 8px) clamp(8px, 0.8vw, 12px);
        border-radius: clamp(8px, 0.8vw, 12px);
        color: var(--nav-link-color);
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: clamp(10px, 0.75vw, 12px);
        font-weight: 500;
        margin-bottom: 4px;
        width: 100%;
        background: none;
        border: none;
        cursor: pointer;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .nav-link:hover {
        background: var(--nav-link-hover-bg);
        color: var(--nav-link-hover-color);
        transform: translateX(3px);
    }

    .nav-link.active {
        background: var(--nav-active-bg);
        color: var(--nav-active-color);
        border: 1px solid var(--accent-border);
    }

    /* ← ICONES SIDEBAR : TAILLE ABSOLUMENT FIXE */
    .nav-icon {
        width: 26px !important;
        height: 26px !important;
        min-width: 26px !important;
        min-height: 26px !important;
        max-width: 26px !important;
        max-height: 26px !important;
        display: flex !important;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: var(--nav-icon-bg);
        flex-shrink: 0 !important;
        flex-grow: 0 !important;
        overflow: hidden;
    }

    .nav-icon svg {
        width: 12px !important;
        height: 12px !important;
        min-width: 12px !important;
        min-height: 12px !important;
        max-width: 12px !important;
        max-height: 12px !important;
        flex-shrink: 0 !important;
        display: block !important;
        overflow: hidden;
    }

    /* ========== MAIN CONTENT ========== */
    .main-content {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: clamp(14px, 1.2vw, 20px);
        padding: clamp(14px, 1.5vw, 20px);
        height: 100%;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .main-content::-webkit-scrollbar { width: 4px; }
    .main-content::-webkit-scrollbar-track { background: var(--scrollbar-track); border-radius: 10px; }
    .main-content::-webkit-scrollbar-thumb { background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); border-radius: 10px; }

    /* ========== SECTION HEADER ========== */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: clamp(12px, 1.5vh, 20px);
        padding-bottom: clamp(8px, 1vh, 12px);
        border-bottom: 1px solid var(--divider);
    }

    .section-title {
        font-size: clamp(13px, 1.1vw, 17px);
        font-weight: 700;
        background: var(--title-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ========== BADGES ========== */
    .moderator-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: rgba(245,158,11,0.15);
        border: 1px solid rgba(245,158,11,0.3);
        border-radius: 100px;
        padding: 2px 8px;
        font-size: clamp(8px, 0.6vw, 9px);
        font-weight: 600;
        color: var(--warning);
        margin-left: 8px;
        white-space: nowrap;
        flex-shrink: 0;
    }

    /* ========== USER CARDS ========== */
    .users-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(clamp(200px, 18vw, 280px), 1fr));
        gap: clamp(10px, 1vw, 16px);
    }

    .user-card {
        background: var(--btn-secondary-bg);
        border: 1px solid var(--btn-secondary-border);
        border-radius: clamp(12px, 1vw, 16px);
        padding: clamp(10px, 1vw, 14px);
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: clamp(8px, 0.8vw, 12px);
        position: relative;
        overflow: hidden;
    }

    .user-card:hover {
        border-color: var(--card-border-hover);
        transform: translateY(-2px);
        background: var(--btn-secondary-hover-bg);
    }

    /* ← AVATAR FIXE */
    .user-avatar {
        width: 40px !important;
        height: 40px !important;
        min-width: 40px !important;
        min-height: 40px !important;
        max-width: 40px !important;
        max-height: 40px !important;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        display: flex !important;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        flex-shrink: 0 !important;
        flex-grow: 0 !important;
        overflow: hidden;
    }

    .user-avatar img { width: 40px; height: 40px; object-fit: cover; }

    .user-info { flex: 1; min-width: 0; overflow: hidden; }

    .user-name {
        font-size: clamp(11px, 0.85vw, 13px);
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 3px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .user-email {
        font-size: clamp(9px, 0.7vw, 11px);
        color: var(--text-secondary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-role {
        font-size: clamp(9px, 0.65vw, 10px);
        color: var(--accent-hover);
        margin-top: 3px;
        display: inline-block;
    }

    /* ← MESSAGE ICON FIXE */
    .message-icon {
        width: 28px !important;
        height: 28px !important;
        min-width: 28px !important;
        min-height: 28px !important;
        max-width: 28px !important;
        max-height: 28px !important;
        background: var(--accent-light);
        border-radius: 8px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        flex-shrink: 0 !important;
        flex-grow: 0 !important;
        overflow: hidden;
    }

    .message-icon svg {
        width: 13px !important;
        height: 13px !important;
        max-width: 13px !important;
        max-height: 13px !important;
        color: var(--accent-hover);
        flex-shrink: 0 !important;
        display: block !important;
    }

    .user-card:hover .message-icon { background: rgba(99,102,241,0.3); }

    /* ========== DELETE BUTTON ========== */
    .delete-btn {
        background: var(--btn-logout-bg);
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s ease;
        display: flex !important;
        align-items: center;
        justify-content: center;
        color: var(--error);
        flex-shrink: 0 !important;
        flex-grow: 0 !important;
        margin-left: 4px;
        width: 30px !important;
        height: 30px !important;
        min-width: 30px !important;
        max-width: 30px !important;
        padding: 0;
        overflow: hidden;
    }

    .delete-btn:hover { background: var(--btn-logout-hover-bg); color: var(--btn-logout-color); }

    .delete-btn svg {
        width: 14px !important;
        height: 14px !important;
        max-width: 14px !important;
        max-height: 14px !important;
        flex-shrink: 0 !important;
        display: block !important;
    }

    /* ========== MODAL ========== */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(4px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-overlay.active { display: flex; }

    .modal-content {
        background: var(--modal-bg);
        border: 1px solid var(--modal-border);
        border-radius: 20px;
        padding: clamp(20px, 2vw, 28px);
        width: 100%;
        max-width: 480px;
    }

    .modal-title { font-size: clamp(15px, 1.2vw, 18px); font-weight: 700; color: var(--text-primary); margin-bottom: 18px; }

    .modal-input {
        width: 100%;
        background: var(--input-bg);
        border: 1px solid var(--input-border);
        border-radius: 12px;
        padding: 10px 14px;
        color: var(--input-text);
        margin-bottom: 12px;
        font-size: clamp(11px, 0.85vw, 13px);
    }

    .modal-buttons { display: flex; gap: 10px; justify-content: flex-end; margin-top: 18px; }

    .btn-cancel {
        background: var(--modal-close-bg);
        border: 1px solid var(--modal-border);
        border-radius: 100px;
        padding: 8px 18px;
        color: var(--text-secondary);
        cursor: pointer;
        font-size: clamp(11px, 0.85vw, 13px);
    }

    .btn-save {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border: none;
        border-radius: 100px;
        padding: 8px 22px;
        color: var(--text-primary);
        font-weight: 600;
        cursor: pointer;
        font-size: clamp(11px, 0.85vw, 13px);
    }

    /* ========== EMPTY STATE ========== */
    .empty-state { text-align: center; padding: clamp(24px, 4vh, 48px) 24px; }

    .empty-icon {
        width: 52px; height: 52px;
        background: var(--nav-icon-bg);
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 12px;
    }

    .empty-icon svg { width: 26px; height: 26px; color: var(--text-muted); }
    .empty-title { font-size: clamp(13px, 1vw, 15px); font-weight: 600; color: var(--text-primary); margin-bottom: 6px; }
    .empty-text { font-size: clamp(11px, 0.8vw, 13px); color: var(--text-secondary); }

    /* ========== ANIMATIONS ========== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }

    .pulse { animation: pulse 2s ease-in-out infinite; }

    /* ============================================
       RESPONSIVE MOBILE UNIQUEMENT
       (le clamp() gère tout le reste)
       ============================================ */

    @media (max-width: 768px) {
        html { font-size: 13px; }
        html, body { overflow: auto; }
        .dashboard-container { height: auto; min-height: 100vh; overflow: auto; }
        .dashboard-content { height: auto; overflow: visible; padding: 12px 14px; }

        .main-layout {
            grid-template-columns: 1fr;
            overflow: visible;
            height: auto;
            gap: 10px;
        }

        .sidebar-nav {
            height: auto;
            max-height: 150px;
            overflow-y: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            padding: 8px;
            border-radius: 14px;
        }

        .nav-section-title { width: 100%; margin-top: 4px; margin-bottom: 2px; }
        .nav-link { flex: 0 0 auto; padding: 5px 9px; border-radius: 8px; }
        .main-content { height: auto; min-height: 280px; overflow: visible; }
        .stats-grid { grid-template-columns: repeat(3, 1fr) !important; }
        .users-grid { grid-template-columns: 1fr; }
        .stat-trend { display: none; }
    }

    @media (max-width: 480px) {
        html { font-size: 12px; }
        .stats-grid { grid-template-columns: 1fr !important; }
        .stat-trend { display: flex; }
        .dashboard-content { padding: 10px; }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-bg"></div>
    
    <div class="dashboard-content">
        
        {{-- Welcome Section --}}
        <div class="welcome-section">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center gap-4">
                    @php
                        $user = auth()->user();
                        $hasPhoto = $user->photo && file_exists(public_path('storage/' . $user->photo));
                        $isModerator = $user->is_moderator ?? false;
                    @endphp
                    <div class="user-avatar-large">
                        @if($hasPhoto)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Photo de profil">
                        @else
                            <span>{{ strtoupper(substr($user->prenom, 0, 1)) }}{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div>
                        <div class="welcome-badge">
                            ✨ Tableau de bord
                            @if($isModerator)
                                <span class="moderator-badge">⭐ Modérateur</span>
                            @endif
                        </div>
                        <h1 class="greeting-title">Bonjour, {{ $user->prenom }}</h1>
                        <p class="greeting-subtitle">Bienvenue sur votre espace personnel NextLink</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon-wrapper">
                    <svg class="text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="stat-number">{{ $offres->count() }}</div>
                <div class="stat-label">Offres disponibles</div>
                <div class="stat-trend">
                    <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    Nouveautés
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon-wrapper">
                    <svg class="text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-number">{{ $mesCandidatures->count() }}</div>
                <div class="stat-label">Candidatures</div>
                <div class="stat-trend" style="color: #60a5fa;">
                    <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    {{ $mesCandidatures->count() }} total
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon-wrapper">
                    <svg class="text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-number">{{ $mesCandidatures->where('statut', 'en_attente')->count() }}</div>
                <div class="stat-label">En attente</div>
                <div class="stat-trend pulse" style="color: #fbbf24;">
                    <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Imminente
                </div>
            </div>
        </div>

        {{-- Main Layout Grid --}}
        <div class="main-layout">
            
            {{-- Sidebar Navigation --}}
            <aside class="sidebar-nav">
                <div class="nav-section-title">Navigation</div>
                
                <a href="{{ route('student.offres') }}" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    <span>Explorer les offres</span>
                </a>

                <a href="{{ route('student.profil') }}" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    <span>Mon profil</span>
                </a>

                <a href="{{ route('student.notifications') }}" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </span>
                    <span>Notifications</span>
                </a>

                <a href="{{ route('student.candidatures') }}" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </span>
                    <span>Mes candidatures</span>
                </a>

                <a href="{{ route('student.forum.index') }}" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </span>
                    <span>Forum étudiant</span>
                </a>

                <div class="nav-section-title">👥 Communauté</div>
                
                <button onclick="showSection('etudiants')" id="btn-etudiants" class="nav-link active">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </span>
                    <span>Étudiants</span>
                </button>
                
                <button onclick="showSection('enseignants')" id="btn-enseignants" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </span>
                    <span>Enseignants</span>
                </button>

                {{-- Bouton Ajouter Étudiant (visible uniquement pour les modérateurs) --}}
                @if($isModerator)
                <div class="nav-section-title" style="margin-top: 20px;">➕ Administration</div>
                <button onclick="openAddStudentModal()" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/>
                        </svg>
                    </span>
                    <span>Ajouter un étudiant</span>
                </button>
                <button onclick="openAddEnseignantModal()" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/>
                        </svg>
                    </span>
                    <span>Ajouter un enseignant</span>
                </button>
                @endif
            </aside>

            {{-- Main Content - Contenu dynamique --}}
            <main class="main-content">
                
                {{-- Section Étudiants --}}
                <div id="etudiants-section">
                    <div class="section-header">
                        <h2 class="section-title">👨‍🎓 Liste des étudiants</h2>
                    </div>
                    
                    @if(isset($etudiants) && $etudiants->count() > 0)
                        <div class="users-grid">
                            @foreach($etudiants as $etudiant)
                                @if($etudiant->id !== auth()->id())
                                <div class="user-card">
                                    <a href="{{ route('student.messages.chat', $etudiant) }}" style="display: flex; align-items: center; gap: 14px; flex: 1; text-decoration: none;">
                                        <div class="user-avatar">
                                            @if($etudiant->photo)
                                                <img src="{{ asset('storage/' . $etudiant->photo) }}" alt="avatar">
                                            @else
                                                {{ strtoupper(substr($etudiant->prenom, 0, 1)) }}{{ strtoupper(substr($etudiant->name, 0, 1)) }}
                                            @endif
                                        </div>
                                        <div class="user-info">
                                            <div class="user-name">
                                                {{ $etudiant->prenom }} {{ $etudiant->name }}
                                                @if($etudiant->is_moderator)
                                                    <span class="moderator-badge">⭐ Modérateur</span>
                                                @endif
                                            </div>
                                            <div class="user-email">{{ $etudiant->email }}</div>
                                            <div class="user-role">🎓 Étudiant</div>
                                        </div>
                                        <div class="message-icon">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    </a>
                                    {{-- Bouton supprimer (visible uniquement pour les modérateurs) --}}
                                    @if($isModerator && $etudiant->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.students.destroy', $etudiant) }}" onsubmit="return confirm('Supprimer cet étudiant ?')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" title="Supprimer">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M3 6h18"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                <path d="M10 11v5"/>
                                                <path d="M14 11v5"/>
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <p class="empty-title">Aucun étudiant</p>
                            <p class="empty-text">Aucun autre étudiant n'est inscrit pour le moment.</p>
                        </div>
                    @endif
                </div>

                {{-- Section Enseignants --}}
                <div id="enseignants-section" style="display: none;">
                    <div class="section-header">
                        <h2 class="section-title">👨‍🏫 Liste des enseignants</h2>
                    </div>
                    
                    @if(isset($enseignants) && $enseignants->count() > 0)
                        <div class="users-grid">
                            @foreach($enseignants as $enseignant)
                                <div class="user-card">
                                    <a href="{{ route('student.messages.chat', $enseignant) }}" style="display: flex; align-items: center; gap: 14px; flex: 1; text-decoration: none;">
                                        <div class="user-avatar">
                                            @if($enseignant->photo)
                                                <img src="{{ asset('storage/' . $enseignant->photo) }}" alt="avatar">
                                            @else
                                                {{ strtoupper(substr($enseignant->prenom, 0, 1)) }}{{ strtoupper(substr($enseignant->name, 0, 1)) }}
                                            @endif
                                        </div>
                                        <div class="user-info">
                                            <div class="user-name">
                                                {{ $enseignant->prenom }} {{ $enseignant->name }}
                                                @if($enseignant->is_moderator)
                                                    <span class="moderator-badge">⭐ Modérateur</span>
                                                @endif
                                            </div>
                                            <div class="user-email">{{ $enseignant->email }}</div>
                                            <div class="user-role">👨‍🏫 Enseignant</div>
                                        </div>
                                        <div class="message-icon">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    </a>
                                    {{-- Bouton supprimer (visible uniquement pour les modérateurs) --}}
                                    @if($isModerator)
                                    <form method="POST" action="{{ route('admin.enseignants.destroy', $enseignant) }}" onsubmit="return confirm('Supprimer cet enseignant ?')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" title="Supprimer">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M3 6h18"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                <path d="M10 11v5"/>
                                                <path d="M14 11v5"/>
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <p class="empty-title">Aucun enseignant</p>
                            <p class="empty-text">Aucun enseignant n'est inscrit pour le moment.</p>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</div>

{{-- Modal Ajouter Étudiant --}}
<div id="addStudentModal" class="modal-overlay">
    <div class="modal-content">
        <h3 class="modal-title">Ajouter un étudiant</h3>
        <form action="{{ route('admin.student.store') }}" method="POST">
            @csrf
            <input type="text" name="first_name" placeholder="Prénom" class="modal-input" required>
            <input type="text" name="last_name" placeholder="Nom" class="modal-input" required>
            <input type="text" name="registration_number" placeholder="Numéro d'inscription" class="modal-input" required>
            <input type="email" name="email" placeholder="Email" class="modal-input" required>
            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeModal('addStudentModal')">Annuler</button>
                <button type="submit" class="btn-save">Ajouter</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Ajouter Enseignant --}}
<div id="addEnseignantModal" class="modal-overlay">
    <div class="modal-content">
        <h3 class="modal-title">Ajouter un enseignant</h3>
        <form action="{{ route('admin.enseignant.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nom" class="modal-input" required>
            <input type="text" name="prenom" placeholder="Prénom" class="modal-input" required>
            <input type="email" name="email" placeholder="Email" class="modal-input" required>
            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeModal('addEnseignantModal')">Annuler</button>
                <button type="submit" class="btn-save">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showSection(section) {
        // Hide all sections
        document.getElementById('etudiants-section').style.display = 'none';
        document.getElementById('enseignants-section').style.display = 'none';
        
        // Remove active class from all buttons
        document.getElementById('btn-etudiants').classList.remove('active');
        document.getElementById('btn-enseignants').classList.remove('active');
        
        // Show selected section
        document.getElementById(section + '-section').style.display = 'block';
        
        // Add active class to selected button
        document.getElementById('btn-' + section).classList.add('active');
    }
    
    function openAddStudentModal() {
        document.getElementById('addStudentModal').classList.add('active');
    }
    
    function openAddEnseignantModal() {
        document.getElementById('addEnseignantModal').classList.add('active');
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
    }
    
    // Close modal on outside click
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('active');
        });
    });
</script>

@endsection