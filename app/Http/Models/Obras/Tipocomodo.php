<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;

class Tipocomodo extends Model{

    protected $fillable = [
        'idtipocomodo', 'tconome', 
    ];

    public function getTiposComodo(){
        $tipos = [];
        foreach($this->all() as $tipo){
            $tipos[$tipo->idtipocomodo] = $tipo->tconome;
        }
        return $tipos;
    }    
    
           
}
