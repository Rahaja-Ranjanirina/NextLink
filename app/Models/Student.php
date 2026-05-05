<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'student';
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
        'is_moderator',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'is_moderator' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('role', function ($builder) {
            $builder->where('role', 'etudiant');
        });
    }

    public function cv()
    {
        return $this->hasOne(Cv::class, 'student_id');
    }

    public function etudiant()
    {
        return $this->hasOne(Etudiant::class, 'user_id');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'etudiant_id');
    }

    public function getFullNameAttribute(): string
    {
        return trim(
            ($this->prenom ?? '') . ' ' . ($this->name ?? '')
        );
    }
}
