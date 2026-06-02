<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $guarded = [];
    //

    public function movimentacoes(){
        return $this->hasMany(MovimentacaoEstoque::class);
    }
}

