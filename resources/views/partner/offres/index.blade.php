@extends('app')

@section('content')
<style>
    /* ========================================
       PARTNER OFFERS LIST - PREMIUM DESIGN
       Same design as dashboard
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .offres-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .offres-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: var(--bg-primary);
    }
    
    .offres-bg::before {
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
    
    .offres-bg::after {
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
    .offres-content {
        position: relative;
        z-index: 1;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 48px;
    }
    
    /* Header */
    .page-header {
        margin-bottom: 32px;
    }
    
    .page-badge {
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
    
    .page-title {
        font-size: 42px;
        font-weight: 800;
        line-height: 1.2;
        background: var(--title-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 12px;
    }
    
    .page-subtitle {
        color: var(--text-secondary);
        font-size: 16px;
        font-weight: 400;
    }
    
    /* Header Actions */
    .header-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 32px;
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
        background: var(--divider-glow);
    }
    
    .divider-dot {
        width: 5px;
        height: 5px;
        background: var(--accent-primary);
        border-radius: 50%;
        opacity: 0.5;
    }
    
    /* Buttons */
    .btn-back {
        background: var(--btn-secondary-bg);
        border: 1px solid var(--btn-secondary-border);
        border-radius: 100px;
        padding: 10px 24px;
        color: var(--btn-secondary-color);
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        margin-bottom: 24px;
    }
    
    .btn-back:hover {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
        transform: translateX(-2px);
    }
    
    .btn-create {
        background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
        border: none;
        color: var(--text-primary);
        font-weight: 600;
        padding: 12px 28px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }
    
    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
    }
    
    /* Flash Message */
    .flash-success {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(34, 197, 94, 0.05));
        border: 1px solid rgba(34, 197, 94, 0.25);
        border-radius: 16px;
        padding: 14px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #4ade80;
        font-size: 13px;
        font-weight: 500;
    }
    
    /* Offer Card */
    .offer-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 24px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .offer-card:hover {
        border-color: var(--card-border-hover);
        transform: translateX(4px);
    }
    
    /* Offer Header */
    .offer-header {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 16px;
    }
    
    @media (min-width: 768px) {
        .offer-header {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }
    
    .offer-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }
    
    .offer-description {
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.5;
    }
    
    /* Right Section */
    .offer-stats {
        text-align: right;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    @media (min-width: 768px) {
        .offer-stats {
            align-items: flex-end;
        }
    }
    
    .candidatures-count {
        font-size: 13px;
        color: var(--text-muted);
    }
    
    .candidatures-count strong {
        color: var(--text-primary);
        font-size: 18px;
        font-weight: 700;
    }
    
    .btn-candidatures {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 100px;
        padding: 8px 18px;
        font-size: 12px;
        font-weight: 500;
        color: var(--badge-text);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }
    
    .btn-candidatures:hover {
        background: var(--badge-bg);
        color: var(--text-primary);
        transform: translateY(-2px);
    }
    
    /* Tags */
    .offer-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 100px;
        background: var(--btn-secondary-bg);
        border: 1px solid var(--btn-secondary-border);
        font-size: 11px;
        font-weight: 500;
        color: var(--text-muted);
    }
    
    .tag-stage {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(59, 130, 246, 0.08));
        color: #60a5fa;
        border-color: rgba(59, 130, 246, 0.25);
    }
    
    .tag-emploi {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(34, 197, 94, 0.08));
        color: #4ade80;
        border-color: rgba(34, 197, 94, 0.25);
    }
    
    .tag-alternance {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.08));
        color: #fbbf24;
        border-color: rgba(245, 158, 11, 0.25);
    }
    
    .tag-these {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(139, 92, 246, 0.08));
        color: #c4b5fd;
        border-color: rgba(139, 92, 246, 0.25);
    }
    
    /* Empty State */
    .empty-state {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        padding: 60px 32px;
        text-align: center;
    }
    
    .empty-icon {
        width: 64px;
        height: 64px;
        background: var(--btn-secondary-bg);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    
    .empty-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }
    
    .empty-text {
        font-size: 14px;
        color: var(--text-muted);
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
        background: var(--btn-secondary-bg);
        border: 1px solid var(--glass-border);
        color: var(--text-muted);
        font-size: 13px;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .pagination-nav a:hover {
        background: var(--badge-bg);
        border-color: var(--card-border-hover);
        color: var(--badge-text);
    }
    
    .pagination-nav .active span {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: var(--text-primary);
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
        background: var(--scrollbar-track);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 10px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .offres-content {
            padding: 24px 20px;
        }
        .page-title {
            font-size: 28px;
        }
        .header-actions {
            flex-direction: column;
            align-items: flex-start;
        }
        .offer-stats {
            text-align: left;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        .offer-card {
            padding: 18px;
        }
        .offer-title {
            font-size: 18px;
        }
    }
</style>

<div class="offres-container">
    <div class="offres-bg"></div>
    
    <div class="offres-content animate-fade-up">
        
        <a href="{{ route('partner.dashboard') }}" class="btn-back animate-fade-up">
            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Tableau de bord
        </a>

        {{-- Header --}}
        <div class="page-header">
            <div class="page-badge">📋 Gestion des offres</div>
            <h1 class="page-title">Mes offres</h1>
            <p class="page-subtitle">Gérez vos offres publiées et regardez les candidatures reçues</p>
        </div>

        <div class="header-actions">
            <div></div>
            <a href="{{ route('partner.offres.create') }}" class="btn-create">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouvelle offre
            </a>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="flash-success">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if($offres->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="empty-title">Aucune offre publiée</h3>
                <p class="empty-text">Vous n'avez encore publié aucune offre.</p>
                <a href="{{ route('partner.offres.create') }}" class="btn-create" style="margin-top: 20px; display: inline-flex;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Créer ma première offre
                </a>
            </div>
        @else
            <div class="offers-list">
                @foreach($offres as $offre)
                    @php
                        $typeClass = match($offre->type_offre) {
                            'stage' => 'tag-stage',
                            'emploi' => 'tag-emploi',
                            'alternance' => 'tag-alternance',
                            'these' => 'tag-these',
                            default => ''
                        };
                        $typeIcon = match($offre->type_offre) {
                            'stage' => '📚',
                            'emploi' => '💼',
                            'alternance' => '🔄',
                            'these' => '🎓',
                            default => '📌'
                        };
                    @endphp
                    
                    <div class="offer-card">
                        <div class="offer-header">
                            <div>
                                <h2 class="offer-title">{{ $offre->titre }}</h2>
                                <p class="offer-description">{{ Illuminate\Support\Str::limit($offre->description, 120) }}</p>
                            </div>
                            <div class="offer-stats">
                                <div class="candidatures-count">
                                    Candidatures : <strong>{{ $offre->candidatures_count }}</strong>
                                </div>
                                <a href="{{ route('partner.offres.candidatures', $offre) }}" class="btn-candidatures">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Voir les candidatures
                                </a>
                            </div>
                        </div>
                        
                        <div class="offer-tags">
                            <span class="tag {{ $typeClass }}">
                                {{ $typeIcon }} {{ ucfirst($offre->type_offre) }}
                            </span>
                            <span class="tag">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $offre->localisation ?? 'Localisation non précisée' }}
                            </span>
                            <span class="tag">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $offre->date_limite?->format('d/m/Y') ?? 'Pas de limite' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($offres->hasPages())
                <div class="pagination-nav">
                    {{ $offres->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection