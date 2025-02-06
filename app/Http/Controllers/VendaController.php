<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaRequest;
use App\Http\Requests\VendaUpdateRequest;
use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function store(VendaRequest $request)
    {

        $venda = Venda::create([
            "cliente_id" => $request->cliente_id,
            "data_venda" => date('Y,m-d H-i-s'),
            "desconto" => $request->desconto,
            "subtotal" => 0,
            "total" => 0

        ]);


        $subtotal = 0;

        foreach ($request->itens as $item) {
            $subtotal += $item["quantidade"] * $item["preco_unitario"];

            $itemVenda = ItemVenda::create([
                "venda_id" => $venda->id,
                "produto_id" => $item["produto_id"],
                "quantidade" => $item["quantidade"],
                "preco_unitario" => $item["preco_unitario"],
                "subtotal_item"=> $subtotal
            ]);

            $produto = Produto::find($itemVenda->produto_id);
            $produto->quantidade_estoque = $produto->quantidade_estoque - $item["quantidade"];

            $produto->update();
        }

        $venda->update([
            "subtotal" => $subtotal,
            "total" => $subtotal - $request->desconto
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Cadastro realizado',
            'data' => $venda
        ]);
    }



    public function index(Request $request)
    {
        $venda = Venda::all();
        return response()->json([
            'status' => true,
            'message' => 'Busca realizada com sucesso',
            'data' => $venda
        ]);
    }

    public function busca($id)
    {
        $venda = Venda::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Cliente encontrado',
            'data' => $venda
        ]);
    }

    public function update($id, VendaUpdateRequest $request)
    {
    
        $venda = Venda::find($id);
        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => 'Esta venda não existe',
                'data' => $venda
            ]);
        }
        if (isset($request->cliente_id)) {
            $venda->cliente_id = $request->cliente_id;
        }
        if (isset($request->data_venda)) {
            $venda->data_venda = $request->data_venda;
        }
    
        if (isset($request->descoonto)) {
            $venda->desconto = $request->desconto;
        }
       

        $venda->update();
        return response()->json([
            'status' => false,
            'message' => 'Este cliente existe',
            'data' => $venda
        ]);
    }

    public function delete($id)
    {
        $venda = Venda::find($id);
        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => 'Este cliente não existe',
                'data' => $venda
            ]);
        }
        $venda->delete();

        return response()->json([
            'status' => false,
            'message' => 'Cliente deletado',
        ]);
    }
}
