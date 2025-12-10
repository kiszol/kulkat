<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GaleriaKep extends Model
{
    protected $fillable = ['leny_id', 'kep_url', 'cim', 'leiras'];

    public function leny(): BelongsTo
    {
        return $this->belongsTo(Leny::class);
    }
}
