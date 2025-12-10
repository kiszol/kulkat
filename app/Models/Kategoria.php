<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategoria extends Model
{
    protected $fillable = ['nev', 'leiras'];

    public function lenyek(): HasMany
    {
        return $this->hasMany(Leny::class);
    }
}
