<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PrivateMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrivateMessageController extends Controller
{
    /**
     * Afficher la liste des utilisateurs pour démarrer une conversation (côté étudiant)
     */
    public function index()
    {
        // Récupérer tous les étudiants (sauf l'utilisateur connecté)
        $students = User::where('role', 'etudiant')
            ->where('id', '!=', Auth::id())
            ->with('etudiant')
            ->orderBy('prenom')
            ->paginate(20);
        
        // Récupérer tous les enseignants
        $enseignants = User::where('role', 'enseignant')
            ->orderBy('prenom')
            ->get();
        
        // Récupérer toutes les entreprises
        $entreprises = User::where('role', 'entreprise')
            ->orderBy('name')
            ->get();
        
        return view('student.messages.index', compact('students', 'enseignants', 'entreprises'));
    }

    /**
     * Afficher la conversation avec un utilisateur spécifique (côté étudiant)
     */
    public function chat(User $user)
    {
        // Vérifier que l'utilisateur connecté est un étudiant
        if (Auth::user()->role !== 'etudiant') {
            abort(403, 'Accès non autorisé.');
        }
        
        // Vérifier que l'utilisateur existe
        if (!$user || !$user->id) {
            abort(404, 'Utilisateur non trouvé');
        }
        
        // Récupérer les messages entre l'utilisateur connecté et l'utilisateur cible
        $messages = PrivateMessage::where(function($query) use ($user) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', Auth::id());
        })->with('sender')
          ->orderBy('created_at', 'asc')
          ->get();
        
        return view('student.messages.chat', compact('user', 'messages'));
    }

    /**
     * Envoyer un message (côté étudiant)
     */
    public function store(Request $request)
    {
        // Vérifier que l'utilisateur connecté est un étudiant
        if (Auth::user()->role !== 'etudiant') {
            return back()->withErrors(['error' => 'Accès non autorisé.']);
        }
        
        // Validation
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string|max:5000',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,pdf,doc,docx|max:10240',
        ]);
        
        // Vérifier qu'on n'envoie pas à soi-même
        if ($request->receiver_id == Auth::id()) {
            return back()->withErrors(['error' => 'Vous ne pouvez pas vous envoyer un message à vous-même.']);
        }
        
        $attachments = [];
        
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $mime = $file->getMimeType();
                $type = 'file';
                
                if (str_starts_with($mime, 'image/')) {
                    $type = 'image';
                } elseif (str_starts_with($mime, 'video/')) {
                    $type = 'video';
                }
                
                $path = $file->store('messages/' . date('Y/m/d'), 'public');
                
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'type' => $type,
                    'size' => $file->getSize(),
                ];
            }
        }
        
        $message = PrivateMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'body' => $request->body,
            'attachments' => !empty($attachments) ? json_encode($attachments) : null,
            'is_read' => false,
        ]);
        
        return back()->with('success', 'Message envoyé avec succès !');
    }

    /**
     * Marquer un message comme lu
     */
    public function markAsRead(PrivateMessage $message)
    {
        if ($message->receiver_id === Auth::id()) {
            $message->update(['is_read' => true]);
        }
        
        return back();
    }

    /**
     * Récupérer les messages non lus (API)
     */
    public function unreadCount()
    {
        $count = PrivateMessage::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();
        
        return response()->json(['count' => $count]);
    }

    // ==================== MÉTHODES POUR L'ESPACE ENSEIGNANT ====================
    
    /**
     * Afficher la conversation avec un utilisateur spécifique (côté enseignant)
     */
    public function enseignantChat(User $user)
    {
        if (Auth::user()->role !== 'enseignant') {
            abort(403, 'Accès non autorisé.');
        }
        
        $messages = PrivateMessage::where(function($query) use ($user) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', Auth::id());
        })->with('sender')
          ->orderBy('created_at', 'asc')
          ->get();
        
        return view('enseignant.messages.chat', compact('user', 'messages'));
    }

    /**
     * Envoyer un message (côté enseignant)
     */
    public function enseignantStore(Request $request)
    {
        if (Auth::user()->role !== 'enseignant') {
            return back()->withErrors(['error' => 'Accès non autorisé.']);
        }
        
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string|max:5000',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,pdf,doc,docx|max:10240',
        ]);
        
        $attachments = [];
        
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $mime = $file->getMimeType();
                $type = 'file';
                
                if (str_starts_with($mime, 'image/')) {
                    $type = 'image';
                } elseif (str_starts_with($mime, 'video/')) {
                    $type = 'video';
                }
                
                $path = $file->store('messages/' . date('Y/m/d'), 'public');
                
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'type' => $type,
                    'size' => $file->getSize(),
                ];
            }
        }
        
        PrivateMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'body' => $request->body,
            'attachments' => !empty($attachments) ? json_encode($attachments) : null,
            'is_read' => false,
        ]);
        
        return back()->with('success', 'Message envoyé avec succès !');
    }
}