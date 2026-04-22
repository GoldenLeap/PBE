<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Middleware\VerifyCsrfToken;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/{id}', function($id){
    $response = Http::get("https://dummyjson.com/user/{$id}");
    if($response->successful()){
        $dados = $response->json();
        return response()->json(
            [
                'status' => "Sucesso",
                'result' => [
                    'nome_usuario' => "{$dados['firstName']} {$dados['lastName']}",
                    'genero' => $dados['gender'],
                    'tipo_sanguineo' => $dados['bloodGroup'],
                    'idade' => $dados['age'],
                    'imagem' => $dados['image'],
                ]
            ],
        200);
    }
    return response()->json(['status' => 'Usuario não encontrado']);
});

Route::post('user/novo_usuario', function (Request $req) {
    $dados = $req->validate([
        'nome_usuario' => 'string|required',
        'genero' => 'string|max:1|required',
        'tipo_sanguineo' => 'string|max:3|required',
        'idade' => "integer|max:100|required",
    ]);
    
    return response()->json([
        'mensagem' => "Sucesso ao cadastrar usuario",
        'dados_recebidos' => $dados,

    ], 201);
});