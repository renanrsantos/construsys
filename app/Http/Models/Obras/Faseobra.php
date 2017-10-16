<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;

/**
 * Description of Faseobra
 *
 * @author Renan Rodrigues
 */
class Faseobra extends Model{
    protected $fillable = [
        'idfaseobra','idobra','fsoporcentagem','fsodatainicio','fsodataprevistafim','fsoobservacao','fsostatus','idfase'
    ];
    
    public function fase(){
        return $this->belongsTo(Fase::class,'idfase');
    }
    
}
