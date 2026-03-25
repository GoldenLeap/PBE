<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
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
                    ->label("Selecione o Cliente"),

                Select::make('status')
                    ->options(
                        [
                            'Pendente' => 'Pendente',
                            'Em Produção' => 'Em Produção',
                            'Finalizado' => 'Finalizado'
                        ]
                    )->default("Pendente")
                    ->required(),
                TextInput::make("valor_total")
                    ->numeric()
                    ->readOnly()
                    ->label('Valor Total')
                    ->prefix("R$"),
  
                Repeater::make('itens')
                    ->relationship('itens')
                    ->schema(
                        [
                            Select::make('produto_id')
                                ->relationship('produto', 'nome')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->label('Produto')
                                ->columnSpan(2),

                            TextInput::make('quantidade')
                                ->numeric()
                                ->default(1)
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn(Get $get, Set $set) => self::CalcularTotal($get, $set))
                            ,
                            TextInput::make("preco_unitario")
                                ->numeric()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn(Get $get, Set $set) => self::CalcularTotal($get, $set))
                                ->prefix("R$"),
                        ]
                )
                ->columnSpan(4)
                ->columnSpanFull()
                ->afterStateUpdated(fn(Get $get, Set $set) => self::CalcularTotal($get, $set))
                ->label('Produtos do Pedido'),  
            ]
        );
    }

    public static function CalcularTotal(Get $get, Set $set): void{
        $itens = $get('../../itens') ?? [];
        $total = 0;
        foreach ($itens as $item) {
            $quantidade = (float) ($item['quantidade'] ?? 0);
            $preco = (float) ($item['preco_unitario'] ?? 0);
            $total += $quantidade * $preco;
        }
        $set('../../valor_total', number_format($total, 2, '.', ''));
        }
}
