<?php

namespace App\Http\Controllers;

use App\Models\Fornecedores;
use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    public function index(){
        $fornecedores = Fornecedores::all();
        return view('fornecedores.index', compact('fornecedores'));
    }
     public function create()
    {
        return view("fornecedores/create");
    }

    public function store(Request $req){
        $req->validate(
            [
                'nome_fornecedor' => 'string|required',
                'cnpj'=> 'string|required|unique:fornecedores',
            ]
        );
        Fornecedores::create($req->all());
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor adicionado com sucesso');
    }
    public function destroy(Fornecedores $fornecedor)
    {
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido');

    }
    public function edit(Fornecedores $fornecedor)
    {
        return view('fornecedores.edit', compact('fornecedor'));
    }

    public function update(Request $req, Fornecedores $fornecedor)
    {
        $req->validate([
            'nome_fornecedor' => 'required|string',
            'cnpj' => 'required|string|unique:fornecedores,cnpj,' . $fornecedor->id,
        ]);

        $fornecedor->update($req->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso');
    }
}
