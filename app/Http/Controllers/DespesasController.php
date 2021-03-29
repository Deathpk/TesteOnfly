<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despesas;
use App\Models\User;
use Auth;
use Illuminate\Http\UploadedFile;
class DespesasController extends Controller
{
    public function createDespesa(Request $request)
    {
        $anexoPath = null;
        if($request->anexo != 'null'){
            if ( $request->file('anexo')->isValid() ){
                $storeAnexo = $this->storeAnexo($request->anexo);
                $anexoPath = $storeAnexo;
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


    public function storeAnexo($anexo)
    {
        $name = uniqid(date('HisYmd'));
        $extension = $anexo->extension();
        $nameFile = "{$name}.{$extension}";
        $newPath = $anexo->storeAs('anexos',$nameFile);

        $fullPath = storage_path()."\app\anexos". "\{$nameFile}";
        $fullPath = str_replace(['{','}'],'',$fullPath);
        return $fullPath;
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
