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
        'idobra','idcliente','idorcamento','obrtamanho','obrtipo','obrdescricao','obrdatainicio',
        'obrprevisao','obrvalororcado','obrtipoprevisao'
    ];
    
    public function comodos(){
        return $this->hasMany(Comodo::class,'idobra');
    }
    
    public function fasesObra(){
        return $this->hasMany(Faseobra::class,'idobra');
    }
    
    public function cliente(){
        return $this->belongsTo(Cliente::class,'idcliente');
    }
    
    public function despesas(){
        return $this->hasMany(Despesaobra::class,'idobra');
    }
    
    public function pagamentos(){
        return $this->hasMany(Pagamento::class,'idobra');
    }

    public function comodosAsArray(){
        $comodos = [''=>''];
        foreach ($this->comodos as $comodo) {
            $comodos[$comodo->idcomodo] = $comodo->comdescricao . ' ('.$comodo->tipoComodo->tconome.')';
        }
        return $comodos;
    }

    public function fasesObraAsArray(){
        $fases = [''=>''];
        foreach ($this->fasesObra as $fase) {
            $fases[$fase->idfaseobra] = $fase->fsodescricao . ' ('.$fase->fase->fsedescricao.')';
        }
        return $fases;        
    }
    
    public function endereco(){
        return "";
    }
    
    public function getTiposPrevisao(){
        return [''=>'', 1=>'Dia(s)', 2=>'Mês(es)', 3=>'Ano(s)'];
    }
    public function getTiposObra(){
        return [''=>'', 1=>'Construção', 2=>'Reforma'];
    }
    
    public function custo(){
        return number_format($this->despesas->sum('dsovalortotal'),2,',','.');
    }
    
    public function totalPago(){
        return number_format($this->pagamentos->sum('pagvalor'),2,',','.');
    }
    
    public function getObrvalororcadoAttribute($value){
        return number_format($value,2,',','.');
    }
    
    public function getObrtamanhoAttribute($value){
        return number_format($value,2,',','.');
    }
}
