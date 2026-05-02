@extends('app')

@section('content')
<style>
    /* ========================================
       ENSEIGNANT - PROFIL ÉTUDIANT
       Premium design as dashboard
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .profile-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .profile-bg {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    background: var(--bg-primary);
}
    
    .profile-bg::before {
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
    
    .profile-bg::after {
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
    .profile-content {
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 48px;
        min-height: 100vh;
    }
    
    /* Header */
    .page-header {
        margin-bottom: 32px;
    }
    
    .page-badge {
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
    
    .page-title {
        font-size: 42px;
        font-weight: 800;
        line-height: 1.2;
        background: linear-gradient(135deg, #ffffff 0%, #c7d2fe 50%, #a5b4fc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 12px;
    }
    
    .page-subtitle {
        color: rgba(156, 163, 175, 0.8);
        font-size: 16px;
        font-weight: 400;
    }
    
    /* Back Link */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #a5b4fc;
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 24px;
        transition: all 0.2s ease;
    }
    
    .back-link:hover {
        color: #c7d2fe;
        transform: translateX(-4px);
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
    
    /* Profile Card */
    .profile-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 28px;
        overflow: hidden;
    }
    
    /* Profile Header */
    .profile-header {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.08));
        padding: 32px;
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 32px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        font-weight: 700;
        color: white;
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        overflow: hidden;
    }
    
    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-header-info h2 {
        font-size: 24px;
        font-weight: 700;
        color: white;
        margin-bottom: 6px;
    }
    
    .profile-header-info p {
        color: #9ca3af;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .profile-badge {
        background: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.25);
        border-radius: 100px;
        padding: 4px 12px;
        font-size: 11px;
        font-weight: 500;
        color: #4ade80;
        display: inline-block;
        margin-top: 8px;
    }
    
    .moderator-badge {
        background: rgba(245, 158, 11, 0.15);
        border: 1px solid rgba(245, 158, 11, 0.25);
        border-radius: 100px;
        padding: 4px 12px;
        font-size: 11px;
        font-weight: 500;
        color: #fbbf24;
        display: inline-block;
        margin-top: 8px;
        margin-left: 8px;
    }
    
    /* Profile Body */
    .profile-body {
        padding: 32px;
    }
    
    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .info-item {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        padding: 18px 20px;
        transition: all 0.2s ease;
    }
    
    .info-item:hover {
        background: rgba(255, 255, 255, 0.05);
        transform: translateY(-2px);
    }
    
    .info-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #9ca3af;
        margin-bottom: 10px;
    }
    
    .info-label svg {
        width: 14px;
        height: 14px;
        color: #a5b4fc;
    }
    
    .info-value {
        font-size: 16px;
        font-weight: 500;
        color: white;
        word-break: break-word;
    }
    
    .info-value.empty {
        color: #6b7280;
        font-style: italic;
    }
    
    /* Bio Section */
    .bio-section {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        padding: 20px;
        margin-top: 24px;
    }
    
    .bio-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #a5b4fc;
        margin-bottom: 12px;
    }
    
    .bio-value {
        font-size: 14px;
        line-height: 1.6;
        color: #d1d5db;
    }
    
    .bio-value.empty {
        color: #6b7280;
        font-style: italic;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .btn-message {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 28px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }
    
    .btn-message:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
    }
    
    .btn-back {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 100px;
        padding: 12px 28px;
        color: #d1d5db;
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
        color: white;
        transform: translateY(-2px);
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
        .profile-content {
            padding: 24px 20px;
        }
        .page-title {
            font-size: 28px;
        }
        .profile-header {
            flex-direction: column;
            text-align: center;
        }
        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 32px;
        }
        .info-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .action-buttons {
            flex-direction: column;
        }
        .btn-message, .btn-back {
            justify-content: center;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-bg"></div>
    
    <div class="profile-content animate-fade-up">
        
        {{-- Back Link --}}
        <a href="{{ route('enseignant.dashboard') }}" class="back-link">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour au tableau de bord
        </a>

        {{-- Header --}}
        <div class="page-header">
            <div class="page-badge">👨‍🎓 Profil étudiant</div>
            <h1 class="page-title">Fiche étudiante</h1>
            <p class="page-subtitle">Informations détaillées de l'étudiant</p>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        {{-- Profile Card --}}
        <div class="profile-card">
            {{-- Header --}}
            <div class="profile-header">
                <div class="profile-avatar">
                    @if($etudiant->photo)
                        <img src="{{ asset('storage/' . $etudiant->photo) }}" alt="Photo de profil">
                    @else
                        {{ strtoupper(substr($etudiant->prenom, 0, 1)) }}{{ strtoupper(substr($etudiant->name, 0, 1)) }}
                    @endif
                </div>
                <div class="profile-header-info">
                    <h2>
                        {{ $etudiant->prenom }} {{ $etudiant->name }}
                        @if($etudiant->is_moderator)
                            <span class="moderator-badge">⭐ Modérateur</span>
                        @endif
                    </h2>
                    <p>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ $etudiant->email }}
                    </p>
                    @if($etudiant->etudiant && $etudiant->etudiant->numero_inscription)
                    <div class="profile-badge">
                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1M5 10h14"></path>
                        </svg>
                        N°: {{ $etudiant->etudiant->numero_inscription }}
                    </div>
                    @endif
                </div>
            </div>

            {{-- Body --}}
            <div class="profile-body">
                {{-- Informations Grid --}}
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Nom complet
                        </div>
                        <div class="info-value">{{ $etudiant->prenom }} {{ $etudiant->name }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Email
                        </div>
                        <div class="info-value">{{ $etudiant->email }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1M5 10h14"/>
                            </svg>
                            Numéro d'inscription
                        </div>
                        <div class="info-value">
                            <span class="bg-indigo-500/10 text-indigo-300 px-2 py-1 rounded-full text-xs">
                                {{ $etudiant->etudiant->numero_inscription ?? 'Non défini' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Âge
                        </div>
                        <div class="info-value">{{ $etudiant->age ?? 'Non renseigné' }} ans</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Filière
                        </div>
                        <div class="info-value {{ !$etudiant->etudiant->filiere ?? true ? 'empty' : '' }}">
                            {{ $etudiant->etudiant->filiere ?? 'Non renseigné' }}
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Niveau
                        </div>
                        <div class="info-value {{ !$etudiant->etudiant->niveau ?? true ? 'empty' : '' }}">
                            {{ $etudiant->etudiant->niveau ?? 'Non renseigné' }}
                        </div>
                    </div>
                    
                    @if($etudiant->phone)
                    <div class="info-item">
                        <div class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Téléphone
                        </div>
                        <div class="info-value">{{ $etudiant->phone }}</div>
                    </div>
                    @endif
                    
                    @if($etudiant->etudiant && $etudiant->etudiant->linkedin)
                    <div class="info-item">
                        <div class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/>
                                <circle cx="4" cy="4" r="2" fill="currentColor"/>
                            </svg>
                            LinkedIn
                        </div>
                        <div class="info-value">
                            <a href="{{ $etudiant->etudiant->linkedin }}" target="_blank" class="text-indigo-400 hover:text-indigo-300">
                                {{ $etudiant->etudiant->linkedin }}
                            </a>
                        </div>
                    </div>
                    @endif
                    
                    @if($etudiant->etudiant && $etudiant->etudiant->github)
                    <div class="info-item">
                        <div class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                            GitHub
                        </div>
                        <div class="info-value">
                            <a href="{{ $etudiant->etudiant->github }}" target="_blank" class="text-indigo-400 hover:text-indigo-300">
                                {{ $etudiant->etudiant->github }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Compétences --}}
                @if($etudiant->etudiant && $etudiant->etudiant->competences && count($etudiant->etudiant->competences) > 0)
                <div class="bio-section">
                    <div class="bio-label">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm4 4h6m-6 4h6m-6 4h6"/>
                        </svg>
                        Compétences
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($etudiant->etudiant->competences as $competence)
                            <span class="bg-white/5 px-3 py-1 rounded-full text-sm text-gray-300">{{ $competence }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Langues --}}
                @if($etudiant->etudiant && $etudiant->etudiant->langues && count($etudiant->etudiant->langues) > 0)
                <div class="bio-section">
                    <div class="bio-label">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                        Langues
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($etudiant->etudiant->langues as $langue)
                            <span class="bg-white/5 px-3 py-1 rounded-full text-sm text-gray-300">{{ $langue }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Bio Section --}}
                @if($etudiant->etudiant && $etudiant->etudiant->bio)
                <div class="bio-section">
                    <div class="bio-label">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                        Bio / Présentation
                    </div>
                    <div class="bio-value">{{ $etudiant->etudiant->bio }}</div>
                </div>
                @endif

                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <a href="{{ route('enseignant.messages.chat', $etudiant) }}" class="btn-message">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Envoyer un message
                    </a>
                    <a href="{{ route('enseignant.dashboard') }}" class="btn-back">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour au tableau de bord
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection