@extends('app')

@section('content')
<style>
    /* ========================================
       ENSEIGNANT DASHBOARD - FULLSCREEN NO SCROLL
       Same design as student dashboard
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    html, body {
        height: 100%;
        overflow: hidden;
    }
    
    .dashboard-container {
        height: 100vh;
        width: 100vw;
        position: relative;
        font-family: 'Inter', sans-serif;
        overflow: hidden;
    }
    
 .dashboard-bg {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    background: var(--bg-primary);
}
    
    
    .dashboard-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.pexels.com/photos/2653362/pexels-photo-2653362.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=2') center/cover no-repeat;
        opacity: 0.08;
        pointer-events: none;
    }
    
    .dashboard-bg::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 40%, rgba(99, 102, 241, 0.08) 0%, transparent 50%);
        pointer-events: none;
    }
    
    .dashboard-content {
        position: relative;
        z-index: 1;
        height: 100vh;
        max-width: 1440px;
        margin: 0 auto;
        padding: 20px 40px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    /* Header */
    .welcome-section {
        flex-shrink: 0;
        margin-bottom: 16px;
    }
    
    .user-avatar-large {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 15px 35px rgba(99, 102, 241, 0.3);
        overflow: hidden;
    }
    
    .user-avatar-large img {
        width: 100%;
        height: 100%;
        border-radius: 16px;
        object-fit: cover;
    }
    
    .user-avatar-large span {
        font-size: 20px;
        font-weight: 700;
        color: white;
    }
    
    .welcome-badge {
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.25);
        border-radius: 100px;
        padding: 2px 10px;
        display: inline-block;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #a5b4fc;
        margin-bottom: 6px;
    }
    
    .greeting-title {
        font-size: 22px;
        font-weight: 800;
        line-height: 1.2;
        background: linear-gradient(135deg, #ffffff 0%, #c7d2fe 50%, #a5b4fc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 4px;
    }
    
    .greeting-subtitle {
        color: rgba(156, 163, 175, 0.8);
        font-size: 11px;
        font-weight: 400;
    }
    
    .logout-btn {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #9ca3af;
        transition: all 0.3s ease;
        padding: 6px 18px;
        border-radius: 100px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        backdrop-filter: blur(10px);
        font-size: 12px;
    }
    
    .logout-btn:hover {
        background: rgba(255, 255, 255, 0.08);
        color: white;
    }
    
    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        flex-shrink: 0;
        margin-bottom: 20px;
    }
    
    .stat-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 20px;
        padding: 12px 16px;
        transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.03), transparent);
        transition: left 0.6s ease;
    }
    
    .stat-card:hover::before {
        left: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        border-color: rgba(99, 102, 241, 0.4);
    }
    
    .stat-icon-wrapper {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.2) 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
    }
    
    .stat-icon-wrapper svg {
        width: 16px;
        height: 16px;
    }
    
    .stat-number {
        font-size: 26px;
        font-weight: 800;
        background: linear-gradient(135deg, #fff, #e0e7ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 2px;
    }
    
    .stat-label {
        color: #9ca3af;
        font-size: 10px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-trend {
        font-size: 9px;
        color: #4ade80;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 3px;
    }
    
    /* Main Layout */
    .main-layout {
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 20px;
        flex: 1;
        min-height: 0;
        overflow: hidden;
    }
    
    /* Sidebar Navigation */
    .sidebar-nav {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 20px;
        padding: 14px 10px;
        height: 100%;
        overflow-y: auto;
    }
    
    .sidebar-nav::-webkit-scrollbar {
        width: 3px;
    }
    
    .sidebar-nav::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03);
    }
    
    .sidebar-nav::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
    }
    
    .nav-section-title {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(156, 163, 175, 0.6);
        padding: 0 12px;
        margin-bottom: 12px;
        margin-top: 16px;
    }
    
    .nav-section-title:first-of-type {
        margin-top: 0;
    }
    
    .nav-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        border-radius: 12px;
        color: rgba(255, 255, 255, 0.6);
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 4px;
        width: 100%;
        background: none;
        border: none;
        cursor: pointer;
    }
    
    .nav-link:hover {
        background: rgba(99, 102, 241, 0.1);
        color: #c7d2fe;
        transform: translateX(4px);
    }
    
    .nav-link.active {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.1));
        color: #a5b4fc;
        border: 1px solid rgba(99, 102, 241, 0.25);
    }
    
    .nav-icon {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.04);
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    
    .nav-icon svg {
        width: 13px;
        height: 13px;
    }
    
    /* Main Content */
    .main-content {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 20px;
        padding: 20px;
        height: 100%;
        overflow-y: auto;
    }
    
    .main-content::-webkit-scrollbar {
        width: 4px;
    }
    
    .main-content::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 10px;
    }
    
    .main-content::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
    }
    
    /* Section Header */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    .section-title {
        font-size: 18px;
        font-weight: 700;
        background: linear-gradient(135deg, #fff, #c7d2fe);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Moderator Badge */
    .moderator-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(245, 158, 11, 0.1));
        border: 1px solid rgba(245, 158, 11, 0.3);
        border-radius: 100px;
        padding: 2px 8px;
        font-size: 9px;
        font-weight: 600;
        color: #fbbf24;
        margin-left: 8px;
    }
    
    /* User Cards Grid */
    .users-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 16px;
    }
    
    .user-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        padding: 16px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 14px;
        position: relative;
    }
    
    .user-card:hover {
        border-color: rgba(99, 102, 241, 0.4);
        transform: translateY(-3px);
        background: rgba(255, 255, 255, 0.05);
    }
    
    .user-card-link {
        display: flex;
        align-items: center;
        gap: 14px;
        flex: 1;
        text-decoration: none;
    }
    
    .user-avatar-link {
        flex-shrink: 0;
        text-decoration: none;
    }
    
    .user-name-link {
        text-decoration: none;
        flex: 1;
    }
    
    .user-name-link:hover .user-name {
        color: #a5b4fc;
    }
    
    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
        overflow: hidden;
    }
    
    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .user-info {
        flex: 1;
    }
    
    .user-name {
        font-size: 15px;
        font-weight: 600;
        color: white;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
    }
    
    .user-email {
        font-size: 11px;
        color: #9ca3af;
    }
    
    .user-role {
        font-size: 10px;
        color: #a5b4fc;
        margin-top: 4px;
        display: inline-block;
    }
    
    .message-icon {
        width: 36px;
        height: 36px;
        background: rgba(99, 102, 241, 0.15);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        flex-shrink: 0;
        text-decoration: none;
    }
    
    .message-icon:hover {
        background: rgba(99, 102, 241, 0.3);
        transform: scale(1.05);
    }
    
    .message-icon svg {
        width: 18px;
        height: 18px;
        color: #a5b4fc;
    }
    
    /* Delete Button */
    .delete-btn {
        background: rgba(239, 68, 68, 0.1);
        border: none;
        border-radius: 10px;
        padding: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #f87171;
        flex-shrink: 0;
        margin-left: 4px;
    }
    
    .delete-btn:hover {
        background: rgba(239, 68, 68, 0.25);
        color: #fca5a5;
        transform: scale(1.05);
    }
    
    .delete-btn svg {
        width: 18px;
        height: 18px;
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
        max-width: 500px;
    }
    
    .modal-title {
        font-size: 20px;
        font-weight: 700;
        color: white;
        margin-bottom: 20px;
    }
    
    .modal-input {
        width: 100%;
        background: rgba(10, 12, 16, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 12px 16px;
        color: white;
        margin-bottom: 16px;
    }
    
    .modal-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 20px;
    }
    
    .btn-cancel {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 100px;
        padding: 10px 20px;
        color: #9ca3af;
        cursor: pointer;
    }
    
    .btn-save {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        border-radius: 100px;
        padding: 10px 24px;
        color: white;
        font-weight: 600;
        cursor: pointer;
    }
    
    /* Offres List */
    .offres-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .offre-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        padding: 14px;
        transition: all 0.2s ease;
    }
    
    .offre-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
        transform: translateX(4px);
    }
    
    .offre-title {
        font-size: 14px;
        font-weight: 600;
        color: white;
        margin-bottom: 6px;
    }
    
    .offre-description {
        font-size: 11px;
        color: #9ca3af;
        line-height: 1.4;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .offre-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .candidatures-count {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 100px;
        background: rgba(99, 102, 241, 0.12);
        border: 1px solid rgba(99, 102, 241, 0.2);
        font-size: 10px;
        color: #a5b4fc;
    }
    
    .offre-link {
        color: #a5b4fc;
        text-decoration: none;
        font-size: 11px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s;
    }
    
    .offre-link:hover {
        color: white;
        gap: 6px;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
    }
    
    .empty-icon {
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.04);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    
    .empty-icon svg {
        width: 32px;
        height: 32px;
        color: #6b7280;
    }
    
    .empty-title {
        font-size: 16px;
        font-weight: 600;
        color: white;
        margin-bottom: 8px;
    }
    
    .empty-text {
        font-size: 13px;
        color: #9ca3af;
    }
    
    .btn-primary-small {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .btn-primary-small:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);
    }

/* User Card Static (non cliquable) */
.user-card-link-static {
    display: flex;
    align-items: center;
    gap: 14px;
    flex: 1;
    cursor: default;
}

.user-card-link-static .user-name {
    cursor: default;
}

.user-card-link-static .user-name:hover {
    color: white; /* Pas de changement de couleur au hover */
}

    
    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }
    
    .pulse { animation: pulse 2s ease-in-out infinite; }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .dashboard-content { padding: 16px 24px; }
        .main-layout { grid-template-columns: 220px 1fr; }
    }
    
    @media (max-width: 768px) {
        .dashboard-content { padding: 12px 16px; }
        .main-layout { grid-template-columns: 1fr; }
        .stats-grid { gap: 10px; }
        .users-grid { grid-template-columns: 1fr; }
    }
    
    @media (max-width: 480px) {
        .stats-grid { grid-template-columns: 1fr; }
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
                            🎓 Espace Enseignant
                            @if($isModerator)
                                <span class="moderator-badge">⭐ Modérateur</span>
                            @endif
                        </div>
                        <h1 class="greeting-title">Bonjour, {{ $user->prenom }}</h1>
                        <p class="greeting-subtitle">Gérez vos étudiants, offres et suivez les candidatures</p>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div class="stat-number">{{ $nbEtudiants }}</div>
                <div class="stat-label">Étudiants inscrits</div>
                <div class="stat-trend">
                    <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    Total
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon-wrapper">
                    <svg class="text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="stat-number">{{ $mesOffres->count() }}</div>
                <div class="stat-label">Offres publiées</div>
                <div class="stat-trend" style="color: #60a5fa;">
                    <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    {{ $mesOffres->count() }} total
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon-wrapper">
                    <svg class="text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="stat-number">{{ $mesOffres->sum('candidatures_count') }}</div>
                <div class="stat-label">Candidatures reçues</div>
                <div class="stat-trend pulse" style="color: #fbbf24;">
                    <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    À traiter
                </div>
            </div>
        </div>

        {{-- Main Layout Grid --}}
        <div class="main-layout">
            
            {{-- Sidebar Navigation --}}
            <aside class="sidebar-nav">
                <div class="nav-section-title">Navigation</div>
                
                <button onclick="showSection('offres')" id="btn-offres" class="nav-link active">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    <span>Mes offres</span>
                </button>

                <div class="nav-section-title">👥 Communauté</div>
                
                <button onclick="showSection('etudiants')" id="btn-etudiants" class="nav-link">
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

                <button onclick="showSection('entreprises')" id="btn-entreprises" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    <span>Entreprises</span>
                </button>

                @if($isModerator)
                <div class="nav-section-title" style="margin-top: 20px;">➕ Administration</div>
                <button onclick="openAddStudentModal()" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </span>
                    <span>Ajouter un étudiant</span>
                </button>
                <button onclick="openAddEnseignantModal()" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </span>
                    <span>Ajouter un enseignant</span>
                </button>
                <button onclick="openAddEntrepriseModal()" class="nav-link">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </span>
                    <span>Ajouter une entreprise</span>
                </button>
                @endif
            </aside>

            {{-- Main Content - Contenu dynamique --}}
            <main class="main-content">
                
                {{-- Section Offres --}}
                <div id="offres-section">
                    <div class="section-header">
                        <h2 class="section-title">📋 Mes offres récentes</h2>
                    </div>
                    
                    @if($mesOffres->count() > 0)
                        <div class="offres-list">
                            @foreach($mesOffres->take(5) as $offre)
                                <div class="offre-card">
                                    <h3 class="offre-title">{{ $offre->titre }}</h3>
                                    <p class="offre-description">{{ \Illuminate\Support\Str::limit($offre->description, 80) }}</p>
                                    <div class="offre-footer">
                                        <span class="candidatures-count">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            {{ $offre->candidatures_count }} candidature{{ $offre->candidatures_count > 1 ? 's' : '' }}
                                        </span>
                                        <a href="{{ route('enseignant.offres.show', $offre) }}" class="offre-link">
                                            Détails
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($mesOffres->count() > 5)
                        <div class="text-center mt-4">
                            <a href="{{ route('enseignant.offres') }}" class="btn-primary-small">Voir toutes mes offres →</a>
                        </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="empty-title">Aucune offre</p>
                            <p class="empty-text">Vous n'avez pas encore publié d'offre.</p>
                            <a href="{{ route('enseignant.offres.create') }}" class="btn-primary-small">Créer une offre</a>
                        </div>
                    @endif
                </div>

               {{-- Section Étudiants --}}
<div id="etudiants-section" style="display: none;">
    <div class="section-header">
        <h2 class="section-title">👨‍🎓 Liste des étudiants</h2>
    </div>
    
    @if(isset($etudiants) && $etudiants->count() > 0)
        <div class="users-grid">
            @foreach($etudiants as $etudiant)
                @if($etudiant->id !== auth()->id())
                <div class="user-card">
                    <div class="user-card-link">
                        <!-- Lien vers le profil étudiant -->
                        <a href="{{ route('enseignant.etudiants.profile', $etudiant) }}" class="user-avatar-link">
                            <div class="user-avatar">
                                @if($etudiant->photo)
                                    <img src="{{ asset('storage/' . $etudiant->photo) }}" alt="avatar">
                                @else
                                    {{ strtoupper(substr($etudiant->prenom, 0, 1)) }}{{ strtoupper(substr($etudiant->name, 0, 1)) }}
                                @endif
                            </div>
                        </a>
                        <div class="user-info">
                            <a href="{{ route('enseignant.etudiants.profile', $etudiant) }}" class="user-name-link">
                                <div class="user-name">
                                    {{ $etudiant->prenom }} {{ $etudiant->name }}
                                    @if($etudiant->is_moderator)
                                        <span class="moderator-badge">⭐ Modérateur</span>
                                    @endif
                                </div>
                                <div class="user-email">{{ $etudiant->email }}</div>
                                <div class="user-role">🎓 Étudiant</div>
                            </a>
                        </div>
                        <a href="{{ route('enseignant.messages.chat', $etudiant) }}" class="message-icon" title="Envoyer un message">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </a>
                    </div>
                    @if($isModerator && $etudiant->id !== auth()->id())
                    <div class="admin-actions">
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
                    </div>
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
            <p class="empty-text">Aucun étudiant n'est inscrit pour le moment.</p>
        </div>
    @endif
</div>

              {{-- Section Enseignants (non cliquable) --}}
<div id="enseignants-section" style="display: none;">
    <div class="section-header">
        <h2 class="section-title">👨‍🏫 Liste des enseignants</h2>
    </div>
    
    @if(isset($enseignants) && $enseignants->count() > 0)
        <div class="users-grid">
            @foreach($enseignants as $enseignantItem)
                @if($enseignantItem->id !== auth()->id())
                <div class="user-card">
                    <div class="user-card-link-static">
                        <div class="user-avatar">
                            @if($enseignantItem->photo)
                                <img src="{{ asset('storage/' . $enseignantItem->photo) }}" alt="avatar">
                            @else
                                {{ strtoupper(substr($enseignantItem->prenom, 0, 1)) }}{{ strtoupper(substr($enseignantItem->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="user-info">
                            <div class="user-name">
                                {{ $enseignantItem->prenom }} {{ $enseignantItem->name }}
                                @if($enseignantItem->is_moderator)
                                    <span class="moderator-badge">⭐ Modérateur</span>
                                @endif
                            </div>
                            <div class="user-email">{{ $enseignantItem->email }}</div>
                            <div class="user-role">👨‍🏫 Enseignant</div>
                        </div>
                    </div>
                    @if($isModerator)
                    <form method="POST" action="{{ route('admin.enseignants.destroy', $enseignantItem) }}" onsubmit="return confirm('Supprimer cet enseignant ?')" style="display: inline;">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <p class="empty-title">Aucun enseignant</p>
            <p class="empty-text">Aucun enseignant n'est inscrit pour le moment.</p>
        </div>
    @endif
</div>

            {{-- Section Entreprises (non cliquable) --}}
<div id="entreprises-section" style="display: none;">
    <div class="section-header">
        <h2 class="section-title">🏢 Liste des entreprises</h2>
    </div>
    
    @if(isset($entreprises) && $entreprises->count() > 0)
        <div class="users-grid">
            @foreach($entreprises as $entreprise)
                <div class="user-card">
                    <div class="user-card-link-static">
                        <div class="user-avatar">
                            @if($entreprise->photo)
                                <img src="{{ asset('storage/' . $entreprise->photo) }}" alt="avatar">
                            @else
                                {{ strtoupper(substr($entreprise->name, 0, 2)) }}
                            @endif
                        </div>
                        <div class="user-info">
                            <div class="user-name">
                                {{ $entreprise->name }}
                                @if($entreprise->is_moderator)
                                    <span class="moderator-badge">⭐ Modérateur</span>
                                @endif
                            </div>
                            <div class="user-email">{{ $entreprise->email }}</div>
                            <div class="user-role">🏢 Entreprise</div>
                        </div>
                    </div>
                    @if($isModerator)
                    <form method="POST" action="/admin/partner/{{ $entreprise->id }}" onsubmit="return confirm('Supprimer cette entreprise ?')" style="display: inline;">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="empty-title">Aucune entreprise</p>
            <p class="empty-text">Aucune entreprise n'est inscrite pour le moment.</p>
        </div>
    @endif
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

{{-- Modal Ajouter Entreprise --}}
<div id="addEntrepriseModal" class="modal-overlay">
    <div class="modal-content">
        <h3 class="modal-title">Ajouter une entreprise</h3>
        <form action="{{ route('admin.partner.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nom de l'entreprise" class="modal-input" required>
            <input type="email" name="email" placeholder="Email" class="modal-input" required>
            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeModal('addEntrepriseModal')">Annuler</button>
                <button type="submit" class="btn-save">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showSection(section) {
        // Cacher toutes les sections
        const offresSection = document.getElementById('offres-section');
        const etudiantsSection = document.getElementById('etudiants-section');
        const enseignantsSection = document.getElementById('enseignants-section');
        const entreprisesSection = document.getElementById('entreprises-section');
        
        if (offresSection) offresSection.style.display = 'none';
        if (etudiantsSection) etudiantsSection.style.display = 'none';
        if (enseignantsSection) enseignantsSection.style.display = 'none';
        if (entreprisesSection) entreprisesSection.style.display = 'none';
        
        // Supprimer la classe active de tous les boutons
        const btnOffres = document.getElementById('btn-offres');
        const btnEtudiants = document.getElementById('btn-etudiants');
        const btnEnseignants = document.getElementById('btn-enseignants');
        const btnEntreprises = document.getElementById('btn-entreprises');
        
        if (btnOffres) btnOffres.classList.remove('active');
        if (btnEtudiants) btnEtudiants.classList.remove('active');
        if (btnEnseignants) btnEnseignants.classList.remove('active');
        if (btnEntreprises) btnEntreprises.classList.remove('active');
        
        // Afficher la section sélectionnée
        const selectedSection = document.getElementById(section + '-section');
        const selectedBtn = document.getElementById('btn-' + section);
        
        if (selectedSection) selectedSection.style.display = 'block';
        if (selectedBtn) selectedBtn.classList.add('active');
    }
    
    function openAddStudentModal() { 
        const modal = document.getElementById('addStudentModal');
        if (modal) modal.classList.add('active');
    }
    
    function openAddEnseignantModal() { 
        const modal = document.getElementById('addEnseignantModal');
        if (modal) modal.classList.add('active');
    }
    
    function openAddEntrepriseModal() { 
        const modal = document.getElementById('addEntrepriseModal');
        if (modal) modal.classList.add('active');
    }
    
    function closeModal(modalId) { 
        const modal = document.getElementById(modalId);
        if (modal) modal.classList.remove('active');
    }
    
    // Fermer la modale en cliquant en dehors
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
    });
</script>

@endsection