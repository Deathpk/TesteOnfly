<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despesas;

class DespesasController extends Controller
{
    public function createDespesa($id,Request $request)
    {
        dd($id);
    }

    public function getAllDespesas()
    {
        return response()->json(Despesas::all());
    }

    
    // public function showEditDespesaForm(Request $request)
    // {
    //     dd($request);
    //     // return view('editform', ['despesa' => $request->despesa] );

    // }

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
