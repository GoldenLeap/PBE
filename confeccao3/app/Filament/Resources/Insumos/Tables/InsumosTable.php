<?php

namespace App\Filament\Resources\Insumos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InsumosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->searchable()->sortable(),
                TextColumn::make('unidade_medida')
                    ->searchable()->label('Unid. Medida'),
                TextColumn::make('preco_custo')
                    ->numeric()
                    ->sortable()->label('Preço de Custo'),
                TextColumn::make('estoque')
                    ->numeric()
                    ->sortable()->label('Saldo Fisico'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
