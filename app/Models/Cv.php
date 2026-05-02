<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'student_id',
        'photo',
        'centre_interet',
        'experience',
        'formation',
        'competence',
        'certification',
    ];

   public function student()
{
    return $this->belongsTo(\App\Models\Student::class);
}
}