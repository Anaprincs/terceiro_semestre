<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class CilenteController extends Controller
{
    public function store(ClienteRequest $request)
    {
        $cliente = Cliente::create([
            "nome" => $request->nome,
            "email" => $request->email,
            "telefone" => $request->telefone,
            "endereco" => $request->endereco
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Cadastro realizado',
            'data' => $cliente
        ]);
    }

    public function index(Request $request)
    {
        $cliente = Cliente::all();
        return response()->json([
            'status' => true,
            'message' => 'Busca realizada com sucesso',
            'data' => $cliente
        ]);
    }

    public function busca($id)
    {
        $cliente = Cliente::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Cliente encontrado',
            'data' => $cliente
        ]);
    }

    public function update($id, Request $request)
    {
        $cliente = Cliente::find($id);
        if ($cliente == null) {
            return response()->json([
                'status' => false,
                'message' => 'Este cliente não existe',
                'data' => $cliente
            ]);
        }
        if (isset($request->nome)) {
            $cliente->nome = $request->nome;
        }
        if (isset($request->email)) {
            $cliente->email = $request->email;
        }
        if (isset($request->telefone)) {
            $cliente->teleofone = $request->telefone;
        }
        if (isset($request->endereco)) {
            $cliente->endereco = $request->endereco;
        }

        $cliente->update();
        return response()->json([
            'status' => false,
            'message' => 'Este cliente existe',
            'data' => $cliente
        ]);
    }

    public function delete($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente == null) {
            return response()->json([
                'status' => false,
                'message' => 'Este cliente não existe',
                'data' => $cliente
            ]);
        }
        $cliente->delete();
        return response()->json([
            'status' => false,
            'message' => 'Cliente deletado',
            'data' => $cliente
        ]);
    }
}
