<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEtudiantMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $etudiant,
        public string $plainPassword,
        public User $enseignant,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address(
                $this->enseignant->email,
                $this->enseignant->full_name
            ),
            subject: 'Bienvenue sur Nextlink - Vos identifiants de connexion',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome-etudiant',
        );
    }
}