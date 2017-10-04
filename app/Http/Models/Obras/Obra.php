<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;
use App\Http\Models\Cadastros\Cliente;
/**
 * Description of Obra
 *
 * @author Renan Rodrigues
 */
class Obra extends Model{
    protected $fillable = [
        'idobra','idcliente','idorcamento','obrtamanho','obrdescricao','obrdatainicio',
        'obrprevisao','obrvalororcado','obrtipoprevisao'
    ];
    
    public function comodos(){
        return $this->hasMany(Comodo::class,'idobra');
    }
    
    public function fases(){
        return $this->hasMany(Faseobra::class,'idobra');
    }
    
    public function cliente(){
        return $this->belongsTo(Cliente::class,'idcliente');
        
    }
    
    public function endereco(){
        return "";
    }
    
    public function getTiposPrevisao(){
        return [
            ''=>'',
            1=>'Dia(s)',
            2=>'Mês(es)',
            3=>'Ano(s)'
        ];
    }
}
