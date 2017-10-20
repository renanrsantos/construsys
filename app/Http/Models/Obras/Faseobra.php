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
        'idfaseobra','idobra','fsodatainicio','fsodataprevistafim','fsoobservacao','fsostatus','idfase'
    ];
    
    public function obra(){
        return $this->belongsTo(Obra::class,'idobra');
    }
    
    public function fase(){
        return $this->belongsTo(Fase::class,'idfase');
    }
    
    public function status(){
        return self::getStatusFase()[$this->fsostatus];
    }
    
    public static function getStatusFase(){
        return [1=>'Não iniciada',2=>'Iniciada',3=>'Parada',4=>'Finalizada'];
    }
    
}
