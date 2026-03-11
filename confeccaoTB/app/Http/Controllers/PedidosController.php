<?php
namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
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
            'num_pedido'   => 'required|integer|unique:pedidos',
            'nome_cliente' => 'required|string',
        ]
        );

        Pedidos::create($req->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido adicionado com sucesso');
    }
    public function destroy(Pedidos $pedidos)
    {
        $pedidos->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido removido');

    }
    public function edit(Pedidos $pedido)
    {
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $req, Pedidos $pedido)
    {
        $req->validate([
            'num_pedido'   => 'required|integer|unique:pedidos,num_pedido,' . $pedido->id,
            'nome_cliente' => 'required|string',
        ]);

        $pedido->update($req->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso');
    }
}
