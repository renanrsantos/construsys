<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;
/**
 * Description of Obra
 *
 * @author Renan Rodrigues
 */
class Obra extends Model{
    protected $fillable = [
        'idobra','obrdescricao','obrtipoprevisao','idcliente','obrdatainicio',
        'obrprevisao','obrtamanho'
    ];
    
    public function comodos(){
        
    }
    
    public function cliente(){
        
    }
    
    public function endereco(){
        return "";
    }
}
