<?php

namespace App\Filament\Resources\Permissions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PermissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                  ->label("Nome da Permissão")
                  ->required()
                  ->unique(ignoreRecord:true)
                  ->maxLength(255)
                  ->columnSpanFull(),
                
                TextInput::make("guard_name")
                    ->label('Nivel de permissão')
                    ->required()
                    ->maxLength(100)    
                    ->columnSpanFull()
                ]);
    }
}
