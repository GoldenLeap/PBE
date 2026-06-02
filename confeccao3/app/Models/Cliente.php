<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $guarded = [];
    protected $fillable = ['nome', 'documento', 'email', 'telefone'];
    //

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }
}
