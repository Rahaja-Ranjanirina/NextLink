@extends('app')

@section('content')
<style>
    /* ========================================
       FORUM CREATE - MODERN FORM
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .forum-create-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    .forum-create-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: linear-gradient(145deg, #070b17 0%, #0f1322 50%, #0a0e1a 100%);
    }
    
    .forum-create-bg::before {
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
    
    .forum-create-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 48px;
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #a5b4fc;
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 32px;
        transition: all 0.2s;
    }
    
    .back-link:hover {
        color: #c7d2fe;
        transform: translateX(-4px);
    }
    
    .form-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 28px;
        padding: 32px;
    }
    
    .form-title {
        font-size: 28px;
        font-weight: 700;
        background: linear-gradient(135deg, #ffffff, #a5b4fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }
    
    .form-subtitle {
        color: #9ca3af;
        font-size: 14px;
        margin-bottom: 32px;
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
    
    .form-input, .form-textarea {
        width: 100%;
        background: rgba(10, 12, 16, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 12px 16px;
        color: #e8edf2;
        font-size: 14px;
        transition: all 0.2s;
    }
    
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    .file-attach-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.05);
        padding: 8px 16px;
        border-radius: 100px;
        font-size: 12px;
        color: #9ca3af;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 8px;
    }
    
    .file-attach-label:hover {
        background: rgba(99, 102, 241, 0.15);
        color: #a5b4fc;
    }
    
    .file-input-hidden {
        display: none;
    }
    
    .file-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 12px;
    }
    
    .file-tag {
        background: rgba(99, 102, 241, 0.15);
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 11px;
        color: #a5b4fc;
    }
    
    .btn-group {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    .btn-cancel {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 100px;
        padding: 10px 24px;
        color: #d1d5db;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.08);
        color: white;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 10px 28px;
        border-radius: 100px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    }
    
    .error-box {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
        border: 1px solid rgba(239, 68, 68, 0.25);
        border-radius: 16px;
        padding: 16px 20px;
        margin-bottom: 24px;
    }
    
    @media (max-width: 768px) {
        .forum-create-content {
            padding: 24px 20px;
        }
        .form-card {
            padding: 24px;
        }
        .form-title {
            font-size: 24px;
        }
        .btn-group {
            flex-direction: column;
        }
        .btn-cancel, .btn-submit {
            justify-content: center;
        }
    }
</style>

<div class="forum-create-container">
    <div class="forum-create-bg"></div>
    
    <div class="forum-create-content">
        <a href="{{ route('student.forum.index') }}" class="back-link">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour au forum
        </a>

        <div class="form-card">
            <h1 class="form-title">Créer un sujet</h1>
            <p class="form-subtitle">Partagez votre expérience avec la communauté</p>

            @if($errors->any())
                <div class="error-box">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-red-100 font-medium mb-1">Veuillez corriger les erreurs :</p>
                            <ul class="list-disc list-inside text-red-100/80 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('student.forum.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label class="form-label">Titre du sujet</label>
                    <input type="text" name="title" class="form-input" value="{{ old('title') }}" placeholder="Donnez un titre clair et accrocheur..." required>
                </div>

                <div class="mb-5">
                    <label class="form-label">Message</label>
                    <textarea name="body" rows="6" class="form-textarea" placeholder="Décrivez votre sujet en détail..." required>{{ old('body') }}</textarea>
                </div>

                <div>
                    <label class="form-label">Pièces jointes (optionnel)</label>
                    <label class="file-attach-label" onclick="document.getElementById('fileInput').click()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        Ajouter des fichiers
                    </label>
                    <input type="file" name="attachments[]" id="fileInput" multiple class="file-input-hidden" accept="image/*,video/*,application/pdf" onchange="updateFileList(this)">
                    <div id="fileList" class="file-list"></div>
                    <p class="text-xs text-gray-500 mt-2">Images, vidéos et PDF acceptés. Max 10MB par fichier.</p>
                </div>

                <div class="btn-group">
                    <a href="{{ route('student.forum.index') }}" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Publier le sujet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateFileList(input) {
        const fileList = document.getElementById('fileList');
        fileList.innerHTML = '';
        if (input.files.length > 0) {
            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                const fileTag = document.createElement('span');
                fileTag.className = 'file-tag';
                fileTag.innerHTML = file.name.substring(0, 40) + (file.name.length > 40 ? '...' : '');
                fileList.appendChild(fileTag);
            }
        }
    }
</script>
@endsection