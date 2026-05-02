<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = [
        'user_id', 'publisher_type', 'titre', 'description',
        'lien_externe', 'type_offre', 'localisation', 'date_limite', 'is_active',
    ];

    protected $casts = [
        'date_limite' => 'date',
        'is_active'   => 'boolean',
    ];

    public function publisher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medias()
    {
        return $this->hasMany(OffreMedia::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    public function candidaturesNonLues()
    {
        return $this->hasMany(Candidature::class)->where('is_read', false);
    }

    public function getNbCandidaturesAttribute(): int
    {
        return $this->candidatures()->count();
    }
}