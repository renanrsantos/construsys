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
    
    public function fasesObra(){
        return $this->hasMany(Faseobra::class,'idobra');
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

    public function getTiposComodo(){
        return Tipocomodo::getTiposComodo();
    }

    public function getFases(){
        return Fase::getFases();
    }

    public function getStatusFase(){
        return [1=>'Não iniciada',2=>'Iniciada',3=>'Parada',4=>'Finalizada'];
    }
}
