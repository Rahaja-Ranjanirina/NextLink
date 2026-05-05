@extends('app')

@section('content')
<style>
    /* ========================================
       PARTNER CANDIDATURES LIST - PREMIUM DESIGN
       Same design as dashboard
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .candidatures-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .candidatures-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: var(--bg-primary);
    }
    
    .candidatures-bg::before {
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
    
    .candidatures-bg::after {
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
    .candidatures-content {
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
        padding: 12px 28px;
        color: var(--btn-secondary-color);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
        transform: translateY(-2px);
    }
    
    /* Candidature Card */
    .candidature-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 24px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .candidature-card:hover {
        border-color: var(--card-border-hover);
        transform: translateX(4px);
    }
    
    /* Card Header */
    .card-header {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 20px;
    }
    
    @media (min-width: 768px) {
        .card-header {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }
    
    .candidat-name {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
    }
    
    .candidat-email {
        font-size: 13px;
        color: var(--text-muted);
    }
    
    /* Action Buttons Group */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .btn-profile {
        background: var(--btn-secondary-hover-bg);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 100px;
        padding: 8px 18px;
        font-size: 12px;
        font-weight: 500;
        color: var(--btn-secondary-color);
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-profile:hover {
        background: rgba(255, 255, 255, 0.15);
        color: var(--text-primary);
    }
    
    .btn-cv {
        background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
        border: none;
        border-radius: 100px;
        padding: 8px 18px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-primary);
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-cv:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);
    }
    
    .btn-lm {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 100px;
        padding: 8px 18px;
        font-size: 12px;
        font-weight: 500;
        color: var(--badge-text);
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-lm:hover {
        background: var(--badge-bg);
        color: var(--text-primary);
    }
    
    /* Message Box */
    .message-box {
        background: var(--scrollbar-track);
        border: 1px solid var(--btn-secondary-border);
        border-radius: 16px;
        padding: 16px;
        margin-top: 16px;
    }
    
    .message-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--badge-text);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .message-text {
        font-size: 13px;
        color: var(--btn-secondary-color);
        line-height: 1.5;
    }
    
    /* Interview Box */
    .interview-box {
        background: rgba(99, 102, 241, 0.05);
        border: 1px solid rgba(99, 102, 241, 0.15);
        border-radius: 16px;
        padding: 16px;
        margin-top: 16px;
    }
    
    .interview-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--badge-text);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .interview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 12px;
        margin-bottom: 12px;
    }
    
    .interview-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: var(--btn-secondary-color);
    }
    
    .interview-item svg {
        width: 14px;
        height: 14px;
        color: var(--badge-text);
    }
    
    /* Footer Tags */
    .card-footer {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .tag-date {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 100px;
        background: var(--btn-secondary-bg);
        border: 1px solid var(--btn-secondary-border);
        font-size: 11px;
        color: var(--text-muted);
    }
    
    .tag-nouveau {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.08));
        border: 1px solid rgba(239, 68, 68, 0.25);
        color: #f87171;
    }
    
    .tag-lu {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(34, 197, 94, 0.08));
        border: 1px solid rgba(34, 197, 94, 0.25);
        color: #4ade80;
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
        .candidatures-content {
            padding: 24px 20px;
        }
        .page-title {
            font-size: 28px;
        }
        .header-actions {
            flex-direction: column;
            align-items: flex-start;
        }
        .action-buttons {
            width: 100%;
        }
        .action-buttons a {
            flex: 1;
            justify-content: center;
        }
        .candidature-card {
            padding: 18px;
        }
        .candidat-name {
            font-size: 18px;
        }
    }
</style>

<div class="candidatures-container">
    <div class="candidatures-bg"></div>
    
    <div class="candidatures-content animate-fade-up">
        
        {{-- Header --}}
        <div class="page-header">
            <div class="page-badge">📋 Gestion des candidatures</div>
            <h1 class="page-title">Candidatures pour « {{ $offre->titre }} »</h1>
            <p class="page-subtitle">Téléchargez les CV et lettres de motivation, et lisez les messages des étudiants</p>
        </div>

        <div class="header-actions">
            <a href="{{ route('partner.dashboard') }}" class="btn-back">
                <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Tableau de bord
            </a>
            <a href="{{ route('partner.offres') }}" class="btn-back">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour aux offres
            </a>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        @if($candidatures->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="empty-title">Aucune candidature</h3>
                <p class="empty-text">Aucune candidature pour cette offre pour le moment.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($candidatures as $candidature)
                    <div class="candidature-card">
                        {{-- Header --}}
                        <div class="card-header">
                            <div>
                                <h2 class="candidat-name">{{ $candidature->etudiant->full_name }}</h2>
                                <p class="candidat-email">Email : {{ $candidature->etudiant->email }}</p>
                            </div>
                            <div class="action-buttons">
                                <a href="{{ route('partner.candidatures.show', ['offre' => $offre, 'candidature' => $candidature]) }}" class="btn-profile">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Voir le profil
                                </a>
                                @if($candidature->cv || $candidature->etudiant->cv)
                                    <a href="{{ route('partner.candidatures.download', ['candidature' => $candidature, 'type' => 'cv']) }}" class="btn-cv">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Télécharger le CV
                                    </a>
                                @endif
                                @if($candidature->lettre_motivation)
                                    <a href="{{ route('partner.candidatures.download', ['candidature' => $candidature, 'type' => 'lettre_motivation']) }}" class="btn-lm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        Télécharger la LM
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Message de candidature --}}
                        @if($candidature->message)
                            <div class="message-box">
                                <div class="message-title">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    Message de candidature
                                </div>
                                <p class="message-text">{{ $candidature->message }}</p>
                            </div>
                        @endif

                        {{-- Proposition d'entretien --}}
                        @if($candidature->interview_date || $candidature->partner_message)
                            <div class="interview-box">
                                <div class="interview-title">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Proposition d'entretien
                                </div>
                                <div class="interview-grid">
                                    @if($candidature->interview_date)
                                        <div class="interview-item">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span>{{ $candidature->interview_date->format('d/m/Y') }}</span>
                                        </div>
                                    @endif
                                    @if($candidature->interview_time)
                                        <div class="interview-item">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span>{{ $candidature->interview_time }}</span>
                                        </div>
                                    @endif
                                    @if($candidature->interview_location)
                                        <div class="interview-item">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span>{{ $candidature->interview_location }}</span>
                                        </div>
                                    @endif
                                </div>
                                @if($candidature->partner_message)
                                    <p class="message-text" style="margin-top: 8px;">{{ $candidature->partner_message }}</p>
                                @endif
                            </div>
                        @endif

                        {{-- Footer Tags --}}
                        <div class="card-footer">
                            <span class="tag-date">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Soumis le {{ $candidature->created_at->format('d/m/Y H:i') }}
                            </span>
                            <span class="tag-date {{ $candidature->is_read ? 'tag-lu' : 'tag-nouveau' }}">
                                {{ $candidature->is_read ? 'Déjà lu' : 'Nouveau' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($candidatures->hasPages())
                <div class="pagination-nav">
                    {{ $candidatures->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection