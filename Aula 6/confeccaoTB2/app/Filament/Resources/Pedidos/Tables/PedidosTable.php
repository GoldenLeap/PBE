<?php

namespace App\Filament\Resources\Pedidos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PedidosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('cliente.nome')
                ->label('Cliente')
                ->searchable()
                ->sortable(),
            TextColumn::make("status")
                ->label('Status')
                ->badge()
                ->color(fn (string $state) : string => match($state){
                    'Pendente' => 'warning',
                    'Em Produção' => 'info',
                    'Finalizado' => 'success',
                    default => 'gray',
                }),
            TextColumn::make("valor_total")
                ->label('Valor Total')
                ->money("BRL")
                ->sortable() ,
            TextColumn::make('created_at')
                ->label("Data de criação")
                ->dateTime('d/m/Y H:i')
                ->sortable()
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
