@extends('app')

@section('content')
<style>
    .superadmin-container {
        max-width: 1152px;
        margin: 0 auto;
        padding: 32px 16px;
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
    }

    .superadmin-title {
        font-size: 30px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 24px;
        font-family: 'Playfair Display', serif;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    @media (min-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .stat-card {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 24px;
        backdrop-filter: blur(12px);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        border-color: var(--card-border-hover);
        transform: translateY(-2px);
    }

    .stat-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .stat-number {
        font-size: 36px;
        font-weight: 700;
        color: var(--accent-hover);
    }

    .links-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 24px;
    }

    @media (min-width: 1024px) {
        .links-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .link-card {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 24px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: block;
    }

    .link-card:hover {
        background: var(--card-bg-hover);
        border-color: var(--card-border-hover);
        transform: translateY(-2px);
    }

    .link-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .link-desc {
        color: var(--text-secondary);
        margin-top: 8px;
        font-size: 15px;
    }
</style>

<div class="superadmin-container">
    <h1 class="superadmin-title">Tableau de bord Superadmin</h1>
    <div class="stats-grid">
        <div class="stat-card">
            <h2 class="stat-title">Enseignants</h2>
            <p class="stat-number">{{ $stats['enseignants'] ?? 0 }}</p>
        </div>
        <div class="stat-card">
            <h2 class="stat-title">Étudiants</h2>
            <p class="stat-number">{{ $stats['etudiants'] ?? 0 }}</p>
        </div>
        <div class="stat-card">
            <h2 class="stat-title">Entreprises</h2>
            <p class="stat-number">{{ $stats['entreprises'] ?? 0 }}</p>
        </div>
    </div>
    <div class="links-grid">
        <a href="{{ route('superadmin.enseignants') }}" class="link-card">
            <h3 class="link-title">Gestion des enseignants</h3>
            <p class="link-desc">Ajoutez, modifiez ou supprimez un enseignant.</p>
        </a>
        <a href="{{ route('superadmin.etudiants') }}" class="link-card">
            <h3 class="link-title">Gestion des étudiants</h3>
            <p class="link-desc">Consultez et modifiez les étudiants.</p>
        </a>
    </div>
</div>
@endsection
