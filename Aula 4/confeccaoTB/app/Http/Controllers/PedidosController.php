<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index() {
        $pedidos = Pedidos::all();
        return view('pedidos.index', compact('pedidos'));
    }
        public function create()
    {
        return view('pedidos/create');
    }

    public function store(Request $req)
    {
        //
        $req->validate([
                'num_pedido' => 'required|integer|unique:pedidos',
                'nome_cliente' => 'required|string',
            ]
        );

        Pedidos::create($req->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido adicionado com sucesso');
    }
}
