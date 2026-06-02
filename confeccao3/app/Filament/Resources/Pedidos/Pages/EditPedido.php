<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditPedido extends EditRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave() : void{
        $pedido = $this->record;
        $total = $pedido->itens->sum(fn ($item) => $item->quantidade * $item->preco_unitario);

        $pedido->update(['valor_total' => $total]);
        Log::info('Auditoria: Pedido Editado e Atualizado', [
            'pedido_id' => $pedido->id,
            'novo_valor_total' => $total,
            'operador' => auth()->user()->email ?? 'Operador'

        ]);
    }
}
