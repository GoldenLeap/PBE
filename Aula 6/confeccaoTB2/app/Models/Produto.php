<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $guarded = [];

    public function registroEstoque()
    {
        return $this->hasOne(Estoque::class);
    }

    protected static function booted()
    {
        static::created(function ($produto) {
            $produto->registroEstoque()->create([
                'quantidade' => $produto->estoque ?? 0,
                'status' => ($produto->estoque ?? 0) > 0 ? 'Em estoque' : 'Fora do estoque',
            ]);
        });

        static::updated(function ($produto) {
            if ($produto->isDirty('estoque')) {
                $estoque = $produto->registroEstoque;
                if ($estoque) {
                    $estoque->update([
                        'quantidade' => $produto->estoque ?? 0,
                        'status' => ($produto->estoque ?? 0) > 0 ? 'Em estoque' : 'Fora do estoque',
                    ]);
                } else {
                    $produto->registroEstoque()->create([
                        'quantidade' => $produto->estoque ?? 0,
                        'status' => ($produto->estoque ?? 0) > 0 ? 'Em estoque' : 'Fora do estoque',
                    ]);
                }
            }
        });
    }
}
