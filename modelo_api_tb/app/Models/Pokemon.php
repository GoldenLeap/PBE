<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    protected $fillable = [
        'nome',
        'tipo',
        'ataque',
        'altura',
        'peso',
        'moves',
        'foto',
    ];

    protected $casts = [
        'moves' => 'array',
    ];
}
