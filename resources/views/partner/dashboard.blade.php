@extends('app')

@section('content')
<style>
    /* ========================================
       PARTNER DASHBOARD - PREMIUM DESIGN
       Same design as student/teacher dashboard
       ======================================== */
    
    .partner-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .partner-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: var(--bg-primary);
    }
    
    .partner-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.pexels.com/photos/2653362/pexels-photo-2653362.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=2') center/cover no-repeat;
        opacity: var(--bg-overlay-image-opacity, 0.08);
        pointer-events: none;
    }
    
    .partner-bg::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 40%, var(--accent-light) 0%, transparent 50%);
        pointer-events: none;
    }
    
    /* Content */
    .partner-content {
        position: relative;
        z-index: 1;
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 48px;
    }
    
    /* Header */
    .partner-header {
        margin-bottom: 32px;
    }
    
    .partner-badge {
        background: var(--badge-bg);
        border: 1px solid var(--badge-border);
        border-radius: 100px;
        padding: 4px 16px;
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--badge-text);
        margin-bottom: 16px;
    }
    
    .partner-title {
        font-size: 42px;
        font-weight: 800;
        line-height: 1.2;
        background: var(--title-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 12px;
    }
    
    .partner-subtitle {
        color: var(--text-secondary);
        font-size: 16px;
        font-weight: 400;
    }
    
    /* Divider */
    .divider-custom {
        display: flex;
        align-items: center;
        gap: 16px;
        margin: 24px 0 32px 0;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    
    .stat-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 24px;
        transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        position: relative;
        overflow: hidden;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        border-color: var(--card-border-hover);
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        background: var(--accent-light);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    
    .stat-icon svg {
        width: 24px;
        height: 24px;
    }
    
    .stat-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }
    
    .stat-text {
        font-size: 13px;
        color: var(--text-secondary);
        line-height: 1.5;
        margin-bottom: 20px;
    }
    
    /* Button Styles */
    .btn-offres {
        background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
        border: none;
        color: var(--text-primary);
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }
    
    .btn-offres:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
    }
    
    .btn-create {
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
        border: none;
        color: var(--text-primary);
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }
    
    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
    }
    
    .btn-notifications {
        background: linear-gradient(135deg, var(--info) 0%, #0284c7 100%);
        border: none;
        color: var(--text-primary);
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
    }
    
    .btn-notifications:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(14, 165, 233, 0.35);
    }
    
    /* Logout Button */
    .logout-area {
        display: flex;
        justify-content: flex-end;
        margin-top: 48px;
        padding-top: 24px;
        border-top: 1px solid var(--divider);
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .partner-content { padding: 32px 32px; }
        .stats-grid { gap: 20px; }
    }
    
    @media (max-width: 768px) {
        .partner-content { padding: 24px 20px; }
        .partner-title { font-size: 28px; }
        .stats-grid { grid-template-columns: 1fr; gap: 16px; }
        .stat-card { padding: 20px; }
    }
</style>

<div class="partner-container">
    <div class="partner-bg"></div>
    
    <div class="partner-content animate-fade-up">
        
        {{-- Header --}}
        <div class="partner-header">
            <div class="partner-badge">🏢 Espace Entreprise</div>
            <h1 class="partner-title">Tableau de bord Entreprise</h1>
            <p class="partner-subtitle">Gérez vos offres et consultez les candidatures reçues</p>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        {{-- Stats Grid --}}
        <div class="stats-grid">
            {{-- Carte Mes offres --}}
            <div class="stat-card">
                <div class="stat-icon">
                    <svg class="text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="stat-title">Mes offres</h2>
                <p class="stat-text">Vous avez publié <strong>{{ $offersCount }}</strong> offre{{ $offersCount > 1 ? 's' : '' }}.</p>
                <a href="{{ route('partner.offres') }}" class="btn-offres">
                    Gérer mes offres
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- Carte Publier une offre --}}
            <div class="stat-card">
                <div class="stat-icon">
                    <svg class="text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h2 class="stat-title">Publier une offre</h2>
                <p class="stat-text">Créez une nouvelle offre d'emploi et apportez de la visibilité à votre entreprise.</p>
                <a href="{{ route('partner.offres.create') }}" class="btn-create">
                    Nouvelle offre
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>

            {{-- Carte Notifications --}}
            <div class="stat-card">
                <div class="stat-icon">
                    <svg class="text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <h2 class="stat-title">Notifications</h2>
                <p class="stat-text">Vous avez <strong>{{ $unreadNotifications }}</strong> notification{{ $unreadNotifications > 1 ? 's' : '' }} non lue{{ $unreadNotifications > 1 ? 's' : '' }}.</p>
                <a href="{{ route('partner.notifications') }}" class="btn-notifications">
                    Voir les notifications
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Logout --}}
        <div class="logout-area">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</div>
@endsection