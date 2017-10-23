<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;
use App\Http\Models\RH\Cargo;
use App\Http\Models\RH\Funcionario;

/**
 * Description of Funcionarioobra
 *
 * @author renan.santos
 */
class Funcionarioobra extends Model{
    protected $fillable = ['idfuncionarioobra','idobra','idfaseobra','fuoobs','idcargo','idfuncionario'];
    
    public function obra(){
        return $this->belongsTo(Obra::class,'idobra');
    }
    
    public function funcionario(){
        return $this->belongsTo(Funcionario::class,'idfuncionario');
    }
    
    public function cargo(){
        return $this->belongsTo(Cargo::class,'idcargo');
    }
    
    public function faseObra(){
        return $this->belongsTo(Faseobra::class,'idfaseobra');
    }
    
    public function periodos(){
        return $this->hasMany(Periodofuncionario::class,'idfuncionarioobra');
    }
    
    public function ultimoPeriodo(){
        $periodoAtual = $this->periodos()->orderBy('idperiodofuncionario','desc')->first();
        $dataFim = $periodoAtual->pefdatafim ? $periodoAtual->pefdatafim : '(Atual)';
        return $periodoAtual->pefdatainicio.' à '. $dataFim;
    }
}
