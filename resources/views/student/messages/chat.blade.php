@extends('app')

@section('content')
<style>
    /* ========================================
       CHAT PAGE - SAME DESIGN AS DASHBOARD
       ======================================== */
    
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap');
    
    .chat-container {
        min-height: 100vh;
        position: relative;
        font-family: 'Inter', sans-serif;
    }
    
    .chat-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: linear-gradient(145deg, #070b17 0%, #0f1322 50%, #0a0e1a 100%);
    }
    
    .chat-bg::before {
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
    
    .chat-bg::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 40%, rgba(99, 102, 241, 0.08) 0%, transparent 50%);
        pointer-events: none;
    }
    
    .chat-content {
        position: relative;
        z-index: 1;
        max-width: 1000px;
        margin: 0 auto;
        padding: 32px 40px;
        height: 100vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    .chat-header {
        flex-shrink: 0;
        margin-bottom: 20px;
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #a5b4fc;
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 16px;
        transition: all 0.2s;
    }
    
    .back-link:hover {
        color: #c7d2fe;
        transform: translateX(-4px);
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 16px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 24px;
        padding: 16px 24px;
    }
    
    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 20px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
        color: white;
    }
    
    .user-name {
        font-size: 20px;
        font-weight: 700;
        color: white;
    }
    
    .user-filiere {
        font-size: 13px;
        color: #9ca3af;
        margin-top: 4px;
    }
    
    .messages-area {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        margin-bottom: 20px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.02) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 24px;
    }
    
    .messages-area::-webkit-scrollbar {
        width: 4px;
    }
    
    .messages-area::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 10px;
    }
    
    .messages-area::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
    }
    
    .message-item {
        display: flex;
        margin-bottom: 20px;
        animation: fadeInUp 0.25s ease forwards;
    }
    
    .message-item.my-message {
        justify-content: flex-end;
    }
    
    .message-item.my-message .message-bubble {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 20px 20px 6px 20px;
    }
    
    .message-item.my-message .message-text {
        color: white;
    }
    
    .message-item.other-message {
        justify-content: flex-start;
    }
    
    .message-item.other-message .message-bubble {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px 20px 20px 6px;
    }
    
    .message-item.other-message .message-text {
        color: #e8edf2;
    }
    
    .message-bubble {
        max-width: 70%;
        padding: 12px 18px;
    }
    
    .message-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 6px;
    }
    
    .message-author {
        font-size: 11px;
        font-weight: 600;
        color: #a5b4fc;
    }
    
    .message-time {
        font-size: 10px;
        color: #6b7280;
    }
    
    .my-message .message-time {
        color: rgba(255, 255, 255, 0.5);
    }
    
    .message-text {
        font-size: 13px;
        line-height: 1.5;
        word-wrap: break-word;
    }
    
    .message-attachments {
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
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.2s;
    }
    
    .attach-image:hover {
        transform: scale(1.02);
        border-color: rgba(99, 102, 241, 0.5);
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
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        font-size: 11px;
        color: #a5b4fc;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .attach-file:hover {
        background: rgba(99, 102, 241, 0.2);
        color: white;
    }
    
    .reply-form {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 24px;
        padding: 20px;
        flex-shrink: 0;
    }
    
    .reply-input {
        width: 100%;
        background: rgba(10, 12, 16, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 18px;
        padding: 12px 16px;
        color: #e8edf2;
        font-size: 13px;
        resize: none;
        font-family: 'Inter', sans-serif;
    }
    
    .reply-input:focus {
        outline: none;
        border-color: #6366f1;
    }
    
    .form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 12px;
    }
    
    .attach-btn {
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
    }
    
    .attach-btn:hover {
        background: rgba(99, 102, 241, 0.15);
        color: #a5b4fc;
    }
    
    .send-btn {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 8px 24px;
        border-radius: 100px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        transition: all 0.3s;
    }
    
    .send-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
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
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .flash-message {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(34, 197, 94, 0.05));
        border: 1px solid rgba(34, 197, 94, 0.25);
        border-radius: 16px;
        padding: 12px 16px;
        margin-bottom: 16px;
        color: #4ade80;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .error-message {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
        border: 1px solid rgba(239, 68, 68, 0.25);
        border-radius: 16px;
        padding: 12px 16px;
        margin-bottom: 16px;
    }
    
    .empty-messages {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        text-align: center;
        color: #6b7280;
    }
    
    .image-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1000;
        background: rgba(0, 0, 0, 0.95);
        align-items: center;
        justify-content: center;
        padding: 24px;
    }
    
    .image-modal.open {
        display: flex;
    }
    
    .modal-content {
        position: relative;
        max-width: 85vw;
        max-height: 85vh;
    }
    
    .modal-content img {
        width: 100%;
        height: auto;
        border-radius: 20px;
    }
    
    .modal-close {
        position: absolute;
        top: -40px;
        right: 0;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
        padding: 6px 16px;
        border-radius: 100px;
        cursor: pointer;
        font-size: 12px;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .hidden {
        display: none;
    }
    
    @media (max-width: 768px) {
        .chat-content {
            padding: 16px 20px;
        }
        .message-bubble {
            max-width: 85%;
        }
        .user-avatar {
            width: 48px;
            height: 48px;
            font-size: 18px;
        }
        .user-name {
            font-size: 16px;
        }
    }
</style>

<div class="chat-container">
    <div class="chat-bg"></div>
    
    <div class="chat-content">
        
        {{-- Header --}}
        <div class="chat-header">
            <a href="{{ route('student.messages.index') }}" class="back-link">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour aux messages
            </a>
            
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr($user->full_name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="user-name">{{ $user->full_name }}</h2>
                    <p class="user-filiere">{{ optional($user->etudiant)->filiere ?? 'Étudiant' }}</p>
                </div>
            </div>
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

        @if($errors->any())
            <div class="error-message">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Messages Area --}}
        <div class="messages-area" id="messagesArea">
            @forelse($messages as $message)
                @php
                    $isMyMessage = ($message->sender_id === auth()->id());
                @endphp
                <div class="message-item {{ $isMyMessage ? 'my-message' : 'other-message' }}">
                    <div class="message-bubble">
                        <div class="message-header">
                            @if(!$isMyMessage)
                                <span class="message-author">{{ $message->sender?->full_name ?? 'Utilisateur' }}</span>
                            @endif
                            <span class="message-time">{{ $message->created_at->format('H:i, d/m/Y') }}</span>
                        </div>
                        <div class="message-text">{{ $message->body }}</div>
                        
                        @if(!empty($message->attachments))
                            <div class="message-attachments">
                                @foreach(json_decode($message->attachments, true) ?? [] as $attachment)
                                    @if($attachment['type'] === 'image')
                                        <div class="attach-image" onclick="openImageModal('{{ asset('storage/' . $attachment['path']) }}')">
                                            <img src="{{ asset('storage/' . $attachment['path']) }}" alt="{{ $attachment['name'] }}">
                                        </div>
                                    @else
                                        <a href="{{ asset('storage/' . $attachment['path']) }}" target="_blank" class="attach-file">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            {{ $attachment['name'] }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-messages">
                    <div>
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <p class="text-gray-400">Aucun message encore</p>
                        <p class="text-xs text-gray-500 mt-1">Envoyez le premier message !</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Reply Form --}}
        <div class="reply-form">
            <form action="{{ route('student.messages.store') }}" method="POST" enctype="multipart/form-data" id="messageForm">
                @csrf
                
                <!-- Champ caché pour l'ID du destinataire -->
                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                
                <textarea name="body" rows="2" class="reply-input" placeholder="Écrivez votre message..." required>{{ old('body') }}</textarea>
                
                <div class="form-footer">
                    <label class="attach-btn" onclick="document.getElementById('fileInput').click()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        Joindre
                    </label>
                    <input type="file" name="attachments[]" id="fileInput" multiple class="hidden" accept="image/*,video/*,application/pdf" onchange="updateFileList(this)">
                    <button type="submit" class="send-btn">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Envoyer
                    </button>
                </div>
                <div id="fileList" class="file-list"></div>
            </form>
        </div>
    </div>
</div>

{{-- Image Modal --}}
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="">
        <button class="modal-close" onclick="closeImageModal()">✕ Fermer</button>
    </div>
</div>

<script>
    const messagesArea = document.getElementById('messagesArea');
    if (messagesArea) {
        messagesArea.scrollTop = messagesArea.scrollHeight;
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
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    
    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.remove('open');
        document.getElementById('modalImage').src = '';
        document.body.style.overflow = 'auto';
    }
    
    const messageForm = document.getElementById('messageForm');
    if (messageForm) {
        messageForm.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
                e.preventDefault();
                this.submit();
            }
        });
    }
</script>
@endsection