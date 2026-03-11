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

    public function destroy(Estoque $estoque)
    {
        $estoque->delete();

        return redirect()->route('estoque.index')->with('success', 'Item excluido do estoque');

    }
    public function edit(Estoque $estoque)
    {
        return view('estoque.edit', compact('estoque'));
    }

    public function update(Request $req, Estoque $estoque)
    {
        $req->validate([
            'nome_produto' => 'string|required',
            'quantidade_estoque'=> 'integer|required',
        ]);

        $estoque->update($req->all());

        return redirect()->route('estoque.index')->with('success', 'Item do estoque atualizado com sucesso');
    }
}
