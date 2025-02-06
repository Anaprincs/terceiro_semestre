<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function store(ProdutoRequest $request)
    {
        $produto = Produto::create([
            "nome" => $request->nome,
            "codigo" => $request->codigo,
            "preco" => $request->preco,
            "quantidade_estoque" => $request->quantidade_estoque
        ]);
        return response()->json([
            'status'=> true,
            'message'=> 'Cadastro realizado',
            'data'=> $produto
        ]);
    }



    public function index(Request $request)
    {
        $produto = Produto::all();
        return response()->json([
            'status' => true,
            'message' => 'Busca realizada com sucesso',
            'data' => $produto
        ]);
    }

    public function busca($id)
    {
        $produto = Produto::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Cliente encontrado',
            'data' => $produto
        ]);
    }

    public function update($id, Request $request)
    {
        $produto = Produto::find($id);
        if ($produto == null) {
            return response()->json([
                'status' => false,
                'message' => 'Este cliente não existe',
                'data' => $produto
            ]);
        }
            if (isset($request->nome)) {
                $produto->nome = $request->nome;
            }
            if (isset($request->codigo)) {
                $produto->codigo = $request->codigo;
            }
            if (isset($request->preco)) {
                $produto->preco = $request->preco;
            }
            if (isset($request->quantidade_estoque)) {
                $produto->quantidade_estoque = $request->quantidade_estoque;
            }

            $produto->update();
            return response()->json([
                'status' => false,
                'message' => 'Este cliente existe',
                'data' => $produto
            ]);
    }

    public function delete ($id){
        $produto = Produto::find($id);
        if ($produto == null) {
            return response()->json([
                'status' => false,
                'message' => 'Este cliente não existe',
                'data' => $produto
            ]);
        }
        $produto->delete();
        return response()->json([
            'status' => false,
            'message' => 'Cliente deletado',
            'data' => $produto
        ]);
    }
}
