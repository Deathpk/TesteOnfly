<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despesas;
use App\Models\User;
use Auth;
class DespesasController extends Controller
{
    public function createDespesa(Request $request)
    {
        try{
            Despesas::insert([
                'descricao' => $request->descricao,
                'data' => $request->data,
                'anexo' => $request->anexo,
                'user_id' => Auth::user()->id,
                'valor' => $request->valor,
            ]);
        } catch(Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'Oops! , ocorreu um erro inesperado. Mensagem: '.$e->getMessage()
            ],400);
        }

        return response()->json([
            'error' => false,
            'message' => 'Despesa Adicionada com sucesso!'
        ],200);
    }

    public function getAllDespesas()
    {
        return response()->json(Despesas::all());
    }

    
    
    public function editDespesa(Request $request)
    {
        try{
            Despesas::editDespesa($request);
        } catch(Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'Oops! , ocorreu um erro inesperado. Mensagem: '.$e->getMessage()
            ],400);
        }

        return response()->json([
            'error' => false,
            'message' => 'Despesa editada com sucesso!'
        ],200);

    }

    public function deleteDespesa(Request $request)
    {
        try{
            Despesas::where('id', $request->id)->delete();
        } catch(Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'Oops! , ocorreu um erro inesperado. Mensagem: '.$e->getMessage()
            ],400);
        }

        return response()->json([
            'error' => false,
            'message' => 'Despesa deletada com sucesso!'
        ]);
    }
    
}
