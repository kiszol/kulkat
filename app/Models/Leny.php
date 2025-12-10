<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leny extends Model
{
    protected $fillable = [
        'nev', 
        'leiras', 
        'eredet', 
        'ritka_sag_szint', 
        'aktiv', 
        'kategoria_id', 
        'user_id'
    ];

    protected $casts = [
        'aktiv' => 'boolean',
        'ritka_sag_szint' => 'integer',
    ];

    public function kategoria(): BelongsTo
    {
        return $this->belongsTo(Kategoria::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kepessegek(): BelongsToMany
    {
        return $this->belongsToMany(Kepesseg::class, 'leny_kepesseg')
                    ->withPivot('szint')
                    ->withTimestamps();
    }

    public function galeriaKepek(): HasMany
    {
        return $this->hasMany(GaleriaKep::class);
    }
}
