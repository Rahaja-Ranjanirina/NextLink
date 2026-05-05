@extends('app')

@section('content')
<style>
    /* ========================================
       CANDIDATURES PAGE - SAME DESIGN AS DASHBOARD
       Modern & Professional Interface
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .candidatures-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background avec blur */
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
    .candidatures-header {
        margin-bottom: 32px;
    }
    
    .candidatures-badge {
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
    
    .candidatures-title {
        font-size: 42px;
        font-weight: 800;
        line-height: 1.2;
        background: var(--title-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 12px;
    }
    
    .candidatures-subtitle {
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
    .btn-secondary-custom {
        background: var(--btn-secondary-bg);
        border: 1px solid var(--btn-secondary-border);
        border-radius: 100px;
        padding: 10px 24px;
        color: var(--btn-secondary-color);
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-secondary-custom:hover {
        background: var(--btn-secondary-hover-bg);
        border-color: var(--card-border-hover);
        color: var(--text-primary);
        transform: translateY(-1px);
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
        margin-bottom: 24px;
    }
    
    .btn-back:hover {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
        transform: translateX(-2px);
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
        border: none;
        color: var(--text-primary);
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 100px;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
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
        background: var(--card-bg-hover);
    }
    
    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }
    
    .badge-warning {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(245, 158, 11, 0.1));
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }
    
    .badge-info {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(59, 130, 246, 0.1));
        color: var(--info);
        border: 1px solid rgba(59, 130, 246, 0.3);
    }
    
    .badge-success {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(34, 197, 94, 0.1));
        color: var(--success);
        border: 1px solid rgba(34, 197, 94, 0.3);
    }
    
    .badge-error {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(239, 68, 68, 0.1));
        color: var(--error);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    /* File Link */
    .file-link {
        color: var(--accent-hover);
        text-decoration: none;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }
    
    .file-link:hover {
        color: var(--text-primary);
        transform: translateY(-1px);
    }
    
    /* Message Box */
    .message-box {
        background: var(--btn-secondary-bg);
        border-radius: 16px;
        padding: 14px 16px;
        margin-top: 16px;
    }
    
    .partner-message {
        background: var(--accent-light);
        border: 1px solid var(--accent-border);
        border-radius: 16px;
        padding: 16px;
        margin-top: 16px;
    }
    
    .interview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
        margin-top: 16px;
        padding: 16px;
        background: var(--btn-secondary-bg);
        border-radius: 16px;
    }
    
    .interview-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-primary);
        font-size: 13px;
    }
    
    /* Empty State */
    .empty-state {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 60px 32px;
        text-align: center;
    }
    
    .empty-icon {
        width: 80px;
        height: 80px;
        background: var(--nav-icon-bg);
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }
    
    .empty-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }
    
    .empty-text {
        font-size: 14px;
        color: var(--text-secondary);
        margin-bottom: 24px;
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
        
        .candidatures-title {
            font-size: 28px;
        }
        
        .candidatures-subtitle {
            font-size: 14px;
        }
        
        .header-flex {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .interview-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }
</style>

<div class="candidatures-container">
    {{-- Background --}}
    <div class="candidatures-bg"></div>
    
    {{-- Content --}}
    <div class="candidatures-content">
        
        <a href="{{ route('student.dashboard') }}" class="btn-back animate-fade-up">
            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Tableau de bord
        </a>

        {{-- Header --}}
        <div class="candidatures-header animate-fade-up">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 header-flex">
                <div>
                    <div class="candidatures-badge">Suivi des candidatures</div>
                    <h1 class="candidatures-title">Mes candidatures</h1>
                    <p class="candidatures-subtitle">Retrouvez ici toutes vos candidatures et leur évolution.</p>
                </div>
                <a href="{{ route('student.offres') }}" class="btn-secondary-custom">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Découvrir des offres
                </a>
            </div>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        @if($candidatures->isEmpty())
            <div class="empty-state animate-fade-up">
                <div class="empty-icon">
                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="empty-title">Aucune candidature</h3>
                <p class="empty-text">Vous n'avez pas encore postulé à une offre.</p>
                <a href="{{ route('student.offres') }}" class="btn-primary-custom">Explorer les offres</a>
            </div>
        @else
            <div class="grid gap-5 animate-fade-up" style="animation-delay: 0.1s">
                @foreach($candidatures as $candidature)
                    <div class="glass-card p-6 hover:border-indigo-500/30 transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-3 mb-2">
                                    <h2 class="text-xl font-semibold text-white">{{ $candidature->offre->titre }}</h2>
                                    @php
                                        $badgeClass = match($candidature->statut) {
                                            'en_attente' => 'badge-warning',
                                            'vue' => 'badge-info',
                                            'acceptee' => 'badge-success',
                                            default => 'badge-error'
                                        };
                                        $badgeText = match($candidature->statut) {
                                            'en_attente' => 'En attente',
                                            'vue' => 'Consultée',
                                            'acceptee' => 'Acceptée',
                                            'refusee' => 'Refusée',
                                            default => ucfirst(str_replace('_', ' ', $candidature->statut))
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $badgeText }}</span>
                                </div>
                                <p class="text-gray-400 text-sm">
                                    Publié par {{ $candidature->offre->publisher->full_name ?? "l'équipe NextLink" }}
                                </p>
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-3">
                                @if($candidature->cv)
                                    <a href="{{ asset('storage/' . $candidature->cv) }}" target="_blank" class="file-link">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        CV
                                    </a>
                                @endif
                                @if($candidature->lettre_motivation)
                                    <a href="{{ asset('storage/' . $candidature->lettre_motivation) }}" target="_blank" class="file-link">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        Lettre
                                    </a>
                                @endif
                                <a href="{{ route('student.candidatures.jitsi', $candidature) }}" target="_blank" class="btn-primary-custom text-sm py-2 px-5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    Rejoindre Jitsi
                                </a>
                            </div>
                        </div>

                        @if($candidature->message)
                            <div class="message-box">
                                <p class="text-sm text-gray-300">
                                    <span class="font-medium text-gray-200">Votre message :</span> {{ $candidature->message }}
                                </p>
                            </div>
                        @endif

                        @if($candidature->partner_message)
                            <div class="partner-message">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-indigo-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-indigo-300 mb-1">Message du recruteur</p>
                                        <p class="text-gray-300">{{ $candidature->partner_message }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($candidature->interview_date || $candidature->interview_time || $candidature->interview_location)
                            <div class="interview-grid">
                                @if($candidature->interview_date)
                                    <div class="interview-item">
                                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $candidature->interview_date->format('d/m/Y') }}</span>
                                    </div>
                                @endif
                                @if($candidature->interview_time)
                                    <div class="interview-item">
                                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $candidature->interview_time }}</span>
                                    </div>
                                @endif
                                @if($candidature->interview_location)
                                    <div class="interview-item">
                                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ $candidature->interview_location }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection