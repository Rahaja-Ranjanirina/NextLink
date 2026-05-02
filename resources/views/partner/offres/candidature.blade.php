@extends('app')

@section('content')
<style>
    /* ========================================
       PARTNER CANDIDATURE SHOW - PREMIUM DESIGN
       Same design as dashboard
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .candidature-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .candidature-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: linear-gradient(145deg, #070b17 0%, #0f1322 50%, #0a0e1a 100%);
    }
    
    .candidature-bg::before {
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
    
    .candidature-bg::after {
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
    .candidature-content {
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
    }
    
    .divider-dot {
        width: 5px;
        height: 5px;
        background: #6366f1;
        border-radius: 50%;
        opacity: 0.5;
    }
    
    /* Buttons */
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
    
    .btn-submit {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 32px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
    }
    
    .btn-jitsi {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 32px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .btn-jitsi:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
    }
    
    /* Cards */
    .info-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 24px;
        padding: 24px;
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
    }
    
    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: white;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    .card-title svg {
        width: 20px;
        height: 20px;
        color: #a5b4fc;
    }
    
    /* Info list */
    .info-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .info-item {
        display: flex;
        align-items: baseline;
        gap: 8px;
        font-size: 14px;
        color: #d1d5db;
    }
    
    .info-item strong {
        color: white;
        font-weight: 600;
        min-width: 100px;
    }
    
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .badge-status.en_attente {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }
    
    .badge-status.acceptee {
        background: rgba(34, 197, 94, 0.15);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.25);
    }
    
    .badge-status.refusee {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.25);
    }
    
    /* Section profil */
    .profil-section {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 16px;
        padding: 16px;
        margin-top: 16px;
    }
    
    .profil-title {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #a5b4fc;
        margin-bottom: 8px;
    }
    
    .profil-text {
        font-size: 13px;
        color: #d1d5db;
        line-height: 1.5;
    }
    
    /* Form */
    .form-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 28px;
        padding: 32px;
        margin-top: 32px;
    }
    
    .form-title {
        font-size: 22px;
        font-weight: 700;
        color: white;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #9ca3af;
        margin-bottom: 8px;
    }
    
    .form-input, .form-textarea {
        width: 100%;
        background: rgba(10, 12, 16, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 12px 16px;
        color: #e8edf2;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    /* Flash message */
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
    
    /* History card */
    .history-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 24px;
        padding: 24px;
        margin-top: 24px;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .candidature-content {
            padding: 32px 32px;
        }
        .form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
    }
    
    @media (max-width: 768px) {
        .candidature-content {
            padding: 24px 20px;
        }
        .page-title {
            font-size: 28px;
        }
        .header-actions {
            flex-direction: column;
            align-items: flex-start;
        }
        .grid-cols-3 {
            grid-template-columns: 1fr;
        }
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
</style>

<div class="candidature-container">
    <div class="candidature-bg"></div>
    
    <div class="candidature-content animate-fade-up">
        
        {{-- Header --}}
        <div class="page-header">
            <div class="page-badge">👤 Profil candidat</div>
            <h1 class="page-title">Profil du candidat</h1>
            <p class="page-subtitle">Consultez le profil complet et envoyez une proposition d'entretien</p>
        </div>

        <div class="header-actions">
            <div></div>
            <a href="{{ route('partner.offres.candidatures', $offre) }}" class="btn-back">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour aux candidatures
            </a>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        {{-- Grille principale --}}
        <div class="grid gap-6 lg:grid-cols-3">
            
            {{-- Carte Informations --}}
            <div class="info-card">
                <h2 class="card-title">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informations
                </h2>
                <div class="info-list">
                    <div class="info-item">
                        <strong>Nom :</strong>
                        <span>{{ $candidature->etudiant->full_name }}</span>
                    </div>
                    <div class="info-item">
                        <strong>Email :</strong>
                        <span>{{ $candidature->etudiant->email }}</span>
                    </div>
                    <div class="info-item">
                        <strong>Téléphone :</strong>
                        <span>{{ $candidature->etudiant->phone ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="info-item">
                        <strong>Inscrit le :</strong>
                        <span>{{ $candidature->etudiant->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-item">
                        <strong>Offre :</strong>
                        <span>{{ $offre->titre }}</span>
                    </div>
                    <div class="info-item">
                        <strong>Statut :</strong>
                        @php
                            $statusClass = match($candidature->statut) {
                                'en_attente' => 'en_attente',
                                'acceptee' => 'acceptee',
                                'refusee' => 'refusee',
                                default => 'en_attente'
                            };
                        @endphp
                        <span class="badge-status {{ $statusClass }}">
                            {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Carte Profil détaillé --}}
            <div class="info-card lg:col-span-2">
                <h2 class="card-title">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil détaillé
                </h2>
                
                <div class="profil-section">
                    <div class="profil-title">Bio</div>
                    <div class="profil-text">{{ $candidature->etudiant->etudiant->bio ?? 'Aucune bio fournie.' }}</div>
                </div>
                
                <div class="profil-section">
                    <div class="profil-title">Parcours</div>
                    <div class="profil-text">{{ $candidature->etudiant->etudiant->formations ? implode(', ', $candidature->etudiant->etudiant->formations) : 'Aucun détail de formation.' }}</div>
                </div>
                
                <div class="profil-section">
                    <div class="profil-title">Expériences</div>
                    <div class="profil-text">{{ $candidature->etudiant->etudiant->experiences ? implode(', ', $candidature->etudiant->etudiant->experiences) : 'Aucune expérience listée.' }}</div>
                </div>
                
                <div class="profil-section">
                    <div class="profil-title">Compétences</div>
                    <div class="profil-text">{{ $candidature->etudiant->etudiant->competences ? implode(', ', $candidature->etudiant->etudiant->competences) : 'Aucune compétence renseignée.' }}</div>
                </div>
                
                <div class="profil-section">
                    <div class="profil-title">Langues</div>
                    <div class="profil-text">{{ $candidature->etudiant->etudiant->langues ? implode(', ', $candidature->etudiant->etudiant->langues) : 'Aucune langue renseignée.' }}</div>
                </div>
            </div>
        </div>

        {{-- Formulaire d'invitation --}}
        <div class="form-card">
            <h2 class="form-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Envoyer une proposition d'entretien
            </h2>

            @if(session('success'))
                <div class="flash-success">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('partner.candidatures.invite', ['offre' => $offre, 'candidature' => $candidature]) }}" method="POST">
                @csrf
                
                <div class="form-grid">
                    <div>
                        <label class="form-label">Date d'entretien</label>
                        <input type="date" name="interview_date" value="{{ old('interview_date', $candidature->interview_date?->format('Y-m-d')) }}" class="form-input" />
                    </div>
                    <div>
                        <label class="form-label">Heure</label>
                        <input type="time" name="interview_time" value="{{ old('interview_time', $candidature->interview_time) }}" class="form-input" />
                    </div>
                    <div>
                        <label class="form-label">Lieu / Visio</label>
                        <input type="text" name="interview_location" value="{{ old('interview_location', $candidature->interview_location) }}" class="form-input" placeholder="Ex: En ligne, bureau, etc." />
                    </div>
                </div>

                <div>
                    <label class="form-label">Message</label>
                    <textarea name="partner_message" rows="4" class="form-textarea" placeholder="Indiquez le déroulé de l'entretien, le lieu, le contact...">{{ old('partner_message', $candidature->partner_message) }}</textarea>
                </div>

                <div class="mt-6">
                    <button type="submit" class="btn-submit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Envoyer la proposition
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <a href="{{ route('partner.candidatures.jitsi.start', ['offre' => $offre, 'candidature' => $candidature]) }}" class="btn-jitsi">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Lancer la visioconférence Jitsi
                </a>
            </div>
        </div>

        {{-- Historique --}}
        @if($candidature->interview_date || $candidature->partner_message)
            <div class="history-card">
                <h2 class="card-title">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Historique de l'invitation
                </h2>
                <div class="info-list">
                    <div class="info-item">
                        <strong>Date :</strong>
                        <span>{{ $candidature->interview_date?->format('d/m/Y') ?? 'Pas encore programmée' }}</span>
                    </div>
                    <div class="info-item">
                        <strong>Heure :</strong>
                        <span>{{ $candidature->interview_time ?? 'Pas encore programmée' }}</span>
                    </div>
                    <div class="info-item">
                        <strong>Lieu :</strong>
                        <span>{{ $candidature->interview_location ?? 'Non précisé' }}</span>
                    </div>
                    <div class="info-item">
                        <strong>Message envoyé :</strong>
                        <span>{{ $candidature->partner_message ?? 'Aucun message envoyé.' }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection