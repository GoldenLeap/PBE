<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index(){
        $estoques = Estoque::all();
        return view('estoque.index', compact('estoques'));
    }
    public function create()
    {
        return view("estoque/create");
    }

    public function store(Request $req){
        $req->validate(
            [
                'nome_produto' => 'string|required',
                'quantidade_estoque'=> 'integer|required',
            ]
        );
        Estoque::create($req->all());
        return redirect()->route('estoque.index')->with('success', 'Item adicionado ao estoque com sucesso');
    }
}
