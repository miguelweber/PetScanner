<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    protected $fillable = ['pet_id', 'sender_id', 'receiver_id', 'message', 'is_read'];

    protected $casts = ['is_read' => 'boolean'];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}