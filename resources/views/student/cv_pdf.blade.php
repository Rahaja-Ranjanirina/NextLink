<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV - {{ $student->prenom }} {{ $student->name }} | NextLink</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #1a1a2e;
            background: linear-gradient(135deg, #f5f7fa 0%, #eef2f7 100%);
            padding: 40px;
            line-height: 1.5;
        }
        
        .cv-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        /* Header Section */
        .cv-header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            padding: 48px 40px;
            color: white;
        }
        
        .cv-name {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }
        
        .cv-title {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 24px;
        }
        
        .cv-contact {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            opacity: 0.9;
        }
        
        /* Content Sections */
        .cv-content {
            padding: 40px;
        }
        
        .section {
            margin-bottom: 32px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #6366f1;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
            display: inline-block;
        }
        
        .section-content {
            color: #334155;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .skills-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }
        
        .skill-tag {
            background: #f1f5f9;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: #475569;
        }
        
        .formation-item, .experience-item {
            margin-bottom: 16px;
        }
        
        .item-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }
        
        .item-subtitle {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 8px;
        }
        
        .social-links {
            display: flex;
            gap: 16px;
            margin-top: 12px;
        }
        
        .social-link {
            color: #6366f1;
            text-decoration: none;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="cv-container">
        <div class="cv-header">
            <h1 class="cv-name">{{ $student->prenom }} {{ $student->name }}</h1>
            @if($student->etudiant && $student->etudiant->filiere)
                <p class="cv-title">{{ $student->etudiant->filiere }} @if($student->etudiant->niveau) - {{ $student->etudiant->niveau }} @endif</p>
            @endif
            
            <div class="cv-contact">
                <div class="contact-item">
                    <span>📧</span> {{ $student->email }}
                </div>
                @if($student->phone)
                    <div class="contact-item">
                        <span>📱</span> {{ $student->phone }}
                    </div>
                @endif
                @if($student->age)
                    <div class="contact-item">
                        <span>🎂</span> {{ $student->age }} ans
                    </div>
                @endif
            </div>
        </div>
        
        <div class="cv-content">
            @if($student->etudiant && $student->etudiant->bio)
                <div class="section">
                    <h2 class="section-title">Profil</h2>
                    <div class="section-content">
                        <p>{{ $student->etudiant->bio }}</p>
                    </div>
                </div>
            @endif
            
            @if($student->etudiant && !empty($student->etudiant->competences))
                <div class="section">
                    <h2 class="section-title">Compétences</h2>
                    <div class="skills-tags">
                        @foreach($student->etudiant->competences as $competence)
                            <span class="skill-tag">{{ $competence }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
            
            @if($student->etudiant && !empty($student->etudiant->formations))
                <div class="section">
                    <h2 class="section-title">Formations</h2>
                    @foreach($student->etudiant->formations as $formation)
                        <div class="formation-item">
                            <div class="item-title">{{ $formation['diplome'] ?? 'Formation' }}</div>
                            <div class="item-subtitle">{{ $formation['ecole'] ?? '' }} @if(!empty($formation['annee'])) • {{ $formation['annee'] }} @endif</div>
                        </div>
                    @endforeach
                </div>
            @endif
            
            @if($student->etudiant && !empty($student->etudiant->langues))
                <div class="section">
                    <h2 class="section-title">Langues</h2>
                    <div class="skills-tags">
                        @foreach($student->etudiant->langues as $langue)
                            <span class="skill-tag">{{ $langue }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
            
            @if(($student->etudiant && $student->etudiant->linkedin) || ($student->etudiant && $student->etudiant->github))
                <div class="section">
                    <h2 class="section-title">Liens</h2>
                    <div class="social-links">
                        @if($student->etudiant && $student->etudiant->linkedin)
                            <a href="{{ $student->etudiant->linkedin }}" class="social-link" target="_blank">🔗 LinkedIn</a>
                        @endif
                        @if($student->etudiant && $student->etudiant->github)
                            <a href="{{ $student->etudiant->github }}" class="social-link" target="_blank">💻 GitHub</a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>