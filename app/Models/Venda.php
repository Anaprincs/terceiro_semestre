<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $fillable = [
        'cliente_id',
        'data_venda',
        'subtotal',
        'desconto',
        'total'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function vendaItemVenda(){
        return $this->hasMany(ItemVenda::class);
    }
}
