<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'codigo',
        'preco',
        'quantidade_estoque'
    ];

    public function ProdutoitemVenda(){
        return $this->hasMany(ItemVenda::class);
    }
}
