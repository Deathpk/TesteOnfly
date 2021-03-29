<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesas extends Model
{
    use HasFactory;
    protected $fillable = ['descricao','data','anexo','user_id','valor'];

    public static function editDespesa($despesa)
    {
        foreach($despesa->except('id') as $key => $value){
            if($value){
                Despesas::where('id', $despesa->id)->update([
                    $key => $value
                ]);
            }
        }
    }

}
