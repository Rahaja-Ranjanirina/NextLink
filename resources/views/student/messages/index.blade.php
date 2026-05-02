@extends('app')

@section('content')
<style>
    /* ========================================
       MESSAGES INDEX - SAME DESIGN AS DASHBOARD
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .messages-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    .messages-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: linear-gradient(145deg, #070b17 0%, #0f1322 50%, #0a0e1a 100%);
    }
    
    .messages-bg::before {
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
    
    .messages-bg::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 40%, rgba(99, 102, 241, 0.08) 0%, transparent 50%);
        pointer-events: none;
    }
    
    .messages-content {
        position: relative;
        z-index: 1;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 48px;
    }
    
    /* Header */
    .messages-header {
        margin-bottom: 32px;
    }
    
    .messages-badge {
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
    
    .messages-title {
        font-size: 42px;
        font-weight: 800;
        line-height: 1.2;
        background: linear-gradient(135deg, #ffffff 0%, #c7d2fe 50%, #a5b4fc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 12px;
    }
    
    .messages-subtitle {
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
    
    /* Student Cards */
    .student-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 24px;
        padding: 20px;
        transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        text-decoration: none;
        display: block;
    }
    
    .student-card:hover {
        border-color: rgba(99, 102, 241, 0.4);
        transform: translateX(6px);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.06) 0%, rgba(255, 255, 255, 0.02) 100%);
    }
    
    .student-avatar {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
        transition: all 0.3s;
    }
    
    .student-card:hover .student-avatar {
        transform: scale(1.05);
        border-radius: 20px;
    }
    
    .student-name {
        font-size: 17px;
        font-weight: 600;
        color: white;
        transition: color 0.2s;
    }
    
    .student-card:hover .student-name {
        color: #a5b4fc;
    }
    
    /* Empty State */
    .empty-state {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 28px;
        padding: 60px 32px;
        text-align: center;
    }
    
    /* Buttons */
    .btn-secondary-custom {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 100px;
        padding: 10px 24px;
        color: #d1d5db;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-secondary-custom:hover {
        background: rgba(255, 255, 255, 0.08);
        color: white;
        transform: translateY(-2px);
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
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
        color: #9ca3af;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .pagination-nav a:hover {
        background: rgba(99, 102, 241, 0.15);
        border-color: rgba(99, 102, 241, 0.3);
        color: #a5b4fc;
    }
    
    .pagination-nav .active span {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
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
    
    /* Responsive */
    @media (max-width: 768px) {
        .messages-content {
            padding: 24px 20px;
        }
        .messages-title {
            font-size: 28px;
        }
        .student-avatar {
            width: 48px;
            height: 48px;
            font-size: 16px;
        }
        .student-name {
            font-size: 15px;
        }
        .header-actions {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="messages-container">
    <div class="messages-bg"></div>
    
    <div class="messages-content animate-fade-up">
        
        {{-- Header avec bouton retour --}}
        <div class="header-actions">
            <div>
                <div class="messages-badge">💬 Messagerie privée</div>
                <h1 class="messages-title">Messages</h1>
                <p class="messages-subtitle">Discutez avec les autres étudiants de la plateforme</p>
            </div>
            
            <a href="{{ route('student.dashboard') }}" class="btn-secondary-custom">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Tableau de bord
            </a>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        {{-- Liste des étudiants --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($students as $other)
                <a href="{{ route('student.messages.chat', $other) }}" class="student-card group">
                    <div class="flex items-center gap-4">
                        <div class="student-avatar">
                            {{ strtoupper(substr($other->full_name, 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="student-name">{{ $other->full_name }}</h2>
                            <p class="text-xs text-gray-500 mt-1 truncate">{{ $other->email }}</p>
                            <div class="flex items-center gap-1 mt-1">
                                <span class="text-xs text-gray-500">{{ optional($other->etudiant)->filiere ?? 'Étudiant' }}</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-indigo-400 transition-all group-hover:translate-x-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @empty
                <div class="empty-state md:col-span-2 lg:col-span-3">
                    <div class="text-6xl mb-4 opacity-50">👥</div>
                    <h3 class="text-xl font-semibold text-white mb-2">Aucun étudiant disponible</h3>
                    <p class="text-gray-400">Revenez plus tard ou invitez d'autres étudiants à rejoindre la plateforme.</p>
                    <a href="{{ route('student.dashboard') }}" class="btn-secondary-custom mt-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Retour au tableau de bord
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($students->hasPages())
            <div class="pagination-nav">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</div>
@endsection