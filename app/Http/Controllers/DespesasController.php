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

    // public function getDetalhes()
    // {

    // }

    public function editDespesa()
    {

    }

    public function deleteDespesa()
    {

    }
    
}
