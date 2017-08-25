<?php

namespace App\Http\Models\Estrutura;

use App\Http\Models\Model;

class Modulo extends Model{

    protected $fillable = [
        'idmodulo', 'modnome', 'modpath', 'modicone'
    ];
    
    public $consulta = ['visible'=>'idmodulo,modnome',
        'search'=>'modnome',
        'text'=>'modnome',
        'label'=>'Módulo'
    ];
    
    public function rotinas(){
        $rotinas = $this->hasMany(Rotina::class,'idmodulo','idmodulo')->orderBy('idrotina');
        if(!$rotinas){
            $rotinas = [];
        }
        return $rotinas;
    }
       
}
