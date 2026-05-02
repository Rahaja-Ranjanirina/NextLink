<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'users';

    protected $fillable = [
        'name',
        'prenom',
        'email',
        'password',
        'phone',
        'role',
        'age',
        'photo',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('role', function ($builder) {
            $builder->where('role', 'superadmin');
        });
    }
}
