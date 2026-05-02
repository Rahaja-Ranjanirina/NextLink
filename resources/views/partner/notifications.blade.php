@extends('app')

@section('content')
<style>
    /* ========================================
       PARTNER NOTIFICATIONS - PREMIUM DESIGN
       Same design as dashboard
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .notifications-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .notifications-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: linear-gradient(145deg, #070b17 0%, #0f1322 50%, #0a0e1a 100%);
    }
    
    .notifications-bg::before {
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
    
    .notifications-bg::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 40%, rgba(99, 102, 241, 0.08) 0%, transparent 50%);
        pointer-events: none;
    }
    
    /* Content */
    .notifications-content {
        position: relative;
        z-index: 1;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 48px;
    }
    
    /* Header */
    .notifications-header {
        margin-bottom: 32px;
    }
    
    .notifications-badge {
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.25);
        border-radius: 100px;
        padding: 4px 16px;
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #a5b4fc;
        margin-bottom: 16px;
    }
    
    .notifications-title {
        font-size: 42px;
        font-weight: 800;
        line-height: 1.2;
        background: linear-gradient(135deg, #ffffff 0%, #c7d2fe 50%, #a5b4fc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 12px;
    }
    
    .notifications-subtitle {
        color: rgba(156, 163, 175, 0.8);
        font-size: 16px;
        font-weight: 400;
    }
    
    /* Header with stats */
    .header-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 24px;
        align-items: center;
        margin-bottom: 32px;
    }
    
    /* Stats Card */
    .stats-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 24px;
        padding: 24px;
        text-align: right;
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
        transform: translateY(-2px);
    }
    
    .stats-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(156, 163, 175, 0.6);
        margin-bottom: 8px;
    }
    
    .stats-number {
        font-size: 42px;
        font-weight: 800;
        background: linear-gradient(135deg, #fff, #e0e7ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 4px;
    }
    
    .stats-unread {
        font-size: 13px;
        color: #fbbf24;
    }
    
    /* Divider */
    .divider-custom {
        display: flex;
        align-items: center;
        gap: 16px;
        margin: 24px 0 32px 0;
    }
    
    .divider-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
    }
    
    .divider-dot {
        width: 5px;
        height: 5px;
        background: #6366f1;
        border-radius: 50%;
        opacity: 0.5;
    }
    
    /* Notification Card */
    .notification-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 24px;
        padding: 24px;
        margin-bottom: 16px;
        transition: all 0.3s ease;
    }
    
    .notification-card.unread {
        border-color: rgba(99, 102, 241, 0.4);
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(255, 255, 255, 0.01) 100%);
    }
    
    .notification-card:hover {
        transform: translateX(4px);
        border-color: rgba(99, 102, 241, 0.3);
    }
    
    /* Badges */
    .type-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(99, 102, 241, 0.1));
        color: #a5b4fc;
        border: 1px solid rgba(99, 102, 241, 0.25);
    }
    
    .new-badge {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(239, 68, 68, 0.1));
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    /* Info lines */
    .info-line {
        display: flex;
        align-items: baseline;
        gap: 8px;
        font-size: 13px;
        color: #9ca3af;
        margin-top: 8px;
    }
    
    .info-line strong {
        color: white;
        font-weight: 500;
    }
    
    /* Buttons */
    .btn-outline {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 100px;
        padding: 8px 20px;
        font-size: 12px;
        font-weight: 500;
        color: #d1d5db;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-outline:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.2);
        color: white;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 100px;
        font-size: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.35);
    }
    
    .btn-mark-read {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 100px;
        padding: 8px 20px;
        font-size: 12px;
        font-weight: 500;
        color: #9ca3af;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-mark-read:hover {
        background: rgba(99, 102, 241, 0.15);
        border-color: rgba(99, 102, 241, 0.3);
        color: #a5b4fc;
    }
    
    /* Empty State */
    .empty-state {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 28px;
        padding: 60px 32px;
        text-align: center;
    }
    
    .empty-icon {
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.04);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    
    .empty-title {
        font-size: 18px;
        font-weight: 600;
        color: white;
        margin-bottom: 8px;
    }
    
    .empty-text {
        font-size: 14px;
        color: #9ca3af;
    }
    
    /* Pagination */
    .pagination-nav {
        display: flex;
        justify-content: center;
        margin-top: 32px;
    }
    
    .pagination-nav nav {
        display: flex;
        gap: 6px;
    }
    
    .pagination-nav span, .pagination-nav a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        padding: 0 14px;
        border-radius: 100px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
        color: #9ca3af;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .pagination-nav a:hover {
        background: rgba(99, 102, 241, 0.15);
        border-color: rgba(99, 102, 241, 0.3);
        color: #a5b4fc;
    }
    
    .pagination-nav .active span {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        border-color: transparent;
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
    
    /* Scrollbar */
    ::-webkit-scrollbar {
        width: 5px;
    }
    
    ::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .notifications-content {
            padding: 24px 20px;
        }
        .notifications-title {
            font-size: 28px;
        }
        .header-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .stats-card {
            text-align: left;
        }
        .notification-card {
            padding: 18px;
        }
        .flex-buttons {
            flex-direction: column;
            width: 100%;
        }
        .flex-buttons a, .flex-buttons button {
            width: 100%;
            text-align: center;
            justify-content: center;
        }
    }
</style>

<div class="notifications-container">
    <div class="notifications-bg"></div>
    
    <div class="notifications-content animate-fade-up">
        
        {{-- Header --}}
        <div class="notifications-header">
            <div class="notifications-badge">🔔 Centre de notifications</div>
            <h1 class="notifications-title">Notifications</h1>
            <p class="notifications-subtitle">Toutes les candidatures reçues et les actions prioritaires</p>
        </div>

        {{-- Header with stats --}}
        <div class="header-grid">
            <div></div>
            <div class="stats-card">
                <div class="stats-label">Notifications reçues</div>
                <div class="stats-number">{{ $notifications->total() }}</div>
                <div class="stats-unread">{{ $notifications->getCollection()->where('is_read', false)->count() }} non lues</div>
            </div>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        @if($notifications->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <p class="empty-title">Aucune notification</p>
                <p class="empty-text">Vous n'avez aucune notification pour le moment.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($notifications as $notification)
                    <div class="notification-card {{ !$notification->is_read ? 'unread' : '' }}">
                        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-3 mb-3">
                                    <span class="type-badge">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Candidature
                                    </span>
                                    @if(!$notification->is_read)
                                        <span class="new-badge">Nouveau</span>
                                    @endif
                                </div>
                                
                                <p class="text-white leading-relaxed">{{ $notification->message }}</p>
                                
                                @if($notification->notifiable && $notification->notifiable instanceof App\Models\Candidature)
                                    <div class="info-line">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Candidat : <strong>{{ $notification->notifiable->etudiant->full_name ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="info-line">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        Offre : <strong>{{ $notification->notifiable->offre->titre ?? 'N/A' }}</strong>
                                    </div>
                                @endif
                                
                                <p class="text-xs text-gray-500 mt-3">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Reçue le {{ $notification->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-2 flex-buttons">
                                @if($notification->notifiable && $notification->notifiable instanceof App\Models\Candidature)
                                    <a href="{{ route('partner.candidatures.show', ['offre' => $notification->notifiable->offre, 'candidature' => $notification->notifiable]) }}" class="btn-outline">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Voir le dossier
                                    </a>
                                    <a href="{{ route('partner.candidatures.jitsi', ['offre' => $notification->notifiable->offre, 'candidature' => $notification->notifiable]) }}" class="btn-primary">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        Rejoindre Jitsi
                                    </a>
                                @endif
                                @unless($notification->is_read)
                                    <form method="POST" action="{{ route('partner.notifications.read', $notification) }}">
                                        @csrf
                                        <button type="submit" class="btn-mark-read">
                                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Marquer comme lu
                                        </button>
                                    </form>
                                @endunless
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-nav">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection