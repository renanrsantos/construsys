<?php

namespace App\Http\Models\Estrutura;

use App\Http\Models\Model;

/**
 * Description of Sistema
 *
 * @author renan
 */
class Rotina extends Model{
    
    protected $fillable = [
        'idrotina','idmodulo', 'rotnome', 'rotpath', 'roticone'
    ];
    
    public $consulta = ['visible'=>'idrotina,rotnome',
        'search'=>'rotnome',
        'text'=>'rotnome',
        'label'=>'Rotina'
    ];    
    
    public function modulo(){
        return $this->belongsTo(Modulo::class,'idmodulo','idmodulo');
    }
      
    public function subrotinas(){
        return $this->hasMany(Subrotina::class,'idrotina','idrotina')->orderBy('idsubrotina');
    }
   
}
