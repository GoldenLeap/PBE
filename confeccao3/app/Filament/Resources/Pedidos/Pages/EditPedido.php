<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoAtualizadoMail;

class EditPedido extends EditRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $pedido = $this->record;
        $total = $pedido->itens->sum(fn ($item) => $item->quantidade * $item->preco_unitario);

        $pedido->updateQuietly(['valor_total' => $total]);
        Log::info('Auditoria: Pedido Editado e Atualizado', [
            'pedido_id' => $pedido->id,
            'novo_valor_total' => $total,
            'operador' => auth()->user()->email ?? 'Operador'
        ]);

        if ($pedido->cliente && $pedido->cliente->email) {
            Mail::to($pedido->cliente->email)->send(new PedidoAtualizadoMail($pedido));
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSaveFormAction(): \Filament\Actions\Action
    {
        return parent::getSaveFormAction()
            ->disabled(fn () => $this->record->status === 'Finalizado');
    }
}
