<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index(){
        $produtos = Produtos::all();
        return view('produtos.index', compact('produtos'));
    }
        public function create()
    {
        return view('produtos/create');
    }

    public function store(Request $req)
    {
        //
        $req->validate([
                'nome_produto' => 'required|string|max:255',
                'descricao_produto' => 'required|string|max:255',
                'preco_produto' => 'decimal:0,600|required',
                'quantidade_produto' => 'required|integer',
            ]
        );

        Produtos::create($req->all());

        return redirect()->route('produtos.index')->with('success', 'Produto adicionado com sucesso');
    }
}
