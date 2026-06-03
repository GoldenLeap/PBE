<?php

namespace App\Filament\Resources\MovimentacaoEstoques\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class MovimentacaoEstoqueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('produto_id')
                    ->relationship('produto', 'nome')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Produto'),

                Select::make('tipo')
                    ->options([
                        'entrada' => 'Entrada',
                        'saida' => 'Saída',
                    ])
                    ->required()
                    ->label('Tipo de Movimentação'),

                TextInput::make('quantidade')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->label('Quantidade')
                    ->rule(function (\Filament\Schemas\Components\Utilities\Get $get) {
                        return function (string $attribute, $value, \Closure $fail) use ($get) {
                            if ($get('tipo') === 'saida' && $get('produto_id')) {
                                $produto = \App\Models\Produto::find($get('produto_id'));
                                if ($produto && $produto->estoque < $value) {
                                    $fail("A quantidade não pode ser maior que o estoque disponível ({$produto->estoque} unidades).");
                                }
                            }
                        };
                    }),

                TextInput::make('observacao')
                    ->label('Observação')
                    ->columnSpanFull(),
            ]);
    }
}
