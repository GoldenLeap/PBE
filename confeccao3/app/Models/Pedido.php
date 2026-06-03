<?php

namespace App\Models;

use App\Observers\PedidoObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

#[ObservedBy(PedidoObserver::class)]
class Pedido extends Model
{
    protected $guarded = [];
    protected $casts = [
        'valor_total' => 'decimal:2',
    ];
    //
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function itens(){
        return $this->hasMany(ItemPedido::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function recalculateTotal(): void
    {
        $total = $this->itens()->select(DB::raw('SUM(quantidade * preco_unitario) as total'))->value('total') ?? 0;
        $this->valor_total = $total;
        $this->saveQuietly();
    }
}
