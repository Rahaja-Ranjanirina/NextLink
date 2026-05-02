<?php

namespace App\Models;

use App\Models\Notification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'partner';
    protected $table = 'users';

    protected $fillable = [
        'name',
        'prenom',
        'email',
        'password',
        'role',
        'age',
        'phone',
        'photo',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('role', function ($builder) {
            $builder->where('role', 'entreprise');
        });
    }

    public function entreprises()
    {
        return $this->hasMany(Entreprise::class, 'user_id', 'id');
    }

    public function offres()
    {
        return $this->hasMany(Offre::class, 'user_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }
}
