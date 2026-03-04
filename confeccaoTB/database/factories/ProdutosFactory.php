<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produtos>
 */
class ProdutosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_produto' => fake()->name(),
            'descricao_produto' => fake()->text(),
            'preco_produto' => fake()->numberBetween(0, 100000),
            'quantidade_produto' => fake()->numberBetween(0, 100000),
        ];
    }
}
