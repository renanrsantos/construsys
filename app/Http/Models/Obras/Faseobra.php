<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;

/**
 * Description of Faseobra
 *
 * @author Renan Rodrigues
 */
class Fasobra extends Model{
    protected $fillable = [
        'idfaseobra','idobra','fsoporcentagem','fsodatainicio','fsoobservacao','fsostatus','idfase'
    ];
    
    public function fase(){
        return $this->belongsTo(Fase::class,'idfase');
    }
    
}
