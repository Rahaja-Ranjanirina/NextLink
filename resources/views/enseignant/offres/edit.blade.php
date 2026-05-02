@extends('app')

@section('content')
<style>
    /* ========================================
       ENSEIGNANT - MODIFIER UNE OFFRE
       Premium design as dashboard
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .edit-offre-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .edit-offre-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: linear-gradient(145deg, #070b17 0%, #0f1322 50%, #0a0e1a 100%);
    }
    
    .edit-offre-bg::before {
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
    
    .edit-offre-bg::after {
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
    .edit-offre-content {
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
    
    /* Offer Info Card */
    .offer-info-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 28px;
        padding: 24px 32px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    
    .offer-info-text h3 {
        font-size: 18px;
        font-weight: 600;
        color: white;
        margin-bottom: 4px;
    }
    
    .offer-info-text p {
        font-size: 13px;
        color: #9ca3af;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .offer-status-badge {
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.25);
        border-radius: 100px;
        padding: 6px 16px;
        font-size: 12px;
        font-weight: 500;
        color: #a5b4fc;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    /* Form Card */
    .form-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 28px;
        padding: 40px;
        transition: all 0.3s ease;
    }
    
    .form-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
    }
    
    /* Form Elements */
    .form-group {
        margin-bottom: 24px;
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
    
    .form-input, .form-textarea, .form-select {
        width: 100%;
        background: rgba(10, 12, 16, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 14px 18px;
        color: #e8edf2;
        font-size: 14px;
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
    }
    
    .form-input:focus, .form-textarea:focus, .form-select:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        background: rgba(10, 12, 16, 0.95);
    }
    
    .form-input::placeholder, .form-textarea::placeholder {
        color: #4b5563;
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    /* Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    /* Button Group */
    .button-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-top: 32px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .btn-secondary {
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
        padding: 12px 32px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
    }
    
    /* Error Messages */
    .error-message {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
        border: 1px solid rgba(239, 68, 68, 0.25);
        border-radius: 16px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    
    .error-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .error-list li {
        color: #f87171;
        font-size: 13px;
        margin-bottom: 4px;
    }
    
    .error-list li:last-child {
        margin-bottom: 0;
    }
    
    /* Success Message */
    .success-message {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(34, 197, 94, 0.05));
        border: 1px solid rgba(34, 197, 94, 0.25);
        border-radius: 16px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #4ade80;
        font-size: 13px;
        font-weight: 500;
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
        .edit-offre-content {
            padding: 24px 20px;
        }
        .page-title {
            font-size: 28px;
        }
        .form-card {
            padding: 28px;
        }
        .form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .button-group {
            flex-direction: column;
        }
        .btn-secondary, .btn-primary {
            width: 100%;
            justify-content: center;
        }
        .offer-info-card {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<div class="edit-offre-container">
    <div class="edit-offre-bg"></div>
    
    <div class="edit-offre-content animate-fade-up">
        
        {{-- Back Link --}}
        <a href="{{ route('enseignant.offres') }}" class="back-link">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour à la liste des offres
        </a>

        {{-- Header --}}
        <div class="page-header">
            <div class="page-badge">✏️ Modification d'offre</div>
            <h1 class="page-title">Modifier l'offre</h1>
            <p class="page-subtitle">Mettez à jour les informations de votre offre</p>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        {{-- Offer Info Card --}}
        <div class="offer-info-card">
            <div class="offer-info-text">
                <h3>{{ $offre->titre }}</h3>
                <p>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Publiée le {{ $offre->created_at->format('d/m/Y') }}
                </p>
            </div>
            <div class="offer-status-badge">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                En cours de modification
            </div>
        </div>

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="error-message">
                <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-red-100 font-medium mb-1">Veuillez corriger les erreurs suivantes :</p>
                    <ul class="error-list">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="success-message">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('enseignant.offres.update', $offre) }}" method="POST" class="form-card">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Titre de l'offre</label>
                <input type="text" name="titre" value="{{ old('titre', $offre->titre) }}" class="form-input" placeholder="Ex: Développeur Full Stack" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-textarea" placeholder="Décrivez le poste, les missions, le profil recherché...">{{ old('description', $offre->description) }}</textarea>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Lien externe (optionnel)</label>
                    <input type="url" name="lien_externe" value="{{ old('lien_externe', $offre->lien_externe) }}" class="form-input" placeholder="https://...">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Type d'offre</label>
                    <select name="type_offre" class="form-select">
                        <option value="stage" {{ old('type_offre', $offre->type_offre) == 'stage' ? 'selected' : '' }}>Stage</option>
                        <option value="emploi" {{ old('type_offre', $offre->type_offre) == 'emploi' ? 'selected' : '' }}>Emploi</option>
                        <option value="alternance" {{ old('type_offre', $offre->type_offre) == 'alternance' ? 'selected' : '' }}>Alternance</option>
                        <option value="these" {{ old('type_offre', $offre->type_offre) == 'these' ? 'selected' : '' }}>Thèse</option>
                    </select>
                </div>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Localisation</label>
                    <input type="text" name="localisation" value="{{ old('localisation', $offre->localisation) }}" class="form-input" placeholder="Paris, Lyon, Télétravail...">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Date limite de candidature</label>
                    <input type="date" name="date_limite" value="{{ old('date_limite', $offre->date_limite?->format('Y-m-d')) }}" class="form-input">
                </div>
            </div>
            
            <div class="button-group">
                <a href="{{ route('enseignant.offres') }}" class="btn-secondary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Annuler
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection