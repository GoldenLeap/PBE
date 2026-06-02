<?php

namespace App\Filament\Resources\Pedidos\RelationManagers;

use App\Models\Produto;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemPedidosRelationManager extends RelationManager
{
    protected static string $relationship = 'itens';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('produto_id')
                    ->relationship('produto', 'nome')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('preco_unitario', Produto::find($state)?->preco_venda ?? 0);
                    }),

                TextInput::make('quantidade')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->reactive(),

                TextInput::make('preco_unitario')
                    ->numeric()
                    ->required()
                    ->step(0.01),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('produto.nome')->label('Produto'),
                TextColumn::make('quantidade')->label('Quantidade'),
                TextColumn::make('preco_unitario')->label('Preço unitário')->money('BRL'),
                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->getStateUsing(fn ($record) => ($record->quantidade * $record->preco_unitario))
                    ->money('BRL'),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
