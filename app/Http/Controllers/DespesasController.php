<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despesas;
use App\Models\User;
use Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class DespesasController extends Controller
{
    public function createDespesa(Request $request)
    {
        $anexoPath = null;
        if($request->file('anexo') != null){
            if ( $request->file('anexo')->isValid() ){
                $upload = $request->anexo->store('anexos');
                $anexoPath = $request->anexo->hashName();
            }
        }
        
        try{
            Despesas::insert([
                'descricao' => $request->descricao,
                'data' => $request->data,
                'anexo' => $anexoPath,
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
        $anexoPath = null;
        if($request->file('anexo') != null){
            if ( $request->file('anexo')->isValid() ){
                $upload = $request->anexo->store('anexos');
                $anexoPath = $request->anexo->hashName();
            }
        }
        try{
            Despesas::editDespesa([
                'id'=> $request->id,
                'anexo' => $anexoPath,
                'descricao' => $request->descricao,
                'valor' => $request->valor,
                'data' => $request->data
            ]);
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
            $anexoPath = Despesas::where('id', $request->id)->first('anexo');
            Despesas::where('id', $request->id)->delete();
            if($anexoPath->anexo != null){
                Storage::delete('anexos/'.$anexoPath->anexo);
            }
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
