@extends('app')

@section('content')
<style>
    /* ========================================
       ADMIN DASHBOARD - WITH SIDEBAR
       Premium design
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    html, body {
        height: 100%;
        overflow: hidden;
    }
    
    .admin-container {
        height: 100vh;
        width: 100vw;
        position: relative;
        font-family: 'Inter', sans-serif;
        overflow: hidden;
        display: flex;
    }
    
    /* Background */
    .admin-bg {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    background: var(--bg-primary);
}
    
    .admin-bg::before {
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
    
    .admin-bg::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 40%, rgba(99, 102, 241, 0.08) 0%, transparent 50%);
        pointer-events: none;
    }
    
    /* ========== SIDEBAR ========== */
    .admin-sidebar {
        width: 280px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border-right: 1px solid rgba(255, 255, 255, 0.06);
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 1;
        flex-shrink: 0;
        height: 100vh;
        overflow-y: auto;
    }
    
    .admin-sidebar::-webkit-scrollbar {
        width: 3px;
    }
    
    .admin-sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03);
    }
    
    .admin-sidebar::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
    }
    
    /* Sidebar Header */
    .sidebar-header {
        padding: 24px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 20px;
    }
    
    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .sidebar-logo-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .sidebar-logo-icon svg {
        width: 22px;
        height: 22px;
        color: white;
    }
    
    .sidebar-logo-text h2 {
        font-size: 18px;
        font-weight: 700;
        color: white;
    }
    
    .sidebar-logo-text p {
        font-size: 10px;
        color: #9ca3af;
    }
    
    /* Sidebar Navigation */
    .sidebar-nav {
        flex: 1;
        padding: 0 16px;
    }
    
    .nav-section {
        margin-bottom: 24px;
    }
    
    .nav-section-title {
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #6b7280;
        padding: 0 12px;
        margin-bottom: 12px;
    }
    
    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 14px;
        color: #9ca3af;
        text-decoration: none;
        transition: all 0.2s ease;
        margin-bottom: 4px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        width: 100%;
        background: none;
        border: none;
        text-align: left;
    }
    
    .nav-item:hover {
        background: rgba(99, 102, 241, 0.1);
        color: #c7d2fe;
    }
    
    .nav-item.active {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.1));
        color: #a5b4fc;
        border: 1px solid rgba(99, 102, 241, 0.25);
    }
    
    .nav-icon {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .nav-icon svg {
        width: 16px;
        height: 16px;
    }
    
    /* Sidebar Footer */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        margin-top: auto;
    }
    
    .logout-sidebar {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 14px;
        color: #f87171;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 13px;
        font-weight: 500;
        background: rgba(239, 68, 68, 0.08);
        border: 1px solid rgba(239, 68, 68, 0.15);
        width: 100%;
        cursor: pointer;
    }
    
    .logout-sidebar:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #fca5a5;
    }
    
    /* ========== MAIN CONTENT ========== */
    .admin-main {
        flex: 1;
        position: relative;
        z-index: 1;
        overflow-y: auto;
        padding: 24px 32px;
    }
    
    .admin-main::-webkit-scrollbar {
        width: 4px;
    }
    
    .admin-main::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 10px;
    }
    
    .admin-main::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
    }
    
    /* Main Header */
    .main-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    .main-title {
        font-size: 24px;
        font-weight: 700;
        background: linear-gradient(135deg, #ffffff, #a5b4fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.04);
        padding: 8px 16px;
        border-radius: 100px;
    }
    
    .user-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }
    
    /* Content Card */
    .content-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 24px;
        padding: 24px;
    }
    
    /* Form Styles */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }
    
    .form-input {
        width: 100%;
        background: rgba(10, 12, 16, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 12px 16px;
        color: #e8edf2;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
    }
    
    /* Table Styles */
    .table-wrapper {
        overflow-x: auto;
        margin-top: 20px;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    
    .data-table thead tr {
        background: rgba(0, 0, 0, 0.3);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    .data-table th {
        text-align: left;
        padding: 14px 16px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        color: #9ca3af;
    }
    
    .data-table td {
        padding: 12px 16px;
        color: #e8edf2;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .data-table tr:hover td {
        background: rgba(255, 255, 255, 0.03);
    }
    
    /* Dropdown Menu */
    .dropdown {
        position: relative;
        display: inline-block;
    }
    
    .dropdown-btn {
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .dropdown-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }
    
    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background: linear-gradient(135deg, #0f1222, #0a0e1a);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        min-width: 200px;
        z-index: 10;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }
    
    .dropdown-content.show {
        display: block;
    }
    
    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        color: #d1d5db;
        text-decoration: none;
        font-size: 13px;
        transition: all 0.2s;
        cursor: pointer;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
    }
    
    .dropdown-item:hover {
        background: rgba(99, 102, 241, 0.15);
        color: #a5b4fc;
    }
    
    .dropdown-item.moderator {
        color: #fbbf24;
    }
    
    .dropdown-item.moderator:hover {
        background: rgba(245, 158, 11, 0.15);
        color: #fcd34d;
    }
    
    .dropdown-item.remove {
        color: #f87171;
    }
    
    .dropdown-item.remove:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #fca5a5;
    }
    
    .moderator-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.08));
        border: 1px solid rgba(245, 158, 11, 0.25);
        border-radius: 100px;
        padding: 2px 8px;
        font-size: 10px;
        font-weight: 600;
        color: #fbbf24;
        margin-left: 8px;
    }
    
    .action-edit {
        color: #a5b4fc;
        text-decoration: none;
        margin-right: 12px;
        font-size: 12px;
        transition: color 0.2s;
    }
    
    .action-edit:hover {
        color: white;
    }
    
    .action-delete {
        background: none;
        border: none;
        color: #f87171;
        cursor: pointer;
        font-size: 12px;
        padding: 0;
    }
    
    .action-delete:hover {
        color: #fca5a5;
    }
    
    /* Flash Messages */
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
    }
    
    .flash-error {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
        border: 1px solid rgba(239, 68, 68, 0.25);
        border-radius: 16px;
        padding: 14px 20px;
        margin-bottom: 24px;
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
    
    /* Responsive */
    @media (max-width: 768px) {
        .admin-sidebar {
            width: 80px;
        }
        .sidebar-logo-text, .nav-item span, .nav-section-title, .logout-sidebar span {
            display: none;
        }
        .nav-item {
            justify-content: center;
            padding: 12px;
        }
        .logout-sidebar {
            justify-content: center;
            padding: 12px;
        }
        .admin-main {
            padding: 16px;
        }
        .main-title {
            font-size: 18px;
        }
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Section Title inside content */
    .section-title {
        font-size: 20px;
        font-weight: 600;
        color: white;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    .section-title svg {
        width: 22px;
        height: 22px;
        color: #a5b4fc;
    }
</style>

<div class="admin-container">
    <div class="admin-bg"></div>
    
    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="sidebar-logo-text">
                    <h2>NextLink</h2>
                    <p>Administration</p>
                </div>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Gestion</div>
                
                <button onclick="showSection('students')" id="btn-students" class="nav-item active">
                    <div class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <span>Étudiants</span>
                </button>
                
                <button onclick="showSection('enseignants')" id="btn-enseignants" class="nav-item">
                    <div class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span>Enseignants</span>
                </button>
                
                <button onclick="showSection('partenaires')" id="btn-partenaires" class="nav-item">
                    <div class="nav-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span>Entreprises</span>
                </button>
            </div>
        </nav>
        
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-sidebar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>
    
    {{-- MAIN CONTENT --}}
    <main class="admin-main">
        <div class="main-header">
            <h1 class="main-title" id="main-title">Gestion des Étudiants</h1>
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
            </div>
        </div>
        
        {{-- Success Message --}}
        @if(session('success'))
            <div class="flash-success">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="flash-error">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-red-100 font-medium mb-1">Veuillez corriger les erreurs :</p>
                        <ul class="error-list">
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        
        {{-- ==================== SECTION ÉTUDIANTS ==================== --}}
        <div id="students-section" class="content-card">
            <h2 class="section-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Ajouter un étudiant
            </h2>
            
            <form action="{{ route('admin.student.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <input type="text" name="first_name" placeholder="Prénom" class="form-input" required>
                    <input type="text" name="last_name" placeholder="Nom" class="form-input" required>
                    <input type="text" name="registration_number" placeholder="Numéro d'inscription" class="form-input" required>
                    <input type="email" name="email" placeholder="Email" class="form-input" required>
                </div>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter l'étudiant
                </button>
            </form>
            
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>N° inscription</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td>{{ $student->prenom }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ optional($student->etudiant)->numero_inscription ?? '-' }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                @if(isset($student->is_moderator) && $student->is_moderator)
                                    <span class="moderator-badge">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Modérateur
                                    </span>
                                @else
                                    <span class="moderator-badge" style="background: rgba(107, 114, 128, 0.15); border-color: rgba(107, 114, 128, 0.25); color: #9ca3af;">
                                        Standard
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                        </svg>
                                    </button>
                                    <div class="dropdown-content">
                                        <a href="{{ route('admin.students.edit', $student) }}" class="dropdown-item">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Modifier
                                        </a>
                                        @if($student->is_moderator)
                                            <form method="POST" action="{{ route('admin.users.remove-moderator', $student) }}" style="display:inline">
                                                @csrf
                                                <button type="submit" class="dropdown-item remove">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                    Retirer modérateur
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.users.make-moderator', $student) }}" style="display:inline">
                                                @csrf
                                                <button type="submit" class="dropdown-item moderator">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                    </svg>
                                                    Ajouter modérateur
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('admin.students.destroy', $student) }}" style="display:inline" onsubmit="return confirm('Supprimer ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item remove">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="6" style="text-align: center; padding: 40px; color: #6b7280;">Aucun étudiant enregistré</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ==================== SECTION ENSEIGNANTS ==================== --}}
        <div id="enseignants-section" class="content-card" style="display: none;">
            <h2 class="section-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Ajouter un enseignant
            </h2>
            
            <form action="{{ route('admin.enseignant.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <input type="text" name="name" placeholder="Nom" class="form-input" value="{{ old('name') }}" required>
                    <input type="text" name="prenom" placeholder="Prénom" class="form-input" value="{{ old('prenom') }}" required>
                    <input type="email" name="email" placeholder="Email" class="form-input" value="{{ old('email') }}" required>
                </div>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter l'enseignant
                </button>
            </form>
            
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enseignants as $enseignant)
                        <tr>
                            <td>{{ $enseignant->prenom }}</td>
                            <td>{{ $enseignant->name }}</td>
                            <td>{{ $enseignant->email }}</td>
                            <td>
                                @if($enseignant->is_moderator)
                                    <span class="moderator-badge">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Modérateur
                                    </span>
                                @else
                                    <span class="moderator-badge" style="background: rgba(107, 114, 128, 0.15); border-color: rgba(107, 114, 128, 0.25); color: #9ca3af;">
                                        Standard
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-btn" onclick="toggleDropdown(this)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                        </svg>
                                    </button>
                                    <div class="dropdown-content">
                                        <a href="{{ route('admin.enseignants.edit', $enseignant) }}" class="dropdown-item">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Modifier
                                        </a>
                                        @if($enseignant->is_moderator)
                                            <form method="POST" action="{{ route('admin.users.remove-moderator', $enseignant) }}" style="display:inline">
                                                @csrf
                                                <button type="submit" class="dropdown-item remove">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                    Retirer modérateur
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.users.make-moderator', $enseignant) }}" style="display:inline">
                                                @csrf
                                                <button type="submit" class="dropdown-item moderator">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                    </svg>
                                                    Ajouter modérateur
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('admin.enseignants.destroy', $enseignant) }}" style="display:inline" onsubmit="return confirm('Supprimer ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item remove">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="5" style="text-align: center; padding: 40px; color: #6b7280;">Aucun enseignant enregistré</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ==================== SECTION PARTENAIRES ==================== --}}
        <div id="partenaires-section" class="content-card" style="display: none;">
            <h2 class="section-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Ajouter un partenaire
            </h2>
            
            <form action="{{ route('admin.partner.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <input type="text" name="name" placeholder="Nom du partenaire" class="form-input" required>
                    <input type="email" name="email" placeholder="Email partenaire" class="form-input" required>
                </div>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter le partenaire
                </button>
            </form>
            
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $partner)
                        <tr>
                            <td>{{ $partner->name }}</td>
                            <td>{{ $partner->email }}</td>
                        </tr>
                        @empty
                            <tr><td colspan="2" style="text-align: center; padding: 40px; color: #6b7280;">Aucun partenaire enregistré</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    function showSection(section) {
        // Hide all sections
        document.getElementById('students-section').style.display = 'none';
        document.getElementById('enseignants-section').style.display = 'none';
        document.getElementById('partenaires-section').style.display = 'none';
        
        // Remove active class from all buttons
        document.getElementById('btn-students').classList.remove('active');
        document.getElementById('btn-enseignants').classList.remove('active');
        document.getElementById('btn-partenaires').classList.remove('active');
        
        // Show selected section
        document.getElementById(section + '-section').style.display = 'block';
        
        // Add active class to selected button
        document.getElementById('btn-' + section).classList.add('active');
        
        // Update main title
        const titles = {
            'students': 'Gestion des Étudiants',
            'enseignants': 'Gestion des Enseignants',
            'partenaires': 'Gestion des Entreprises'
        };
        document.getElementById('main-title').innerText = titles[section];
    }
    
    function toggleDropdown(button) {
        event.stopPropagation();
        const dropdown = button.nextElementSibling;
        dropdown.classList.toggle('show');
    }

    // Fermer le dropdown quand on clique ailleurs
    window.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-content').forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
    });
</script>
@endsection