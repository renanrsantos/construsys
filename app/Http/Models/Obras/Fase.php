<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;
/**
 * Description of Fase
 *
 * @author Renan Rodrigues
 */
class Fase extends Model{
    protected $fillable = [
        'idfase','fsedescricao',
    ];
    
    public function getFases(){
        $fases = [];
        foreach($this->all() as $fase){
            $fases[$fase->idfase] = $fase->fsedescricao;
        }
        return $fases;
    }    
}
