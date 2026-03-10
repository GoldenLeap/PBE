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
} 
