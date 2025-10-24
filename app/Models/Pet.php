<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Pet extends Model
{
    protected $fillable = [
        'name',
        'species',
        'breed',
        'description',
        'photo',
        'city',
        'state',
        'contact_email',
        'contact_phone',
        'phone_accepts_calls',
        'phone_accepts_whatsapp',
        'user_id',
        'is_active'
    ];

    protected $casts = [
        'phone_accepts_calls' => 'boolean',
        'phone_accepts_whatsapp' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeByCity(Builder $query, string $city): Builder
    {
        return $query->where('city', 'like', '%' . $city . '%');
    }

    public function scopeBySpecies(Builder $query, string $species): Builder
    {
        return $query->where('species', $species);
    }

    public function getWhatsappUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->contact_phone);
        return "https://wa.me/55{$phone}";
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PetPhoto::class)->orderBy('order');
    }
}
