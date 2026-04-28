<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsuariosController extends Controller
{
    //
    public function index(){
        $id = rand(1, 29);
        $response = Http::withoutVerifying()->get("https://dummyjson.com/user/{$id}");
        if($response->successful()){
            $usuario = $response->json();
        }

        return view("usuario", compact("usuario"));
    }
}
