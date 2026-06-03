<?php

namespace App\Observers;

use App\Models\Pedido;
use App\Models\MovimentacaoEstoque;
use Illuminate\Validation\ValidationException;

class PedidoObserver
{
    public function creating(Pedido $pedido): void
    {
        if ($pedido->status === 'Finalizado') {
            throw ValidationException::withMessages([
                'status' => 'Um pedido não pode ser criado diretamente como Finalizado. Salve como Pendente primeiro.',
            ]);
        }
    }

    public function updating(Pedido $pedido): void
    {
        // Impedir edição se o pedido já estava Finalizado
        if ($pedido->getOriginal('status') === 'Finalizado') {
            throw ValidationException::withMessages([
                'status' => 'Um pedido já finalizado não pode ser alterado.',
            ]);
        }

        // Verificar estoque ANTES de finalizar
        if ($pedido->isDirty('status') && $pedido->status === 'Finalizado') {
            foreach ($pedido->itens as $item) {
                $produto = $item->produto;
                if (!$produto || $produto->estoque < $item->quantidade) {
                    throw ValidationException::withMessages([
                        'status' => "Estoque insuficiente para o produto '{$produto?->nome}'. Necessário: {$item->quantidade}, Disponível: {$produto?->estoque}.",
                    ]);
                }
            }
        }
    }

    public function deleting(Pedido $pedido): void
    {
        if ($pedido->status === 'Finalizado') {
            throw ValidationException::withMessages([
                'status' => 'Um pedido finalizado não pode ser excluído.',
            ]);
        }
    }

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
