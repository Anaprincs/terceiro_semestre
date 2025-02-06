<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateItemVendaRequest;
use App\Models\ItemVenda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
    public function update($id, UpdateItemVendaRequest $request)
    {
    
        $itemVenda = ItemVenda::find($id);
        if ($itemVenda == null) {
            return response()->json([
                'status' => false,
                'message' => 'Esta venda não existe',
                'data' => $itemVenda
            ]);
        }
        if (isset($request->venda_id)) {
            $itemVenda->venda_id = $request->venda_id;
        }
        if (isset($request->produto_id)) {
            $itemVenda->produto_id = $request->produto_id;
        }
    
        if (isset($request->quantidade)) {
            $itemVenda->quantidade = $request->quantidade;
            $itemVenda->subtotal_item = $itemVenda->quantidade * $itemVenda->preco_unitario;
        }

        if (isset($request->preco_unitario)) {
            $itemVenda->preco_unitario = $request->preco_unitario;
            $itemVenda->subtotal_item = $itemVenda->quantidade * $itemVenda->preco_unitario;
        }
       

        $itemVenda->update([
            'subtotal_item'=>$request->preco_unitario * $request-> quantidade
        ]);


        return response()->json([
            'status' => false,
            'message' => 'Este cliente existe',
            'data' => $itemVenda
        ]);
    }
    
    public function index()
    {
        $item = ItemVenda::all();
        return response()->json([
            'status' => true,
            'message' => 'Busca realizada com sucesso',
            'data' => $item
        ]);
    }

    public function busca($id)
    {
        $item = ItemVenda::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Cliente encontrado',
            'data' => $item
        ]);
    }

    

    public function delete ($id){
        $item = ItemVenda::find($id);
        if ($item == null) {
            return response()->json([
                'status' => false,
                'message' => 'Este cliente não existe',
                'data' => $item
            ]);
        }
        $item->delete();

        return response()->json([
            'status' => false,
            'message' => 'Cliente deletado',
            'data' => $item
        ]);
    }
}
