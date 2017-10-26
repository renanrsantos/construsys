<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;
/**
 * Description of Periodofuncionario
 *
 * @author renan.santos
 */
class Periodofuncionario extends Model{
    protected $fillable = ['idfuncionarioobra','pefdatainicio','pefdatafim'];
    
    public function funcionarioObra(){
        return $this->belongsTo(Funcionarioobra::class,'idfuncionarioobra');
    }
}
