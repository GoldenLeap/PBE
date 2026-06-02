<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class MovimentacaoEstoque extends Model
{
    protected $table = 'movimentacoes_estoque';
    protected $guarded = [];
    protected $fillable = ['produto_id', 'tipo', 'quantidade', 'observacao'];
    //
    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    public static function booted(){
        static::creating(function($movimentacao){
            // validação: impedir saída maior que o estoque atual
            if($movimentacao->tipo === 'saida'){
                $produto = \App\Models\Produto::find($movimentacao->produto_id);
                if(!$produto){
                    throw ValidationException::withMessages(['produto_id' => 'Produto inválido.']);
                }
                if($produto->estoque < $movimentacao->quantidade){
                    throw ValidationException::withMessages(['quantidade' => 'Quantidade maior que o estoque disponível.']);
                }
            }
        });

        static::created(function($movimentacao){
            $produto = $movimentacao->produto;

            if($movimentacao->tipo === 'entrada'){
                $produto->estoque += $movimentacao->quantidade;
            }else{
                $produto->estoque -= $movimentacao->quantidade;
            }
            $produto->save();
        });
    }
}
