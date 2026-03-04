<?php

use Illuminate\Support\Facades\Route;

// Exercicio 1
Route::view("/", 'home');
/*
Route::view("/pagina", 'pagina');
Route::view("/pagina2", 'pagina2');
*/

// Exercicio 2
Route::any("/tudo", fn()=>"Aceita todos os tipos de request");

// Exercicio 3
Route::match(['put', 'delete'], '/update', fn()=>"Apenas delete e put são permitidos");

// Exercicio 5
Route::redirect('/redirectInicio', '/');
Route::redirect('/redirectPagina', '/pagina');
Route::redirect("/redirectoutrapagina", '/pagina2');

Route::get("/paginax/{pagina?}", function(?string $pagina ="30"){
    return view("paginax", ["pagina" => $pagina]);
})->name("paginaX");
// Redirecionamento com nome
Route::get("/redirect", function(){
    return redirect()->route("paginaX");
});
// Exercicio 6
Route::prefix("admin")->group(function(){
    Route::view("/dashboard", "dashboard");

});
// Adicionando parametros
Route::get("/pagina/{num?}", fn(?string $num='3000')=>view("pagina", ["num" => $num]));
Route::get("/pagina2/{numb?}", fn(?string $numb='2010')=>view('pagina2', ["numb" => $numb]));
