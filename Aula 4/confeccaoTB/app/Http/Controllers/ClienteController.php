<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Clientes;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Clientes::all();
        return view('clientes/index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes/create');
    }

    public function store(Request $req)
    {
        //
        $req->validate([
                'nome' => 'required|string|max:255',
                'cpf' => 'required|string|unique:clientes',
                'email' => 'required|email|unique:clientes',
                'telefone' => 'required|string',
                'endereco' => 'nullable|string',
            ]
        );

        Clientes::create($req->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso');
    }
}
