<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentForumTopic extends Model
{
    protected $fillable = [
        'student_id',
        'title',
        'body',
        'slug',
        'attachments',
    ];

    protected $casts = [
        'attachments' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function messages()
    {
        return $this->hasMany(StudentForumMessage::class, 'topic_id');
    }
}
