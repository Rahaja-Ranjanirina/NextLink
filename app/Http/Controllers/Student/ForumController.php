<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentForumMessage;
use App\Models\StudentForumTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    public function index()
    {
        $topics = StudentForumTopic::with('student')->latest()->paginate(12);

        return view('student.forum.index', compact('topics'));
    }

    public function create()
    {
        return view('student.forum.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string|max:4000',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,gif,webp,svg,mp4,mov,avi,mkv,pdf|max:102400',
        ]);

        $topic = StudentForumTopic::create([
            'student_id' => Auth::id(),
            'title'      => $validated['title'],
            'body'       => $validated['body'],
            'slug'       => Str::slug($validated['title']) . '-' . Str::random(6),
            'attachments' => $this->buildAttachments($request),
        ]);

        return redirect()
            ->route('student.forum.show', $topic)
            ->with('success', 'Sujet créé avec succès.');
    }

    public function show(StudentForumTopic $topic)
    {
        $topic->load(['student', 'messages.student']);

        return view('student.forum.show', compact('topic'));
    }

    public function storeMessage(Request $request, StudentForumTopic $topic)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:4000',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,gif,webp,svg,mp4,mov,avi,mkv,pdf|max:102400',
        ]);

        StudentForumMessage::create([
            'topic_id'   => $topic->id,
            'student_id' => Auth::id(),
            'body'       => $validated['body'],
            'attachments' => $this->buildAttachments($request),
        ]);

        return back()->with('success', 'Votre réponse a bien été ajoutée.');
    }

    private function buildAttachments(Request $request): ?array
    {
        $attachments = [];

        if (! $request->hasFile('attachments')) {
            return null;
        }

        foreach ($request->file('attachments') as $file) {
            $path = $file->store('forum/attachments', 'public');
            $mime = $file->getClientMimeType();

            $attachments[] = [
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime' => $mime,
                'type' => str_starts_with($mime, 'image/') ? 'image' : (str_starts_with($mime, 'video/') ? 'video' : 'document'),
                'url' => asset('storage/' . $path),
            ];
        }

        return $attachments ?: null;
    }
}
