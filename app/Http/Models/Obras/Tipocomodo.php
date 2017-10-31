<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;

class Tipocomodo extends Model{

    protected $fillable = [
        'tconome', 
    ];

    public $consulta = [
        'visible'=>'idtipocomodo,tconome',
        'label'=>'Tipo',
        'search'=>'tconome',
        'text'=>'tconome'
    ];
    
    public static function getTiposComodo(){
        $tipos = [''=>''];
        foreach(self::all() as $tipo){
            $tipos[$tipo->idtipocomodo] = $tipo->tconome;
        }
        return $tipos;
    }    
    
           
}
