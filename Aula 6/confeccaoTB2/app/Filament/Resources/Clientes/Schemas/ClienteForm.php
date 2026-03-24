<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                    TextInput::make("nome")->required()->label('Nome completo'),
                    TextInput::make("email")->email()->label('E-mail'),
                    TextInput::make("telefone")->tel()->label('Telefone')->mask(RawJs::make(
                        <<<'JS'
                            $input.replace(/\D/g, '').length <= 10 ? '(99) 9999-9999' : '(99) 99999-9999'
                        JS
                    )),
                    TextInput::make("documento")->label('CPF ou CNPJ')->mask(RawJs::make(
                        <<<'JS'
                            $input.length > 14? '99.999.999/999-99': '999.999.999-99'
                        JS
                    )
                ),
            ]);
    }
}
