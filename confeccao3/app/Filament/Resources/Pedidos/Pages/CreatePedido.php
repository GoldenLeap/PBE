<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use Filament\Resources\Pages\CreateRecord;
use App\Mail\PedidoCriadoMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CreatePedido extends CreateRecord
{
    protected static string $resource = PedidoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }

    protected function afterCreate() : void{
        $pedido = $this->record;

        $total = $pedido->itens->sum(fn ($item) => $item->quantidade * $item->preco_unitario);
        $pedido->update(['valor_total' => $total]);

        Log::info('Auditoria: Novo pedido criado', [
            'pedido_id' => $pedido->id,
            'valor_total' => $total,
            'operador' => auth()->user()->email ?? 'Sistema'
        ]);

        if($pedido->cliente && $pedido->cliente->email){
            Mail::to($pedido->cliente->email)->send(new PedidoCriadoMail($pedido));
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
