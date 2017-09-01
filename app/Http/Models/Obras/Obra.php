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
    
    public function getTiposPrevisao(){
        return [
            ['value'=>'','label'=>''],
            ['value'=>1,'label'=>'Dia(s)'],
            ['value'=>2,'label'=>'Mês(es)'],
            ['value'=>3,'label'=>'Ano(s)']
        ];
    }
}
