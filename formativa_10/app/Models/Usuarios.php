<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    //
     protected $fillable = ['nome_usuario', 'genero', "tipo_sanguineo", "idade" ];
}
