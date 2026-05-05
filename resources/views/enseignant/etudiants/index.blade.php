@extends('app')

@section('content')
<style>
    /* ========================================
       ENSEIGNANT - LISTE DES ÉTUDIANTS
       Premium design as dashboard
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .students-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    /* Background premium */
    .students-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: var(--bg-primary);
    }
    
    .students-bg::before {
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
    
    .students-bg::after {
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
    .students-content {
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
    
    .btn-secondary {
        background: var(--btn-secondary-bg);
        border: 1px solid var(--btn-secondary-border);
        border-radius: 100px;
        padding: 8px 16px;
        color: var(--btn-secondary-color);
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }
    
    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
        transform: translateY(-1px);
    }
    
    /* Table */
    .table-container {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        overflow: hidden;
        overflow-x: auto;
    }
    
    .students-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    
    .students-table thead {
        background: rgba(0, 0, 0, 0.3);
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .students-table th {
        text-align: left;
        padding: 16px 20px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        color: var(--text-muted);
    }
    
    .students-table td {
        padding: 16px 20px;
        color: var(--input-text);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        vertical-align: middle;
    }
    
    .students-table tr:last-child td {
        border-bottom: none;
    }
    
    .students-table tr:hover td {
        background: var(--scrollbar-track);
    }
    
    /* Student Info Cell */
    .student-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .student-avatar {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
    }
    
    .student-name {
        font-weight: 600;
        color: var(--text-primary);
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .action-btn {
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .action-btn-view {
        background: rgba(59, 130, 246, 0.15);
        border: 1px solid rgba(59, 130, 246, 0.25);
        color: #60a5fa;
    }
    
    .action-btn-view:hover {
        background: rgba(59, 130, 246, 0.25);
        color: #93c5fd;
    }
    
    .action-btn-edit {
        background: rgba(245, 158, 11, 0.15);
        border: 1px solid rgba(245, 158, 11, 0.25);
        color: #fbbf24;
    }
    
    .action-btn-edit:hover {
        background: rgba(245, 158, 11, 0.25);
        color: #fcd34d;
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
        height: 5px;
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
        .students-content {
            padding: 24px 20px;
        }
        .page-title {
            font-size: 28px;
        }
        .page-subtitle {
            font-size: 14px;
        }
        .students-table th, .students-table td {
            padding: 12px 16px;
        }
        .action-buttons {
            flex-direction: column;
            gap: 6px;
        }
        .action-btn {
            width: 100%;
            justify-content: center;
        }
        .student-avatar {
            width: 32px;
            height: 32px;
            font-size: 11px;
        }
    }
</style>

<div class="students-container">
    <div class="students-bg"></div>
    
    <div class="students-content animate-fade-up">
        
        {{-- Header --}}
        <div class="page-header">
            <div class="page-badge">👨‍🎓 Gestion des étudiants</div>
            <h1 class="page-title">Étudiants</h1>
            <p class="page-subtitle">Gérez les étudiants inscrits sur la plateforme</p>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        {{-- Header Actions --}}
        <div class="header-actions">
            <div></div>
            <a href="{{ route('enseignant.etudiants.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ajouter un étudiant
            </a>
        </div>

        @if($etudiants->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="empty-title">Aucun étudiant</h3>
                <p class="empty-text">Vous n'avez pas encore ajouté d'étudiant.</p>
                <a href="{{ route('enseignant.etudiants.create') }}" class="btn-primary" style="padding: 10px 24px;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter un étudiant
                </a>
            </div>
        @else
            {{-- Table --}}
            <div class="table-container">
                <table class="students-table">
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Email</th>
                            <th>N° d'inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            {{ strtoupper(substr($etudiant->user->prenom, 0, 1)) }}{{ strtoupper(substr($etudiant->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="student-name">{{ $etudiant->user->prenom }} {{ $etudiant->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $etudiant->user->age }} ans</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $etudiant->user->email }}</td>
                                <td>
                                    <span class="bg-indigo-500/10 text-indigo-300 px-2 py-1 rounded-full text-xs">
                                        {{ $etudiant->numero_inscription }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('enseignant.etudiants.show', $etudiant) }}" class="action-btn action-btn-view">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Voir
                                        </a>
                                        <a href="{{ route('enseignant.etudiants.edit', $etudiant) }}" class="action-btn action-btn-edit">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Modifier
                                        </a>
                                        <form method="POST" action="{{ route('enseignant.etudiants.destroy', $etudiant) }}" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($etudiants->hasPages())
                <div class="pagination-nav">
                    {{ $etudiants->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection