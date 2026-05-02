<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentForumMessage extends Model
{
    protected $fillable = [
        'topic_id',
        'student_id',
        'body',
        'attachments',
    ];

    protected $casts = [
        'attachments' => 'array',
    ];

    public function topic()
    {
        return $this->belongsTo(StudentForumTopic::class, 'topic_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
