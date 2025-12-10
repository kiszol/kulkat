<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KapcsolatiUzenet extends Model
{
    protected $fillable = ['nev', 'email', 'targy', 'uzenet', 'elolvasva'];

    protected $casts = [
        'elolvasva' => 'boolean',
    ];
}
