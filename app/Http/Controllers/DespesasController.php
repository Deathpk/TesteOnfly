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

    
    public function showEditDespesaForm(Request $request)
    {
        dd($request);
        // return view('editform', ['despesa' => $request->despesa] );

    }

    public function editDespesa(Request $request)
    {
        dd($request);
        
    }

    public function deleteDespesa()
    {

    }
    
}
