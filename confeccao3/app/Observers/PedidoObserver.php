<?php

namespace App\Observers;

use App\Models\Pedido;
use App\Models\MovimentacaoEstoque;

class PedidoObserver
{
    /**
     * Quando o pedido é atualizado, verifica se o status mudou para "Finalizado".
     * Se sim, cria movimentações de saída para cada item do pedido,
     * debitando automaticamente o estoque dos produtos.
     */
    public function updated(Pedido $pedido): void
    {
        // Verifica se o status mudou para "Finalizado"
        if ($pedido->isDirty('status') && $pedido->status === 'Finalizado') {
            foreach ($pedido->itens as $item) {
                // Cria uma movimentação de saída para cada item do pedido
                MovimentacaoEstoque::create([
                    'produto_id'  => $item->produto_id,
                    'tipo'        => 'saida',
                    'quantidade'  => $item->quantidade,
                    'observacao'  => "Saída automática — Pedido #{$pedido->id} finalizado.",
                ]);
            }
        }
    }
}
