<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InsumoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')->required()->label('Nome do Insumo'),
                TextInput::make('unidade_medida')->required()->label('Unidade (Ex: Kg, Metros, Cone)'),
                TextInput::make('preco_custo')->numeric()->prefix('R$')->label('Preço de Custo'),
                TextInput::make('estoque')->numeric()->default(0)->label('Estoque Disponível'),
            ]);
    }
}
