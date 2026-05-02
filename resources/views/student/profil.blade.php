@extends('app')

@section('content')
<style>
    /* ========================================
       PROFIL PAGE - SAME DESIGN AS DASHBOARD
       Modern & Professional Interface
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .profil-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background avec blur */
   .profil-bg {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    background: var(--bg-primary);
}
    
    .profil-bg::before {
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
    
    .profil-bg::after {
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
    .profil-content {
        position: relative;
        z-index: 1;
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 48px;
    }
    
    /* Header */
    .profil-header {
        margin-bottom: 32px;
    }
    
    .profil-badge {
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
    
    .profil-title {
        font-size: 42px;
        font-weight: 800;
        line-height: 1.2;
        background: linear-gradient(135deg, #ffffff 0%, #c7d2fe 50%, #a5b4fc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 12px;
    }
    
    .profil-subtitle {
        color: rgba(156, 163, 175, 0.8);
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
    }
    
    .divider-dot {
        width: 5px;
        height: 5px;
        background: #6366f1;
        border-radius: 50%;
        opacity: 0.5;
    }
    
    /* Glass Card */
    .glass-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 28px;
        transition: all 0.3s ease;
    }
    
    .glass-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.06) 0%, rgba(255, 255, 255, 0.02) 100%);
    }
    
    /* Form Elements */
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
        background: rgba(10, 12, 16, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 12px 16px;
        color: #e8edf2;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    
    .form-input:focus, .form-textarea:focus, .form-select:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        background: rgba(10, 12, 16, 0.8);
    }
    
    .form-input:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    /* Primary Button */
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 32px;
        border-radius: 100px;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
    }
    
    /* Success Message */
    .success-message {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(34, 197, 94, 0.05));
        border: 1px solid rgba(34, 197, 94, 0.25);
        border-radius: 16px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #4ade80;
        font-size: 14px;
        font-weight: 500;
        animation: fadeInUp 0.4s ease forwards;
    }
    
    /* Section Icon */
    .section-icon {
        width: 44px;
        height: 44px;
        background: rgba(99, 102, 241, 0.15);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
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
    @media (max-width: 1024px) {
        .profil-content {
            padding: 32px 32px;
        }
        
        .profil-title {
            font-size: 32px;
        }
    }
    
    @media (max-width: 768px) {
        .profil-content {
            padding: 24px 20px;
        }
        
        .profil-title {
            font-size: 28px;
        }
        
        .profil-subtitle {
            font-size: 14px;
        }
    }
</style>

<div class="profil-container">
    {{-- Background --}}
    <div class="profil-bg"></div>
    
    {{-- Content --}}
    <div class="profil-content">
        
        {{-- Header --}}
        <div class="profil-header animate-fade-up">
            <div class="profil-badge">Espace personnel</div>
            <h1 class="profil-title">Mon profil étudiant</h1>
            <p class="profil-subtitle">Complétez votre profil pour augmenter vos chances de recrutement</p>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="success-message animate-fade-up">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('student.profil.update') }}" enctype="multipart/form-data" class="animate-fade-up" style="animation-delay: 0.1s">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- Informations personnelles --}}
                <div class="glass-card p-8">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="section-icon">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-white">Informations personnelles</h2>
                    </div>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="form-label">Prénom</label>
                            <input name="prenom" value="{{ old('prenom', $user->prenom) }}" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Nom</label>
                            <input name="name" value="{{ old('name', $user->name) }}" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Email</label>
                            <input type="email" value="{{ $user->email }}" class="form-input" disabled>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Âge</label>
                                <input name="age" type="number" value="{{ old('age', $user->age) }}" class="form-input">
                            </div>
                            <div>
                                <label class="form-label">Téléphone</label>
                                <input name="phone" value="{{ old('phone', $user->phone) }}" class="form-input">
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Photo de profil</label>
                            <input type="file" name="photo" class="form-input p-2" accept="image/*">
                            <p class="text-xs text-gray-500 mt-2">JPG, PNG ou GIF. Max 2MB.</p>
                        </div>
                    </div>
                </div>

                {{-- Informations académiques --}}
                <div class="glass-card p-8">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="section-icon">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-white">Parcours académique</h2>
                    </div>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="form-label"> Spécialité</label>
                            <input name="filiere" value="{{ old('filiere', $etudiant->filiere) }}" class="form-input" placeholder="ex: Réseau et système, Radiocommunication...">
                        </div>
                        <div>
                            <label class="form-label">Niveau d'étude</label>
                            <input name="niveau" value="{{ old('niveau', $etudiant->niveau) }}" class="form-input" placeholder="ex: Bac+3, Master 1, Licence...">
                        </div>
                        <div>
                            <label class="form-label">Bio / Présentation</label>
                            <textarea name="bio" rows="4" class="form-textarea" placeholder="Parlez-nous de vous, de vos objectifs et motivations...">{{ old('bio', $etudiant->bio) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Compétences et réseaux --}}
                <div class="glass-card p-8 lg:col-span-2">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="section-icon">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm4 4h6m-6 4h6m-6 4h6"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-white">Compétences & Liens</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label">LinkedIn</label>
                            <input name="linkedin" value="{{ old('linkedin', $etudiant->linkedin) }}" class="form-input" placeholder="https://linkedin.com/in/...">
                        </div>
                        <div>
                            <label class="form-label">GitHub</label>
                            <input name="github" value="{{ old('github', $etudiant->github) }}" class="form-input" placeholder="https://github.com/...">
                        </div>
                        <div>
                            <label class="form-label">Compétences (séparées par des virgules)</label>
                            <input name="competences" value="{{ old('competences', implode(', ', $etudiant->competences ?? [])) }}" class="form-input" placeholder="PHP, Laravel, React, Python, ...">
                        </div>
                        <div>
                            <label class="form-label">Langues (séparées par des virgules)</label>
                            <input name="langues" value="{{ old('langues', implode(', ', $etudiant->langues ?? [])) }}" class="form-input" placeholder="Français, Anglais, Espagnol...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Mettre à jour mon profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection