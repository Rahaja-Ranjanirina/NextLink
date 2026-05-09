@extends('app')

@section('content')
<style>
    /* ========================================
       STUDENT OFFERS INDEX - PREMIUM DESIGN
       Same design as dashboard
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .offers-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .offers-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: var(--bg-primary);
    }
    
    .offers-bg::before {
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
    
    .offers-bg::after {
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
    .offers-content {
        position: relative;
        z-index: 1;
        max-width: 1200px;
        margin: 0 auto;
        padding: clamp(20px, 4vh, 40px) clamp(12px, 4vw, 48px);
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
        font-size: clamp(24px, 4vw, 42px);
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
    
    /* Header Actions with Back Button */
    .header-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 24px;
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
    
    /* Back Button */
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
    }
    
    .btn-back:hover {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
        transform: translateX(-2px);
    }
    
    /* Glass Card */
    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        transition: all 0.3s ease;
    }
    
    .glass-card:hover {
        border-color: var(--card-border-hover);
    }
    
    /* Badges */
    .badge-info {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(59, 130, 246, 0.1));
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.25);
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .badge-success {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(34, 197, 94, 0.1));
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 500;
    }
    
    /* Button Primary */
    .btn-primary {
        background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
        border: none;
        color: var(--text-primary);
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
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
        border-color: rgba(99, 102, 241, 0.4);
        transform: translateX(4px);
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
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .offer-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 12px;
    }
    
    .meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--text-secondary);
    }
    
    .offer-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
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
        width: 80px;
        height: 80px;
        background: var(--btn-secondary-bg);
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    
    .empty-title {
        font-size: 20px;
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
        .offers-content {
            padding: 20px 15px;
        }
        .page-title {
            font-size: 24px;
        }
        .page-subtitle {
            font-size: 14px;
        }
        .offer-card {
            padding: 16px;
            border-radius: 18px;
        }
        .offer-title {
            font-size: 17px;
        }
        .offer-footer {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }
        .btn-primary {
            width: 100%;
            justify-content: center;
        }
        .badge-success {
            align-self: flex-start;
        }
    }
</style>

<div class="offers-container">
    <div class="offers-bg"></div>
    
    <div class="offers-content animate-fade-up">
        
        {{-- Header with Back Button --}}
        <div class="header-actions">
            <div></div>
            <a href="{{ route('student.dashboard') }}" class="btn-back">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Tableau de bord
            </a>
        </div>

        {{-- Header --}}
        <div class="page-header">
            <div class="page-badge">📢 Opportunités</div>
            <h1 class="page-title">Toutes les offres</h1>
            <p class="page-subtitle">Découvrez les offres de stage, alternance et emploi qui vous correspondent</p>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        @if($offres->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="empty-title">Aucune offre disponible</h3>
                <p class="empty-text">Revenez plus tard, de nouvelles offres seront bientôt publiées.</p>
            </div>
        @else
            <div class="offers-list">
                @foreach($offres as $offre)
                    @php
                        $typeIcon = match($offre->type_offre) {
                            'stage' => '📚',
                            'emploi' => '💼',
                            'alternance' => '🔄',
                            'these' => '🎓',
                            default => '📌'
                        };
                    @endphp
                    
                    <div class="offer-card">
                        @if($offre->medias && $offre->medias->count() > 0)
                            @php
                                $imageMedia = $offre->medias->firstWhere('type', 'image') ?? $offre->medias->first();
                            @endphp
                            @if($imageMedia)
                                <div class="mb-4 overflow-hidden rounded-xl border border-[var(--glass-border)] bg-black/20" style="height: 250px;">
                                    <img src="{{ $imageMedia->url }}" alt="{{ $offre->titre }}" class="w-full h-full object-contain transition-transform duration-500 hover:scale-105">
                                </div>
                            @endif
                        @endif
                        <div class="offer-header">
                            <div class="flex flex-wrap items-center gap-3 mb-2">
                                <h2 class="offer-title">{{ $offre->titre }}</h2>
                                <span class="badge-info">
                                    {{ $typeIcon }} {{ ucfirst($offre->type_offre) }}
                                </span>
                            </div>
                            <p class="offer-description">{{ \Illuminate\Support\Str::limit($offre->description, 150) }}</p>
                            
                            <div class="offer-meta">
                                @if($offre->localisation)
                                    <span class="meta-item">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $offre->localisation }}
                                    </span>
                                @else
                                    <span class="meta-item">🌐 En ligne</span>
                                @endif
                                @if($offre->date_limite)
                                    <span class="meta-item">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Jusqu'au {{ $offre->date_limite->format('d/m/Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="offer-footer">
                            @if(in_array($offre->id, $offresPostulees))
                                <span class="badge-success">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Candidature envoyée
                                </span>
                            @else
                                <div></div>
                            @endif
                            <a href="{{ route('student.offres.show', $offre) }}" class="btn-primary">
                                Voir l'offre
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
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