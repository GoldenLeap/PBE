<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nome do Cargo (Ex: Gerente Comercial)')->required()->unique(ignoreRecord: true),
                Select::make('permissions')
                    ->label('Permissões Atribuídas ao Cargo')
                    ->multiple()
                    ->relationship('permissions', 'name')
                    ->preload()
                    ->columnSpanFull(),
                //
            ]);
    }
}
