<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id', 'type', 'message',
        'notifiable_id', 'notifiable_type', 'is_read',
    ];

    protected $casts = ['is_read' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    public static function createForUser(int $userId, string $type, string $message, Model $notifiable): self
    {
        return self::create([
            'user_id'         => $userId,
            'type'            => $type,
            'message'         => $message,
            'notifiable_id'   => $notifiable->id,
            'notifiable_type' => get_class($notifiable),
        ]);
    }
}