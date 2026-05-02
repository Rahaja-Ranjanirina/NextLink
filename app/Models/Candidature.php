<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'offre_id', 'etudiant_id', 'message',
        'cv', 'lettre_motivation', 'statut', 'is_read',
        'interview_date', 'interview_time', 'interview_location', 'interview_zoom_link', 'partner_message',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'interview_date' => 'date',
    ];

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    public function etudiant()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }

    public function getCvUrlAttribute(): ?string
    {
        return $this->cv ? asset('storage/' . $this->cv) : null;
    }

    public function getLmUrlAttribute(): ?string
    {
        return $this->lettre_motivation ? asset('storage/' . $this->lettre_motivation) : null;
    }
}