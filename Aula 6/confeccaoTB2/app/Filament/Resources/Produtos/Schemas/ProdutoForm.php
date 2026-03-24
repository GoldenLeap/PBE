<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProdutoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label("Nome do produto")
                    ->required(),
                TextInput::make('referencia'),
                TextInput::make('preco_venda')
                    ->label("Preço de venda")
                    ->prefix("R$")
                    ->numeric(),
                TextInput::make('estoque')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
