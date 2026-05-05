@extends('app')

@section('content')
<style>
    /* ========================================
       ENSEIGNANT - AJOUTER ÉTUDIANT
       Premium design with scroll
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .add-student-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .add-student-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: var(--bg-primary);
    }
    
    .add-student-bg::before {
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
    
    .add-student-bg::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 40%, var(--accent-light) 0%, transparent 50%);
        pointer-events: none;
    }
    
    /* Content - Scrollable */
    .add-student-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
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
    
    /* Back Link */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--badge-text);
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 24px;
        transition: all 0.2s ease;
    }
    
    .back-link:hover {
        color: #c7d2fe;
        transform: translateX(-4px);
    }
    
    /* Form Card */
    .form-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        padding: 40px;
        transition: all 0.3s ease;
    }
    
    .form-card:hover {
        border-color: var(--card-border-hover);
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
        color: var(--text-muted);
        margin-bottom: 8px;
    }
    
    .form-input {
        width: 100%;
        background: var(--input-bg-focus);
        border: 1px solid var(--btn-secondary-border);
        border-radius: 16px;
        padding: 14px 18px;
        color: var(--input-text);
        font-size: 14px;
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
    }
    
    .form-input:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px var(--accent-light);
        background: rgba(10, 12, 16, 0.95);
    }
    
    .form-input::placeholder {
        color: #4b5563;
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
    
    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
        transform: translateY(-2px);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
        border: none;
        color: var(--text-primary);
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
        .add-student-content {
            padding: 24px 20px;
        }
        .page-title {
            font-size: 28px;
        }
        .form-card {
            padding: 28px;
        }
        .button-group {
            flex-direction: column;
        }
        .btn-secondary, .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="add-student-container">
    <div class="add-student-bg"></div>
    
    <div class="add-student-content animate-fade-up">
        
        {{-- Back Link --}}
        <a href="{{ route('enseignant.etudiants') }}" class="back-link">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour à la liste des étudiants
        </a>

        {{-- Header --}}
        <div class="page-header">
            <div class="page-badge">👨‍🎓 Gestion des étudiants</div>
            <h1 class="page-title">Ajouter un étudiant</h1>
            <p class="page-subtitle">Remplissez le formulaire ci-dessous pour inscrire un nouvel étudiant</p>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
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

        {{-- Form --}}
        <form action="{{ route('enseignant.etudiants.store') }}" method="POST" class="form-card">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}" class="form-input" placeholder="Jean" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Nom</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="Dupont" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="jean.dupont@example.com" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Âge</label>
                <input type="number" name="age" value="{{ old('age') }}" class="form-input" placeholder="20" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Numéro d'inscription</label>
                <input type="text" name="numero_inscription" value="{{ old('numero_inscription') }}" class="form-input" placeholder="IN-2024-001" required>
            </div>
            
            <div class="button-group">
                <a href="{{ route('enseignant.etudiants') }}" class="btn-secondary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Annuler
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter l'étudiant
                </button>
            </div>
        </form>
    </div>
</div>
@endsection