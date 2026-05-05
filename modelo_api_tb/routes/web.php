<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('pokedex/{id?}', [PokemonController::class, "index"])->name('pokemon.show');
Route::get('pokemon/create', [PokemonController::class, "create"])->name('pokemon.create');

Route::get('/', [PokemonController::class, 'show'])->name('pokedex');
Route::get('api/pokemon', [PokemonController::class, 'getMore'])->name('api.pokemon');

Route::post('pokemon/novo', [PokemonController::class, 'store'])->name('pokemon.store');

Route::get('pokemon/{numero}', function($numero){
    $response = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon/{$numero}");
    if($response->successful()){
        $dados = $response->json();
        return response()->json([
            'status' => 'Conectado com sucesso!',
            'resultado' => [
                'numero_dex' => $dados['id'],
                'nome_pokemon' => ucfirst($dados['name']),
                'imagem_pokemon' => $dados['sprites']['front_default'],
            ],
        ], 200);
    }
    return response()->json(['status' => 'Erro pokemon não encontradp'], 404);
});

