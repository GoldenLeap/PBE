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
}
