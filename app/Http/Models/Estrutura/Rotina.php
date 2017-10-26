<?php

namespace App\Http\Models\Estrutura;

use App\Http\Models\Model;

/**
 * Description of Rotina
 *
 * @author renan
 */
class Rotina extends Model{
    
    protected $fillable = [
        'idmodulo', 'rotnome', 'rotpath', 'roticone'
    ];
    
    public $consulta = ['visible'=>'idrotina,rotnome,modnome',
        'search'=>'rotnome',
        'text'=>'rotnome',
        'label'=>'Rotina',
        'objetos'=>['modnome'=>'modulo']
    ];    
    
    public function modulo(){
        return $this->belongsTo(Modulo::class,'idmodulo','idmodulo');
    }
      
    public function subrotinas(){
        return $this->hasMany(Subrotina::class,'idrotina','idrotina')->orderBy('idsubrotina');
    }
   
}
