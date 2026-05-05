@extends('app')

@section('content')
<style>
    /* ========================================
       WELCOME PAGE - PREMIUM LANDING
       Modern & Elegant Interface
       ======================================== */
    
    .welcome-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }
    
    /* Background Premium */
    .welcome-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: var(--bg-primary);
    }
    
    .welcome-bg::before {
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
    
    .welcome-bg::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 40%, var(--accent-light) 0%, transparent 60%);
        pointer-events: none;
    }
    
    /* Content */
    .welcome-content {
        position: relative;
        z-index: 1;
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
    }
    
    /* Grid Layout */
    .content-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 28px;
        align-items: stretch;
    }
    
    /* ========== PREMIUM CARD (Left) ========== */
    .premium-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 32px;
        padding: 48px;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }
    
    .premium-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary), var(--accent-primary));
        opacity: 0.6;
    }
    
    .premium-card:hover {
        border-color: var(--card-border-hover);
        transform: translateY(-4px);
    }
    
    .premium-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--badge-bg);
        border: 1px solid var(--badge-border);
        border-radius: 100px;
        padding: 6px 14px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--badge-text);
        margin-bottom: 24px;
    }
    
    .premium-card h2 {
        font-family: 'Playfair Display', serif;
        font-size: 48px;
        font-weight: 700;
        line-height: 1.2;
        background: var(--title-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 24px;
        letter-spacing: -0.02em;
    }
    
    .premium-card p {
        color: var(--text-secondary);
        font-size: 16px;
        line-height: 1.7;
        margin-bottom: 40px;
        max-width: 90%;
    }
    
    /* Bouton Premium */
    .btn-noble {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
        color: var(--text-primary);
        text-decoration: none;
        border-radius: 100px;
        font-weight: 600;
        font-size: 14px;
        padding: 14px 32px;
        transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        border: none;
    }
    
    .btn-noble:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(99, 102, 241, 0.4);
    }
    
    .btn-noble svg {
        width: 18px;
        height: 18px;
        transition: transform 0.2s;
    }
    
    .btn-noble:hover svg {
        transform: translateX(4px);
    }
    
    /* ========== SUPPORT CARD (Right) ========== */
    .support-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 176, 74, 0.2);
        border-radius: 32px;
        padding: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }
    
    .support-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #e2b04a, #f59e0b, #e2b04a);
        opacity: 0.6;
    }
    
    .support-card:hover {
        border-color: rgba(226, 176, 74, 0.4);
        transform: translateY(-4px);
    }
    
    .icon-box {
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, rgba(226, 176, 74, 0.15), rgba(226, 176, 74, 0.05));
        border: 1px solid rgba(226, 176, 74, 0.25);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        transition: all 0.3s;
    }
    
    .support-card:hover .icon-box {
        transform: scale(1.05);
        border-color: rgba(226, 176, 74, 0.5);
    }
    
    .icon-box svg {
        width: 32px;
        height: 32px;
        color: #e2b04a;
    }
    
    .support-card h3 {
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 12px;
        font-weight: 700;
        color: #e2b04a;
        margin-bottom: 24px;
    }
    
    .data-row {
        width: 100%;
        padding: 18px 0;
        border-bottom: 1px solid var(--divider);
    }
    
    .data-row:last-of-type {
        border-bottom: none;
    }
    
    .data-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        margin-bottom: 6px;
        display: block;
    }
    
    .data-value {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .data-value svg {
        width: 16px;
        height: 16px;
        color: #e2b04a;
    }
    
    .assistance-note {
        margin-top: 20px;
        padding: 12px;
        background: rgba(226, 176, 74, 0.08);
        border-radius: 16px;
        width: 100%;
    }
    
    .assistance-note p {
        font-size: 12px;
        color: rgba(226, 176, 74, 0.9);
        font-style: italic;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    /* ========== ANIMATIONS ========== */
    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    .animate-left {
        animation: fadeInLeft 0.6s ease forwards;
    }
    
    .animate-right {
        animation: fadeInRight 0.6s ease forwards;
    }
    
    /* ========== RESPONSIVE ========== */
    @media (max-width: 1024px) {
        .content-grid { grid-template-columns: 1fr; gap: 24px; }
        .premium-card { padding: 36px; }
        .premium-card h2 { font-size: 36px; }
        .premium-card p { max-width: 100%; font-size: 15px; }
    }
    
    @media (max-width: 768px) {
        .welcome-container { padding: 24px; }
        .premium-card { padding: 28px; }
        .premium-card h2 { font-size: 28px; }
        .support-card { padding: 28px; }
        .btn-noble { padding: 12px 24px; font-size: 13px; }
    }
    
    @media (max-width: 480px) {
        .welcome-container { padding: 16px; }
        .premium-card h2 { font-size: 24px; }
        .premium-card p { font-size: 14px; }
        .icon-box { width: 56px; height: 56px; }
        .icon-box svg { width: 24px; height: 24px; }
    }
</style>

<div class="welcome-container">
    <div class="welcome-bg"></div>
    
    <div class="welcome-content">
        <div class="content-grid">
            
            {{-- Carte Principale Gauche --}}
            <div class="premium-card animate-left">
                <div class="premium-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 8v8M8 12h8"/>
                    </svg>
                    Plateforme NextLink
                </div>
                <h2>L'excellence des <br>télécommunications.</h2>
                <p>
                    NextLink réunit étudiants, enseignants, entreprises et administration au sein d'une interface claire
                    et moderne. Accédez facilement à votre espace métier avec un seul clic.
                </p>
                <a href="{{ route('login') }}" class="btn-noble">
                    Se connecter
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>

            {{-- Carte Support Administration Droite --}}
            <div class="support-card animate-right">
                <div class="icon-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <circle cx="12" cy="11" r="3"></circle>
                        <path d="M7 18.5c0-2.5 2.5-4.5 5-4.5s5 2 5 4.5"></path>
                    </svg>
                </div>
                
                <h3>Administration</h3>

                <div class="data-row">
                    <span class="data-label">Contact Direct</span>
                    <span class="data-value">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.574 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        {{ $admin->phone ?? 'N/A' }}
                    </span>
                </div>

                <div class="data-row">
                    <span class="data-label">Responsable</span>
                    <span class="data-value">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        {{ $admin->name ?? 'N/A' }}
                    </span>
                </div>

                <div class="data-row">
                    <span class="data-label">Email Support</span>
                    <span class="data-value">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        support@nextlink.com
                    </span>
                </div>

                <div class="assistance-note">
                    <p>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 16v-4M12 8h.01"/>
                        </svg>
                        Assistance prioritaire disponible H24
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection