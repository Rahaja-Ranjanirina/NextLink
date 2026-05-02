@extends('app')

@section('content')
<style>
    /* ========================================
       STUDENT OFFER DETAIL - PREMIUM DESIGN
       Same design as dashboard
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .offer-detail-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .offer-detail-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: linear-gradient(145deg, #070b17 0%, #0f1322 50%, #0a0e1a 100%);
    }
    
    .offer-detail-bg::before {
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
    
    .offer-detail-bg::after {
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
    .offer-detail-content {
        position: relative;
        z-index: 1;
        max-width: 1000px;
        margin: 0 auto;
        padding: 40px 48px;
    }
    
    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #a5b4fc;
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 24px;
        transition: all 0.2s ease;
    }
    
    .back-link svg {
        width: 14px;
        height: 14px;
    }
    
    .back-link:hover {
        color: #c7d2fe;
        transform: translateX(-4px);
    }
    
    /* Glass Card */
    .glass-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 28px;
        padding: 32px;
        transition: all 0.3s ease;
    }
    
    .glass-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
    }
    
    /* Badges */
    .badge-info {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(59, 130, 246, 0.1));
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .badge-info svg {
        width: 12px;
        height: 12px;
    }
    
    /* Buttons */
    .btn-secondary {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 100px;
        padding: 8px 18px;
        color: #d1d5db;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
    }
    
    .btn-secondary svg {
        width: 14px;
        height: 14px;
    }
    
    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateY(-2px);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 10px 24px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }
    
    .btn-primary svg {
        width: 14px;
        height: 14px;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
    }
    
    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        padding: 14px 18px;
        margin-bottom: 32px;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #d1d5db;
    }
    
    .info-icon {
        width: 32px;
        height: 32px;
        background: rgba(99, 102, 241, 0.12);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .info-icon svg {
        width: 16px;
        height: 16px;
        color: #a5b4fc;
    }
    
    .info-label {
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #9ca3af;
    }
    
    .info-value {
        font-size: 13px;
        font-weight: 500;
        color: white;
    }
    
    /* Section Title */
    .section-title {
        font-size: 17px;
        font-weight: 700;
        color: white;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .section-title svg {
        width: 18px;
        height: 18px;
        color: #a5b4fc;
    }
    
    /* Media Grid */
    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
        margin-top: 14px;
    }
    
    .media-image {
        border-radius: 18px;
        width: 100%;
        height: 180px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .media-image:hover {
        transform: scale(1.02);
    }
    
    .media-video {
        border-radius: 18px;
        width: 100%;
        height: 180px;
        background: black;
    }
    
    /* Already Applied Box */
    .already-applied {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(34, 197, 94, 0.05));
        border: 1px solid rgba(34, 197, 94, 0.25);
        border-radius: 20px;
        padding: 20px;
        text-align: center;
    }
    
    .already-applied svg {
        width: 48px;
        height: 48px;
        margin-bottom: 12px;
    }
    
    /* Form Elements */
    .form-label {
        display: block;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #9ca3af;
        margin-bottom: 6px;
    }
    
    .form-textarea {
        width: 100%;
        background: rgba(10, 12, 16, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 12px 16px;
        color: #e8edf2;
        font-size: 13px;
        resize: vertical;
        transition: all 0.2s ease;
    }
    
    .form-textarea:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    .form-input {
        width: 100%;
        background: rgba(10, 12, 16, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 10px 14px;
        color: #e8edf2;
        font-size: 13px;
        transition: all 0.2s ease;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
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
    
    /* Responsive */
    @media (max-width: 768px) {
        .offer-detail-content {
            padding: 24px 20px;
        }
        .glass-card {
            padding: 20px;
        }
        .info-grid {
            grid-template-columns: 1fr;
        }
        .media-grid {
            grid-template-columns: 1fr;
        }
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
</style>

<div class="offer-detail-container">
    <div class="offer-detail-bg"></div>
    
    <div class="offer-detail-content animate-fade-up">
        
        {{-- Back Link --}}
        <a href="{{ route('student.offres') }}" class="back-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour aux offres
        </a>

        {{-- Main Card --}}
        <div class="glass-card">
            
            {{-- Header --}}
            <div class="border-b border-white/10 pb-6 mb-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <div class="flex flex-wrap items-center gap-3 mb-3">
                            <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $offre->titre }}</h1>
                            @php
                                $typeIcon = match($offre->type_offre) {
                                    'stage' => '📚',
                                    'emploi' => '💼',
                                    'alternance' => '🔄',
                                    'these' => '🎓',
                                    default => '📌'
                                };
                            @endphp
                            <span class="badge-info">
                                {{ $typeIcon }} {{ ucfirst($offre->type_offre) }}
                            </span>
                        </div>
                        <p class="text-gray-400 text-sm">
                            Publié par <span class="text-indigo-400">{{ $offre->publisher->full_name ?? 'Anonyme' }}</span>
                        </p>
                    </div>
                    @if($offre->lien_externe)
                        <a href="{{ $offre->lien_externe }}" target="_blank" class="btn-secondary">
                            Postuler sur le site externe
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Description --}}
            <div class="mb-8">
                <h2 class="section-title">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    Description du poste
                </h2>
                <p class="text-gray-300 leading-relaxed whitespace-pre-line text-sm">{{ $offre->description }}</p>
            </div>

            {{-- Informations --}}
            <div class="info-grid">
                @if($offre->localisation)
                    <div class="info-item">
                        <div class="info-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="info-label">Localisation</div>
                            <div class="info-value">{{ $offre->localisation }}</div>
                        </div>
                    </div>
                @endif
                @if($offre->date_limite)
                    <div class="info-item">
                        <div class="info-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="info-label">Date limite</div>
                            <div class="info-value">{{ $offre->date_limite->format('d/m/Y') }}</div>
                        </div>
                    </div>
                @endif
                <div class="info-item">
                    <div class="info-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="info-label">Publiée le</div>
                        <div class="info-value">{{ $offre->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>

            {{-- Médias --}}
            @if($offre->medias->isNotEmpty())
                <div class="mb-8">
                    <h2 class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Visuels
                    </h2>
                    <div class="media-grid">
                        @foreach($offre->medias as $media)
                            @if($media->type === 'image')
                                <img src="{{ asset('storage/' . $media->path) }}" alt="Visuel offre" class="media-image">
                            @else
                                <video controls class="media-video">
                                    <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                </video>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Candidature Section --}}
            <div class="border-t border-white/10 pt-6">
                @if($dejaPostule)
                    <div class="already-applied">
                        <svg class="text-emerald-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-emerald-100 font-medium text-base">Vous avez déjà postulé à cette offre</p>
                        <p class="text-emerald-100/70 text-xs mt-1">L'équipe recruteuse examinera votre candidature prochainement.</p>
                    </div>
                @else
                    <h2 class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Postuler à cette offre
                    </h2>
                    
                    <form action="{{ route('student.offres.postuler', $offre) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label class="form-label">Message de motivation (optionnel)</label>
                            <textarea name="message" rows="4" class="form-textarea" placeholder="Dites-nous pourquoi vous êtes intéressé par cette opportunité..."></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="form-label">CV (PDF uniquement)</label>
                                <input type="file" name="cv" accept="application/pdf" class="form-input p-2">
                                <p class="text-xs text-gray-500 mt-1">Taille max : 5MB</p>
                            </div>
                            <div>
                                <label class="form-label">Lettre de motivation (PDF)</label>
                                <input type="file" name="lettre_motivation" accept="application/pdf" class="form-input p-2">
                                <p class="text-xs text-gray-500 mt-1">Optionnel mais recommandé</p>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn-primary">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Envoyer ma candidature
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection