@extends('app')

@section('content')
<style>
    /* ========================================
       FORUM SHOW - PREMIUM MESSENGER STYLE
       Messages others: LEFT | My messages: RIGHT
       Modern Icons & Professional Design
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
    
    .forum-show-container {
        height: 100vh;
        width: 100vw;
        position: relative;
        font-family: 'Inter', sans-serif;
        overflow: hidden;
    }
    
    .forum-show-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        background: linear-gradient(145deg, #070b17 0%, #0f1322 50%, #0a0e1a 100%);
    }
    
    .forum-show-bg::before {
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
    
    .forum-show-content {
        position: relative;
        z-index: 1;
        height: 100vh;
        max-width: 1000px;
        margin: 0 auto;
        padding: 16px 28px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    /* ========== NAVIGATION ========== */
    .top-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        flex-shrink: 0;
        margin-bottom: 14px;
    }
    
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #6b7280;
    }
    
    .breadcrumb a {
        color: #a5b4fc;
        text-decoration: none;
        transition: color 0.2s;
        font-weight: 500;
    }
    
    .breadcrumb a:hover {
        color: #c7d2fe;
    }
    
    .breadcrumb svg {
        width: 12px;
        height: 12px;
        opacity: 0.5;
    }
    
    .btn-back {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 100px;
        padding: 7px 18px;
        color: #d1d5db;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-back svg {
        width: 14px;
        height: 14px;
    }
    
    .btn-back:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateX(-2px);
    }
    
    /* ========== TOPIC INFO ========== */
    .topic-info {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 14px 20px;
        flex-shrink: 0;
        margin-bottom: 14px;
    }
    
    .topic-badge {
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.25);
        border-radius: 100px;
        padding: 3px 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #a5b4fc;
        margin-bottom: 10px;
    }
    
    .topic-badge svg {
        width: 12px;
        height: 12px;
    }
    
    .topic-title {
        font-size: 19px;
        font-weight: 700;
        color: white;
        margin-bottom: 10px;
        line-height: 1.35;
    }
    
    .topic-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        font-size: 11px;
        color: #6b7280;
        padding-top: 10px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .topic-author {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .topic-author-avatar {
        width: 26px;
        height: 26px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        color: white;
    }
    
    .topic-author-name {
        color: #a5b4fc;
        font-weight: 500;
        font-size: 12px;
    }
    
    .topic-meta svg {
        width: 12px;
        height: 12px;
        opacity: 0.6;
    }
    
    /* ========== MESSAGES CONTAINER ========== */
    .messages-container {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 20px;
        padding: 18px;
        flex: 1;
        overflow-y: auto;
        min-height: 0;
        margin-bottom: 14px;
    }
    
    .messages-container::-webkit-scrollbar {
        width: 4px;
    }
    
    .messages-container::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 10px;
    }
    
    .messages-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
    }
    
    /* ========== MESSAGES ========== */
    .message-item {
        display: flex;
        margin-bottom: 18px;
        animation: fadeInUp 0.25s ease forwards;
    }
    
    /* Mes messages - À DROITE */
    .message-item.my-message {
        justify-content: flex-end;
    }
    
    .message-item.my-message .message-content {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 20px 20px 6px 20px;
        border: none;
    }
    
    .message-item.my-message .message-text {
        color: white;
    }
    
    .message-item.my-message .message-time {
        color: rgba(255, 255, 255, 0.55);
    }
    
    .message-item.my-message .message-author {
        display: none;
    }
    
    /* Messages des autres - À GAUCHE */
    .message-item.other-message {
        justify-content: flex-start;
    }
    
    .message-item.other-message .message-content {
        background: rgba(255, 255, 255, 0.06);
        border-radius: 20px 20px 20px 6px;
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    .message-item.other-message .message-text {
        color: #e8edf2;
    }
    
    .message-item.other-message .message-time {
        color: #6b7280;
    }
    
    /* Message Bubble */
    .message-content {
        max-width: 72%;
        padding: 12px 16px;
        transition: all 0.2s ease;
    }
    
    .message-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 6px;
        font-size: 10px;
    }
    
    .message-author {
        font-weight: 600;
        color: #a5b4fc;
        font-size: 11px;
    }
    
    .message-time {
        font-size: 9px;
    }
    
    .message-text {
        font-size: 13px;
        line-height: 1.5;
        word-wrap: break-word;
    }
    
    /* ========== ATTACHMENTS ========== */
    .message-attachments {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }
    
    .msg-attach-image {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        border: 1px solid rgba(255, 255, 255, 0.12);
        transition: all 0.2s ease;
    }
    
    .msg-attach-image:hover {
        transform: scale(1.03);
        border-color: rgba(99, 102, 241, 0.5);
    }
    
    .msg-attach-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .msg-attach-file {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 12px;
        font-size: 11px;
        color: #a5b4fc;
        text-decoration: none;
        transition: all 0.2s;
        font-weight: 500;
    }
    
    .msg-attach-file svg {
        width: 14px;
        height: 14px;
    }
    
    .msg-attach-file:hover {
        background: rgba(99, 102, 241, 0.2);
        color: white;
        transform: translateY(-1px);
    }
    
    /* First Message */
    .first-message {
        margin-bottom: 18px;
        padding-bottom: 18px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    /* ========== REPLY FORM ========== */
    .reply-form-container {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 14px 18px;
        flex-shrink: 0;
    }
    
    .form-title {
        font-size: 13px;
        font-weight: 600;
        color: white;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .form-title svg {
        width: 16px;
        height: 16px;
        color: #a5b4fc;
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
        transition: all 0.2s;
        font-family: 'Inter', sans-serif;
    }
    
    .reply-input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.15);
    }
    
    .reply-input::placeholder {
        color: #4b5563;
    }
    
    .form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 12px;
    }
    
    .attach-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.06);
        padding: 7px 16px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 500;
        color: #9ca3af;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .attach-label svg {
        width: 14px;
        height: 14px;
    }
    
    .attach-label:hover {
        background: rgba(99, 102, 241, 0.15);
        color: #a5b4fc;
    }
    
    .file-input-hidden {
        display: none;
    }
    
    .selected-files {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }
    
    .file-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(99, 102, 241, 0.15);
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 500;
        color: #a5b4fc;
    }
    
    .file-tag svg {
        width: 12px;
        height: 12px;
    }
    
    .btn-send {
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
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
    }
    
    .btn-send svg {
        width: 14px;
        height: 14px;
    }
    
    .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
    }
    
    /* ========== FLASH MESSAGE ========== */
    .flash-success {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.12), rgba(34, 197, 94, 0.06));
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-radius: 14px;
        padding: 10px 16px;
        margin-bottom: 12px;
        color: #4ade80;
        font-size: 12px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }
    
    .flash-success svg {
        width: 16px;
        height: 16px;
    }
    
    /* ========== EMPTY STATE ========== */
    .empty-messages {
        text-align: center;
        padding: 40px 24px;
        color: #6b7280;
        font-size: 13px;
    }
    
    .empty-messages svg {
        width: 48px;
        height: 48px;
        margin-bottom: 12px;
        opacity: 0.4;
    }
    
    /* ========== MODAL IMAGE ========== */
    .image-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1000;
        background: rgba(0, 0, 0, 0.96);
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
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }
    
    .modal-close {
        position: absolute;
        top: -45px;
        right: 0;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
        padding: 6px 16px;
        border-radius: 100px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .modal-close:hover {
        background: rgba(255, 255, 255, 0.2);
    }
    
    /* ========== ANIMATIONS ========== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
        .forum-show-content {
            padding: 12px 16px;
        }
        .topic-title {
            font-size: 16px;
        }
        .message-content {
            max-width: 85%;
        }
        .messages-container {
            padding: 14px;
        }
        .reply-form-container {
            padding: 12px 14px;
        }
        .form-footer {
            flex-direction: column;
            align-items: stretch;
        }
        .btn-send {
            justify-content: center;
        }
        .attach-label {
            justify-content: center;
        }
    }
</style>

<div class="forum-show-container">
    <div class="forum-show-bg"></div>
    
    <div class="forum-show-content">
        
        {{-- Navigation --}}
        <div class="top-nav">
            <div class="breadcrumb">
                <a href="{{ route('student.dashboard') }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('student.forum.index') }}">Forum</a>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Discussion</span>
            </div>
            <a href="{{ route('student.forum.index') }}" class="btn-back">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour
            </a>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="flash-success">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Topic Info --}}
        <div class="topic-info">
            <div class="topic-badge">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Discussion
            </div>
            <h1 class="topic-title">{{ $topic->title }}</h1>
            <div class="topic-meta">
                <div class="topic-author">
                    <div class="topic-author-avatar">
                        {{ strtoupper(substr($topic->student?->full_name ?? 'U', 0, 1)) }}
                    </div>
                    <span class="topic-author-name">{{ $topic->student?->full_name ?? 'Utilisateur' }}</span>
                </div>
                <span>•</span>
                <div>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $topic->created_at->format('d/m/Y H:i') }}
                </div>
                <span>•</span>
                <div>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    {{ $topic->messages->count() }} réponses
                </div>
            </div>
        </div>

        {{-- Messages Container --}}
        <div class="messages-container" id="messagesContainer">
            {{-- Message initial --}}
            <div class="first-message">
                @php
                    $isMyTopic = ($topic->student_id === auth()->id());
                @endphp
                <div class="message-item {{ $isMyTopic ? 'my-message' : 'other-message' }}">
                    <div class="message-content">
                        <div class="message-header">
                            @if(!$isMyTopic)
                                <span class="message-author">
                                    {{ $topic->student?->full_name ?? 'Utilisateur' }}
                                </span>
                            @endif
                            <span class="message-time">{{ $topic->created_at->format('H:i, d/m/Y') }}</span>
                        </div>
                        <div class="message-text">{{ $topic->body }}</div>
                        @if(!empty($topic->attachments))
                            <div class="message-attachments">
                                @foreach($topic->attachments as $attachment)
                                    @if($attachment['type'] === 'image')
                                        <div class="msg-attach-image" onclick="openImageModal('{{ asset('storage/' . $attachment['path']) }}')">
                                            <img src="{{ asset('storage/' . $attachment['path']) }}" alt="{{ $attachment['name'] }}">
                                        </div>
                                    @elseif($attachment['type'] === 'video')
                                        <a href="{{ asset('storage/' . $attachment['path']) }}" target="_blank" class="msg-attach-file">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $attachment['name'] }}
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $attachment['path']) }}" target="_blank" class="msg-attach-file">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            </div>

            {{-- Réponses --}}
            @forelse($topic->messages as $message)
                @php
                    $isMyMessage = ($message->student_id === auth()->id());
                @endphp
                <div class="message-item {{ $isMyMessage ? 'my-message' : 'other-message' }}">
                    <div class="message-content">
                        <div class="message-header">
                            @if(!$isMyMessage)
                                <span class="message-author">
                                    {{ $message->student?->full_name ?? 'Étudiant' }}
                                </span>
                            @endif
                            <span class="message-time">{{ $message->created_at->format('H:i, d/m/Y') }}</span>
                        </div>
                        <div class="message-text">{{ $message->body }}</div>
                        @if(!empty($message->attachments))
                            <div class="message-attachments">
                                @foreach($message->attachments as $attachment)
                                    @if($attachment['type'] === 'image')
                                        <div class="msg-attach-image" onclick="openImageModal('{{ asset('storage/' . $attachment['path']) }}')">
                                            <img src="{{ asset('storage/' . $attachment['path']) }}" alt="{{ $attachment['name'] }}">
                                        </div>
                                    @elseif($attachment['type'] === 'video')
                                        <a href="{{ asset('storage/' . $attachment['path']) }}" target="_blank" class="msg-attach-file">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $attachment['name'] }}
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $attachment['path']) }}" target="_blank" class="msg-attach-file">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p>Aucune réponse pour le moment</p>
                    <p class="text-xs mt-1">Soyez le premier à répondre !</p>
                </div>
            @endforelse
        </div>

        {{-- Reply Form --}}
        <div class="reply-form-container">
            <div class="form-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                </svg>
                Répondre à la discussion
            </div>
            <form action="{{ route('student.forum.message.store', $topic) }}" method="POST" enctype="multipart/form-data" id="replyForm">
                @csrf
                <textarea name="body" rows="2" class="reply-input" placeholder="Écrivez votre réponse..." required>{{ old('body') }}</textarea>
                
                <div class="form-footer">
                    <div>
                        <label class="attach-label" onclick="document.getElementById('fileInput').click()">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                            Joindre des fichiers
                        </label>
                        <input type="file" name="attachments[]" id="fileInput" multiple class="file-input-hidden" accept="image/*,video/*,application/pdf" onchange="updateFileList(this)">
                    </div>
                    <button type="submit" class="btn-send">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Envoyer
                    </button>
                </div>
                <div id="fileList" class="selected-files"></div>
            </form>
        </div>
    </div>
</div>

{{-- Image Modal --}}
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="">
        <button class="modal-close" onclick="closeImageModal()">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Fermer
        </button>
    </div>
</div>

<script>
    // Auto-scroll to bottom
    const messagesContainer = document.getElementById('messagesContainer');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
    function updateFileList(input) {
        const fileList = document.getElementById('fileList');
        fileList.innerHTML = '';
        if (input.files.length > 0) {
            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                const fileTag = document.createElement('span');
                fileTag.className = 'file-tag';
                fileTag.innerHTML = `
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    ${file.name.substring(0, 25)}${file.name.length > 25 ? '...' : ''}
                `;
                fileList.appendChild(fileTag);
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
</script>
@endsection