<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                  ->label("Cargo")
                  ->required()
                  ->unique(ignoreRecord:true)
                  ->maxLength(255)
                  ->columnSpanFull(),
                
                Select::make("permissions")
                    ->label('Permissões de acesso')
                    ->multiple()
                    ->relationship('permissions', 'name')
                    ->preload()    
                    ->columnSpanFull()
                ]);
    }
}
