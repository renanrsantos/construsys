<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;

class Tipocomodo extends Model{

    protected $fillable = [
        'idtipocomodo', 'tconome', 
    ];
    
//    public $consulta = ['visible'=>'idmodulo,modnome',
//        'search'=>'modnome',
//        'text'=>'modnome',
//        'label'=>'Módulo'
//    ];
           
}
