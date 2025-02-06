<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    use HasFactory;
    protected $fillable = [
        'venda_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'subtotal_item',
    
    ];

    public function ItemVenda(){
        return $this->belongsTo(Venda::class);
    }
    public function ItemVendaProduto(){
        return $this->belongsTo(Produto::class);
    }
}
