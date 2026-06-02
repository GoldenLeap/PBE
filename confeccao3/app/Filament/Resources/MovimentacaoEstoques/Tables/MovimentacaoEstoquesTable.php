<?php

namespace App\Filament\Resources\MovimentacaoEstoques\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


class MovimentacaoEstoquesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Data/Hora Evento')->dateTime('d/m/Y H:i')->sortable(),
                TextColumn::make('produto.nome')->label('Produto Têxtil')->searchable(),
                TextColumn::make('tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state){
                        'entrada' => 'success',
                        'saida' => 'danger',
                    })
                    ->label('Natureza'),
                TextColumn::make('quantidade')->numeric()->label('Qtd Vol.'),
                TextColumn::make('observacao')->label('Observação de Controle'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
