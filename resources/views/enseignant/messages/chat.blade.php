@extends('app')

@section('content')
<style>
    .messages-container {
        height: 500px;
        overflow-y: auto;
        padding: 20px;
        background: var(--scrollbar-track);
        border-radius: 20px;
    }
    
    .messages-container::-webkit-scrollbar {
        width: 5px;
    }
    
    .messages-container::-webkit-scrollbar-track {
        background: var(--btn-secondary-bg);
        border-radius: 10px;
    }
    
    .messages-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 10px;
    }
    
    .message-bubble {
        max-width: 70%;
        padding: 12px 16px;
        border-radius: 18px;
        margin-bottom: 12px;
        word-wrap: break-word;
    }
    
    .message-my {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: var(--text-primary);
        margin-left: auto;
        border-bottom-right-radius: 4px;
    }
    
    .message-other {
        background: var(--btn-secondary-hover-bg);
        color: var(--input-text);
        margin-right: auto;
        border-bottom-left-radius: 4px;
        border: 1px solid var(--btn-secondary-border);
    }
    
    .message-time {
        font-size: 10px;
        opacity: 0.6;
        margin-top: 5px;
        text-align: right;
    }
    
    .attach-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }
    
    .attach-image {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.2s;
    }
    
    .attach-image:hover {
        transform: scale(1.05);
        border-color: var(--accent-primary);
    }
    
    .attach-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .attach-file {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: var(--btn-secondary-hover-bg);
        border-radius: 10px;
        font-size: 11px;
        color: var(--badge-text);
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .attach-file:hover {
        background: rgba(99, 102, 241, 0.2);
        color: var(--text-primary);
    }
    
    .btn-send {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border: none;
        color: var(--text-primary);
        font-weight: 600;
        padding: 10px 24px;
        border-radius: 100px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    }
    
    .form-textarea {
        width: 100%;
        background: var(--input-bg-focus);
        border: 1px solid var(--btn-secondary-border);
        border-radius: 16px;
        padding: 12px 16px;
        color: var(--input-text);
        font-size: 14px;
        resize: vertical;
    }
    
    .form-textarea:focus {
        outline: none;
        border-color: var(--accent-primary);
    }
    
    .file-tag {
        background: var(--badge-bg);
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 11px;
        color: var(--badge-text);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .attach-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.06);
        padding: 8px 16px;
        border-radius: 100px;
        font-size: 12px;
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .attach-label:hover {
        background: var(--badge-bg);
        color: var(--badge-text);
    }
    
    .flash-message {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(34, 197, 94, 0.05));
        border: 1px solid rgba(34, 197, 94, 0.25);
        border-radius: 16px;
        padding: 12px 16px;
        margin-bottom: 20px;
        color: #4ade80;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .hidden {
        display: none;
    }
</style>

<div class="container-custom py-8">
    
    {{-- Header avec boutons retour --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-xl font-bold text-white shadow-lg">
                {{ strtoupper(substr($student->prenom ?? $student->name, 0, 1)) }}{{ strtoupper(substr($student->name ?? '', 0, 1)) }}
            </div>
            <div>
                <h1 class="text-2xl font-bold text-white">{{ $student->prenom }} {{ $student->name }}</h1>
                <p class="text-sm text-gray-400">{{ $student->email }}</p>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('student.messages.index') }}" class="btn-secondary text-sm py-2 px-4">
                ← Tous les messages
            </a>
            <a href="{{ route('student.dashboard') }}" class="btn-secondary text-sm py-2 px-4">
                Tableau de bord
            </a>
        </div>
    </div>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="flash-message">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-4 mb-6">
            <ul class="list-disc list-inside text-red-100 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Messages --}}
    <div class="messages-container" id="messagesContainer">
        @forelse($messages as $message)
            @php
                $isMyMessage = ($message->sender_id === auth()->id());
            @endphp
            <div class="message-bubble {{ $isMyMessage ? 'message-my' : 'message-other' }}">
                <div class="text-sm">{{ $message->body }}</div>
                
                @if(!empty($message->attachments))
                    <div class="attach-preview">
                        @foreach($message->attachments as $attachment)
                            @if($attachment['type'] === 'image')
                                <div class="attach-image" onclick="openImageModal('{{ asset('storage/' . $attachment['path']) }}')">
                                    <img src="{{ asset('storage/' . $attachment['path']) }}" alt="{{ $attachment['name'] }}">
                                </div>
                            @elseif($attachment['type'] === 'video')
                                <a href="{{ asset('storage/' . $attachment['path']) }}" target="_blank" class="attach-file">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $attachment['name'] }}
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $attachment['path']) }}" target="_blank" class="attach-file">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    {{ $attachment['name'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
                
                <div class="message-time">
                    {{ $message->created_at->format('H:i, d/m/Y') }}
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <div class="text-5xl mb-4">💬</div>
                <p class="text-gray-400">Aucun message pour le moment</p>
                <p class="text-sm text-gray-500 mt-2">Envoyez le premier message !</p>
            </div>
        @endforelse
    </div>

    {{-- Formulaire d'envoi --}}
    <div class="bg-white/5 rounded-xl p-6 mt-6">
        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Nouveau message
        </h3>
        
        {{-- CORRECTION : URL directe --}}
        <form action="/student/messages/{{ $student->id }}" method="POST" enctype="multipart/form-data" id="messageForm">
            @csrf
            <textarea name="body" rows="3" class="form-textarea" placeholder="Écrivez votre message...">{{ old('body') }}</textarea>
            
            <div class="flex items-center justify-between flex-wrap gap-3 mt-4">
                <div>
                    <label class="attach-label" onclick="document.getElementById('fileInput').click()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        Joindre des fichiers
                    </label>
                    <input type="file" name="attachments[]" id="fileInput" multiple class="hidden" accept="image/*,video/*,application/pdf" onchange="updateFileList(this)">
                </div>
                <button type="submit" class="btn-send">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Envoyer
                </button>
            </div>
            <div id="fileList" class="flex flex-wrap gap-2 mt-3"></div>
            <p class="text-xs text-gray-500 mt-2">Images, vidéos et PDF acceptés (max 10MB)</p>
        </form>
    </div>
</div>

{{-- Modal pour afficher les images --}}
<div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-4" onclick="closeImageModal()">
    <div class="relative max-w-4xl w-full" onclick="event.stopPropagation()">
        <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white bg-white/10 hover:bg-white/20 rounded-full p-2 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="modalImage" src="" alt="" class="w-full rounded-xl shadow-2xl">
    </div>
</div>

<script>
    // Auto-scroll en bas des messages
    const container = document.getElementById('messagesContainer');
    if (container) {
        container.scrollTop = container.scrollHeight;
    }
    
    function updateFileList(input) {
        const fileList = document.getElementById('fileList');
        fileList.innerHTML = '';
        if (input.files.length > 0) {
            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                const tag = document.createElement('span');
                tag.className = 'file-tag';
                tag.innerHTML = `
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    ${file.name.substring(0, 25)}${file.name.length > 25 ? '...' : ''}
                `;
                fileList.appendChild(tag);
            }
        }
    }
    
    function openImageModal(src) {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('modalImage');
        img.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('modalImage').src = '';
        document.body.style.overflow = 'auto';
    }
    
    // Envoyer avec Ctrl+Entrée
    document.getElementById('messageForm')?.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
            e.preventDefault();
            this.submit();
        }
    });
</script>
@endsection