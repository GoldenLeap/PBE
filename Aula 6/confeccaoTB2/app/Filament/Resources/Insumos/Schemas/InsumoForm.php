<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InsumoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome do insumo')
                    ->required(),
                Select::make('unidade_medida')
                ->label("Unidade de Medida")
                ->default("kg")
                ->options(
                    [
                        "Massa" => [
                            "t" => "Toneladas",
                            "kg" => "Quilogramas",
                            "g" => "Gramas",
                            "mg" => "Miligramas",
                        ],
                        "Volume" => [
                            "l" => "Litros",
                            "ml" => "Mililitros",
                            "m³" => "Metros cubicos",
                        ],
                        "Comprimento"=>[
                            'km' => "Quilometros",
                            'm' => "Metros",
                            "mm" => "Milimetros",
                            "cm" => 'Centimetros',
                        ],
                        "Area" => [
                            "ha" => "Hectares",
                            "m²" => "Metros quadrados"
                        ]
                    ]
                ),
                TextInput::make('preco_custo')
                    ->label("Preço de Custo")
                    ->prefix("R$")
                    ->numeric(),
                TextInput::make('estoque')

                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
