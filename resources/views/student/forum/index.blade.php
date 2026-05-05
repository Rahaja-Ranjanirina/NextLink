@extends('app')

@section('content')
<style>
    /* ========================================
       FORUM INDEX - FULLSCREEN NO SCROLL
       Premium Design - One Screen Only
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
    
    .forum-container {
        height: 100vh;
        width: 100vw;
        position: relative;
        font-family: 'Inter', sans-serif;
        overflow: hidden;
    }
    
    /* Background premium */
    .forum-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: var(--bg-primary);
    }
    
    .forum-bg::before {
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
    
    .forum-bg::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 40%, var(--accent-light) 0%, transparent 50%);
        pointer-events: none;
    }
    
    /* Content - Fullscreen flex layout */
    .forum-content {
        position: relative;
        z-index: 1;
        height: 100vh;
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px 40px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    /* Header Section - Compact */
    .forum-header {
        flex-shrink: 0;
        margin-bottom: 16px;
    }
    
    .forum-badge {
        background: var(--badge-bg);
        border: 1px solid var(--badge-border);
        border-radius: 100px;
        padding: 3px 12px;
        display: inline-block;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--badge-text);
        margin-bottom: 10px;
    }
    
    .forum-title {
        font-size: 28px;
        font-weight: 800;
        line-height: 1.2;
        background: var(--title-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 6px;
    }
    
    .forum-description {
        color: var(--text-secondary);
        font-size: 12px;
        font-weight: 400;
    }
    
    /* Action Buttons - Compact */
    .forum-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 14px;
    }
    
    .btn-outline {
        background: var(--btn-secondary-bg);
        border: 1px solid var(--btn-secondary-border);
        border-radius: 100px;
        padding: 6px 18px;
        color: var(--btn-secondary-color);
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
    }
    
    .btn-outline:hover {
        background: var(--btn-secondary-hover-bg);
        color: var(--text-primary);
    }
    
    .btn-primary-gradient {
        background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
        border: none;
        color: var(--text-primary);
        font-weight: 600;
        padding: 6px 22px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary-gradient:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }
    
    /* Stats Cards - Compact Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        flex-shrink: 0;
        margin-bottom: 16px;
    }
    
    .stat-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        padding: 10px 14px;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        border-color: var(--card-border-hover);
    }
    
    .stat-icon {
        width: 32px;
        height: 32px;
        background: rgba(99, 102, 241, 0.12);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
    }
    
    .stat-icon svg {
        width: 16px;
        height: 16px;
    }
    
    .stat-number {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 2px;
    }
    
    .stat-label {
        font-size: 10px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    /* Divider */
    .divider-custom {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
        margin-bottom: 14px;
    }
    
    .divider-line {
        flex: 1;
        height: 1px;
        background: var(--divider-glow);
    }
    
    .divider-dot {
        width: 4px;
        height: 4px;
        background: var(--accent-primary);
        border-radius: 50%;
        opacity: 0.5;
    }
    
    .section-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 12px;
        flex-shrink: 0;
    }
    
    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .section-title span {
        background: var(--badge-bg);
        padding: 2px 8px;
        border-radius: 100px;
        font-size: 11px;
        color: var(--badge-text);
    }
    
    /* Topics List - Scrollable area only */
    .topics-list-container {
        flex: 1;
        overflow-y: auto;
        min-height: 0;
        margin-bottom: 12px;
        padding-right: 4px;
    }
    
    .topics-list-container::-webkit-scrollbar {
        width: 4px;
    }
    
    .topics-list-container::-webkit-scrollbar-track {
        background: var(--scrollbar-track);
        border-radius: 10px;
    }
    
    .topics-list-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 10px;
    }
    
    .topics-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    /* Topic Cards - Compact */
    .topic-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 14px;
        padding: 12px 16px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: block;
    }
    
    .topic-card:hover {
        border-color: rgba(99, 102, 241, 0.4);
        transform: translateX(4px);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.06) 0%, rgba(255, 255, 255, 0.02) 100%);
    }
    
    .topic-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 8px;
    }
    
    .topic-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-primary);
        line-height: 1.3;
    }
    
    .topic-card:hover .topic-title {
        color: var(--badge-text);
    }
    
    .reply-count {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 8px;
        border-radius: 100px;
        background: rgba(99, 102, 241, 0.12);
        border: 1px solid rgba(99, 102, 241, 0.2);
        font-size: 10px;
        font-weight: 500;
        color: var(--badge-text);
        white-space: nowrap;
    }
    
    .topic-excerpt {
        font-size: 11px;
        color: var(--text-muted);
        line-height: 1.4;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .topic-footer {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
    }
    
    .topic-author {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .author-avatar {
        width: 22px;
        height: 22px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 600;
        color: var(--text-primary);
    }
    
    .author-name {
        font-size: 11px;
        font-weight: 500;
        color: var(--badge-text);
    }
    
    .topic-date {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 10px;
        color: var(--text-secondary);
    }
    
    .topic-date svg {
        width: 10px;
        height: 10px;
    }
    
    .topic-tags {
        display: flex;
        gap: 6px;
        margin-left: auto;
    }
    
    .tag {
        background: var(--btn-secondary-bg);
        padding: 2px 8px;
        border-radius: 100px;
        font-size: 9px;
        font-weight: 500;
        color: #8b8b9f;
    }
    
    /* Empty State - Compact */
    .empty-state {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 30px 20px;
        text-align: center;
    }
    
    .empty-icon {
        width: 50px;
        height: 50px;
        background: var(--btn-secondary-bg);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }
    
    .empty-icon svg {
        width: 24px;
        height: 24px;
        color: #4b5563;
    }
    
    .empty-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 6px;
    }
    
    .empty-text {
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 16px;
    }
    
    .empty-btn {
        background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
        border: none;
        color: var(--text-primary);
        font-weight: 600;
        padding: 6px 20px;
        border-radius: 100px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        font-size: 12px;
    }
    
    /* Flash Message */
    .flash-message {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(34, 197, 94, 0.05));
        border: 1px solid rgba(34, 197, 94, 0.25);
        border-radius: 12px;
        padding: 8px 14px;
        margin-bottom: 12px;
        color: #4ade80;
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }
    
    /* Pagination - Compact */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        flex-shrink: 0;
        padding-top: 8px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .pagination {
        display: flex;
        gap: 4px;
        flex-wrap: wrap;
    }
    
    .pagination .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 30px;
        height: 30px;
        padding: 0 10px;
        border-radius: 100px;
        background: var(--btn-secondary-bg);
        border: 1px solid var(--glass-border);
        color: var(--text-muted);
        font-size: 12px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .pagination .page-link:hover {
        background: var(--badge-bg);
        border-color: var(--card-border-hover);
        color: var(--badge-text);
    }
    
    .pagination .active .page-link {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: var(--text-primary);
        border-color: transparent;
    }
    
    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-up {
        animation: fadeInUp 0.4s ease forwards;
    }
    
    /* Responsive */
    @media (max-width: 900px) {
        .forum-content {
            padding: 16px 24px;
        }
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 600px) {
        .forum-content {
            padding: 12px 16px;
        }
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }
        .forum-title {
            font-size: 22px;
        }
        .forum-actions {
            flex-direction: column;
        }
        .btn-outline, .btn-primary-gradient {
            justify-content: center;
        }
        .topic-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="forum-container">
    <div class="forum-bg"></div>
    
    <div class="forum-content animate-fade-up">
        
        {{-- Header Section --}}
        <div class="forum-header">
            <div class="forum-badge">✨ Communauté active</div>
            <h1 class="forum-title">Forum étudiant</h1>
            <p class="forum-description">Échangez, partagez et développez votre réseau</p>
            
            <div class="forum-actions">
                <a href="{{ route('student.dashboard') }}" class="btn-outline">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('student.forum.create') }}" class="btn-primary-gradient">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nouveau sujet
                </a>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <svg class="text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div class="stat-number">{{ $topics->total() }}</div>
                <div class="stat-label">Discussions</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <svg class="text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                </div>
                <div class="stat-number">{{ $topics->sum(fn($t) => $t->messages->count()) }}</div>
                <div class="stat-label">Réponses</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <svg class="text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="stat-number">{{ $topics->unique('student_id')->count() }}</div>
                <div class="stat-label">Participants</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <svg class="text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="stat-number">{{ $topics->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                <div class="stat-label">Cette semaine</div>
            </div>
        </div>

        <div class="divider-custom">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="flash-message">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Section Header --}}
        <div class="section-header">
            <h2 class="section-title">
                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Discussions récentes
                <span>{{ $topics->total() }}</span>
            </h2>
        </div>

        {{-- Topics List - Scrollable Area Only --}}
        <div class="topics-list-container">
            @forelse($topics as $topic)
                <a href="{{ route('student.forum.show', $topic) }}" class="topic-card">
                    <div class="topic-header">
                        <h3 class="topic-title">{{ $topic->title }}</h3>
                        <span class="reply-count">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            {{ $topic->messages->count() }}
                        </span>
                    </div>
                    
                    <p class="topic-excerpt">{{ \Illuminate\Support\Str::limit($topic->body, 100) }}</p>
                    
                    <div class="topic-footer">
                        <div class="topic-author">
                            <div class="author-avatar">
                                {{ strtoupper(substr($topic->student?->full_name ?? 'A', 0, 1)) }}
                            </div>
                            <span class="author-name">{{ $topic->student?->full_name ?? 'Anonyme' }}</span>
                        </div>
                        
                        <div class="topic-date">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $topic->created_at->diffForHumans() }}
                        </div>
                        
                        <div class="topic-tags">
                            @if($topic->created_at->diffInHours(now()) < 24)
                                <div class="tag">🆕 Nouveau</div>
                            @endif
                            @if($topic->messages->count() > 3)
                                <div class="tag">🔥 Populaire</div>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="empty-title">Aucune discussion</h3>
                    <p class="empty-text">Soyez le premier à lancer une conversation !</p>
                    <a href="{{ route('student.forum.create') }}" class="empty-btn">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Créer un sujet
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($topics->hasPages())
            <div class="pagination-wrapper">
                {{ $topics->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection