<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'prenom', 'email', 'password',
        'role', 'age', 'phone', 'photo', 'is_active',
        'is_moderator',  // <-- AJOUTEZ CETTE LIGNE
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'is_moderator' => 'boolean',  // <-- AJOUTEZ AUSSI CETTE LIGNE
        ];
    }

    // Helpers de rôle
    public function isSuperAdmin(): bool  { return $this->role === 'superadmin'; }
    public function isEnseignant(): bool  { return $this->role === 'enseignant'; }
    public function isEtudiant(): bool    { return $this->role === 'etudiant'; }
    public function isEntreprise(): bool  { return $this->role === 'entreprise'; }

    // Relations
    public function etudiant()
    {
        return $this->hasOne(Etudiant::class);
    }

    public function entreprise()
    {
        return $this->hasOne(Entreprise::class);
    }

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'etudiant_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function etudiantsAjoutes()
    {
        return $this->hasMany(Etudiant::class, 'added_by');
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->prenom . ' ' . $this->name);
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('images/default-avatar.png');
    }
}