<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPrivateMessage extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'body',
        'attachments',
    ];

    protected $casts = [
        'attachments' => 'array',
    ];

    public function sender()
    {
        return $this->belongsTo(Student::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Student::class, 'receiver_id');
    }
}
