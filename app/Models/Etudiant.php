<?php
// ============================================================
// App\Models\Etudiant
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = [
        'user_id', 'added_by', 'numero_inscription', 'filiere',
        'niveau', 'bio', 'cv', 'lettre_motivation', 'linkedin',
        'github', 'competences', 'langues', 'experiences',
        'formations', 'profile_completed',
    ];

    protected $casts = [
        'competences'      => 'array',
        'langues'          => 'array',
        'experiences'      => 'array',
        'formations'       => 'array',
        'profile_completed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'etudiant_id', 'user_id');
    }
}