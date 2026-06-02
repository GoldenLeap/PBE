<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemPedido extends Model
{
    protected $guarded = [];
    protected $casts = [
        'preco_unitario' => 'decimal:2',
        'quantidade' => 'integer',
    ];
    //
    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    protected static function booted()
    {
        static::saved(function (self $item) {
            if ($item->pedido) {
                $item->pedido->recalculateTotal();
            }
        });

        static::deleted(function (self $item) {
            if ($item->pedido) {
                $item->pedido->recalculateTotal();
            }
        });
    }

}
