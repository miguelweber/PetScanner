<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetPhoto extends Model
{
    protected $fillable = ['pet_id', 'path', 'order'];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
}