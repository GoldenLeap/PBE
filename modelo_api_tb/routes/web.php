<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('pokedex', [PokemonController::class, "index"]);

Route::get('/', function () {
    return view('welcome');
});

Route::post('pokemon/novo', function(Request $req){
    $dados = $req->validate([
        'nome_pokemon' => 'required|string|min:3',
        'tipo' => 'required|string',
        'ataque' => 'required|integer',

    ]);
    return response()->json([
        'mensagem' => 'Pokemon cadastrado com sucesso!',
        'id_gerado' => floor(microtime(true) * 1000),
        'dados_recebidos' => $dados,
    ], 201);
});

Route::get('pokemon/{numero}', function($numero){
    $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$numero}");
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

