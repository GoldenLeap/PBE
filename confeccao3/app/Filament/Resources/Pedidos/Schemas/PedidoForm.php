<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use App\Models\Produto;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

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
                    ->label('Cliente'),
                TextInput::make('user_id')
                    ->hidden()
                    ->default(auth()->id()),
                Select::make('status')
                    ->options(['Pendente' => 'Pendente', 'Em Produção' => 'Em produção', 'Finalizado' => 'Finalizado'])
                    ->default('Pendente')
                    ->required()
                    ->label('Status'),
                Repeater::make('itens')
                    ->relationship('itens')
                    ->label('Itens do pedido')
                    ->schema([
                        Select::make('produto_id')
                            ->relationship('produto', 'nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('preco_unitario', Produto::find($state)?->preco_venda ?? 0);
                            }),
                        TextInput::make('quantidade')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->reactive(),
                        TextInput::make('preco_unitario')
                            ->numeric()
                            ->required()
                            ->step(0.01),
                    ])
                    ->columns(3)
                    ->createItemButtonLabel('Adicionar item'),
                TextInput::make('valor_total')
                    ->numeric()
                    ->label('Valor Total')
                    ->readOnly(),
            ]);
    }
}
