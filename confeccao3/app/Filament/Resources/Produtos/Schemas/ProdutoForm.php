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
                TextInput::make('nome')->required()->label('Nome Comercial do Produto'),
                TextInput::make('referencia')->label('Código de Referência (SKU)'),
                TextInput::make('preco_venda')->numeric()->prefix('R$')->label('Preço de Venda'),
                TextInput::make('estoque')->numeric()->default(0)->integer()->disabled()->label('Estoque Atual (Alterado via Movimentação)'),
            ]);
    }
}
