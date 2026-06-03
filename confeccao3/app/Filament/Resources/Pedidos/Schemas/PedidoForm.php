<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use App\Models\Produto;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Get;
use Filament\Forms\Set;

class PedidoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('cliente_id')
                    ->relationship('cliente', 'nome')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->disabled(fn ($record) => $record && $record->status === 'Finalizado')
                    ->label('Cliente'),
                TextInput::make('user_id')
                    ->hidden()
                    ->default(auth()->id()),
                Select::make('status')
                    ->options(['Pendente' => 'Pendente', 'Em Produção' => 'Em produção', 'Finalizado' => 'Finalizado'])
                    ->default('Pendente')
                    ->required()
                    ->disabled(fn ($record) => $record && $record->status === 'Finalizado')
                    ->label('Status'),
                Repeater::make('itens')
                    ->relationship('itens')
                    ->label('Itens do pedido')
                    ->disabled(fn ($record) => $record && $record->status === 'Finalizado')
                    ->live()
                    ->afterStateUpdated(function ($get, $set) {
                        self::updateTotal($get, $set);
                    })
                    ->schema([
                        Select::make('produto_id')
                            ->relationship('produto', 'nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                $set('preco_unitario', Produto::find($state)?->preco_venda ?? 0);
                                self::updateTotalItem($get, $set);
                            }),
                        TextInput::make('quantidade')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($get, $set) {
                                self::updateTotalItem($get, $set);
                            }),
                        TextInput::make('preco_unitario')
                            ->numeric()
                            ->required()
                            ->step(0.01)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($get, $set) {
                                self::updateTotalItem($get, $set);
                            }),
                    ])
                    ->columns(3)
                    ->createItemButtonLabel('Adicionar item'),
                TextInput::make('valor_total')
                    ->numeric()
                    ->label('Valor Total')
                    ->readOnly(),
            ]);
    }

    public static function updateTotal($get, $set): void
    {
        $itens = $get('itens') ?? [];
        $total = 0;
        foreach ($itens as $item) {
            $total += (float) ($item['quantidade'] ?? 0) * (float) ($item['preco_unitario'] ?? 0);
        }
        $set('valor_total', $total);
    }

    public static function updateTotalItem($get, $set): void
    {
        $itens = $get('../../itens') ?? [];
        $total = 0;
        foreach ($itens as $item) {
            $total += (float) ($item['quantidade'] ?? 0) * (float) ($item['preco_unitario'] ?? 0);
        }
        $set('../../valor_total', $total);
    }
}
