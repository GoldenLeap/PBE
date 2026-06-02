<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FornecedorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')->required()->label('Razão Social / Nome'),
                TextInput::make('email')->email()->label('E-mail'),
                TextInput::make('telefone')->label('Telefone Comercial')->mask('(99) 99999-9999'),
                TextInput::make('cnpj')->label('CNPJ Corporativo')->mask('99.999.999/9999-99'),
            ]);
    }
}
