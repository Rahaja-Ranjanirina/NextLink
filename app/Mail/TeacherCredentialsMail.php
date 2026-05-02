<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeacherCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $enseignant;
    public string $password;

    public function __construct(User $enseignant, string $password)
    {
        $this->enseignant = $enseignant;
        $this->password = $password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vos identifiants enseignant - NextLink',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.enseignant_credentials',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
