@extends('app')

@section('content')
<style>
    /* ========================================
       ENSEIGNANT - LISTE DES OFFRES
       Premium design as dashboard
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
        min-height: 100vh;
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
    .btn-primary {
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
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
    }
    
    /* Offer Cards */
    .offers-grid {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .offer-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 24px;
        transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }
    
    .offer-card:hover {
        border-color: rgba(99, 102, 241, 0.4);
        transform: translateY(-3px);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.06) 0%, rgba(255, 255, 255, 0.02) 100%);
    }
    
    .offer-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 16px;
    }
    
    .offer-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.3;
    }
    
    .offer-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .offer-type.stage {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(59, 130, 246, 0.08));
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.25);
    }
    
    .offer-type.emploi {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(34, 197, 94, 0.08));
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.25);
    }
    
    .offer-type.alternance {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.08));
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }
    
    .offer-type.these {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(139, 92, 246, 0.08));
        color: #c4b5fd;
        border: 1px solid rgba(139, 92, 246, 0.25);
    }
    
    .offer-description {
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 16px;
    }
    
    .offer-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .candidatures-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 100px;
        background: rgba(99, 102, 241, 0.12);
        border: 1px solid rgba(99, 102, 241, 0.2);
        font-size: 12px;
        font-weight: 500;
        color: var(--badge-text);
    }
    
    .offer-location {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: var(--text-secondary);
    }
    
    .offer-date {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: var(--text-secondary);
    }
    
    .action-buttons {
        display: flex;
        gap: 12px;
    }
    
    .action-btn {
        padding: 8px 18px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .action-btn-edit {
        background: rgba(245, 158, 11, 0.15);
        border: 1px solid rgba(245, 158, 11, 0.25);
        color: #fbbf24;
    }
    
    .action-btn-edit:hover {
        background: rgba(245, 158, 11, 0.25);
        color: #fcd34d;
        transform: translateY(-2px);
    }
    
    .action-btn-delete {
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.25);
        color: #f87171;
        cursor: pointer;
    }
    
    .action-btn-delete:hover {
        background: rgba(239, 68, 68, 0.25);
        color: #fca5a5;
        transform: translateY(-2px);
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
        margin-bottom: 24px;
    }
    
    /* Pagination */
    .pagination-nav {
        display: flex;
        justify-content: center;
        margin-top: 40px;
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
        .offer-header {
            flex-direction: column;
        }
        .offer-title {
            font-size: 18px;
        }
        .offer-footer {
            flex-direction: column;
            align-items: flex-start;
        }
        .action-buttons {
            width: 100%;
            justify-content: flex-start;
        }
        .header-actions {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="offres-container">
    <div class="offres-bg"></div>
    
    <div class="offres-content animate-fade-up">
        
        {{-- Header --}}
        <div class="page-header">
            <div class="page-badge">📢 Gestion des offres</div>
            <h1 class="page-title">Mes offres</h1>
            <p class="page-subtitle">Gérez vos annonces publiées sur NextLink</p>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        {{-- Header Actions --}}
        <div class="header-actions">
            <div></div>
            <a href="{{ route('enseignant.offres.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Publier une offre
            </a>
        </div>

        @if($offres->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="empty-title">Aucune offre publiée</h3>
                <p class="empty-text">Vous n'avez pas encore publié d'offre.</p>
                <a href="{{ route('enseignant.offres.create') }}" class="btn-primary" style="padding: 10px 24px;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Publier une offre
                </a>
            </div>
        @else
            <div class="offers-grid">
                @foreach($offres as $offre)
                    @php
                        $typeClass = match($offre->type_offre) {
                            'stage' => 'stage',
                            'emploi' => 'emploi',
                            'alternance' => 'alternance',
                            'these' => 'these',
                            default => 'stage'
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
                            <h2 class="offer-title">{{ $offre->titre }}</h2>
                            <span class="offer-type {{ $typeClass }}">
                                {{ $typeIcon }} {{ ucfirst($offre->type_offre) }}
                            </span>
                        </div>
                        
                        <p class="offer-description">
                            {{ \Illuminate\Support\Str::limit($offre->description, 160) }}
                        </p>
                        
                        <div class="offer-footer">
                            <div class="flex flex-wrap gap-4">
                                <span class="candidatures-count">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    {{ $offre->candidatures_count }} candidature{{ $offre->candidatures_count > 1 ? 's' : '' }}
                                </span>
                                
                                @if($offre->localisation)
                                    <span class="offer-location">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $offre->localisation }}
                                    </span>
                                @endif
                                
                                @if($offre->date_limite)
                                    <span class="offer-date">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Jusqu'au {{ $offre->date_limite->format('d/m/Y') }}
                                    </span>
                                @endif
                            </div>
                            
                            <div class="action-buttons">
                                <a href="{{ route('enseignant.offres.edit', $offre) }}" class="action-btn action-btn-edit">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Modifier
                                </a>
                                <form method="POST" action="{{ route('enseignant.offres.destroy', $offre) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn action-btn-delete">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
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