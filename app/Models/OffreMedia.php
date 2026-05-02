<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// ============================================================
// OffreMedia
// ============================================================
class OffreMedia extends Model
{
    protected $table = 'offre_medias';

    protected $fillable = ['offre_id', 'path', 'type'];

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
}