<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// ============================================================
// Entreprise
// ============================================================
class Entreprise extends Model
{
    protected $fillable = [
        'user_id', 'nom_entreprise', 'secteur', 'description',
        'adresse', 'site_web', 'logo',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function offres() { return $this->hasMany(Offre::class, 'user_id', 'user_id'); }
}