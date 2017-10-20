<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;

/**
 * Description of Despesaobra
 *
 * @author Renan Rodrigues
 */
class Despesaobra extends Model{
    protected $fillable = [
        'iddespesaobra','idobra','dsoobs','idfaseobra','idcomodo','dsotipo','dsovalortotal','dsodata'
    ];
    
    public function obra(){
    	return $this->belongsTo(Obra::class,'idobra');
    }

    public function itens(){
    	return $this->hasMany(Itemdespesa::class,'iddespesaobra');
    }
    
    public function getTipoDespesa(){
        return $this->getTiposDespesa()[$this->dsotipo];
    }
    
    public function getTiposDespesa(){
        return [''=>'',1=>'Manual',2=>'Por Item'];
    }
}
