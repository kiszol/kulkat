<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kepesseg extends Model
{
    protected $fillable = ['nev', 'leiras', 'tipus'];

    public function lenyek(): BelongsToMany
    {
        return $this->belongsToMany(Leny::class, 'leny_kepesseg')
                    ->withPivot('szint')
                    ->withTimestamps();
    }
}
