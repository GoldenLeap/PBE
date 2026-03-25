<?php

namespace App\Filament\Resources\Estoques\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
class EstoqueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('produto_id')
                    ->relationship('produto', 'nome')
                    ->options([
                        "Fora de estoque" => "Fora de estoque",
                        "Em estoque" => "Em estoque",
                        "Baixo estoque" => 'Baixo estoque'
                    ])
                    ->label('Produto')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('Fora do estoque'),
                TextInput::make('quantidade')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
