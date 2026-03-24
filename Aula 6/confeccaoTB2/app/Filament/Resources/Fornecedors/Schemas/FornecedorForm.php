<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class FornecedorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome do Fornecedor')
                    ->required(),
                TextInput::make('cnpj')
                    ->label('CNPJ')
                    ->mask('99.999.999/999-99')
                    ->required(),
                TextInput::make("telefone")
                    ->tel()
                    ->label('Telefone')
                    ->mask(RawJs::make(
                        <<<'JS'
                            $input.replace(/\D/g, '').length <= 10 ? '(99) 9999-9999' : '(99) 99999-9999'
                        JS
                    )),
            ]);
    }
}
