<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;
use App\Http\Models\Rh\Cargo;
use App\Http\Models\Rh\Funcionario;

/**
 * Description of Funcionarioobra
 *
 * @author renan.santos
 */
class Funcionarioobra extends Model{
    protected $fillable = [
        'idobra','idfaseobra','fuoobs','idcargo','idfuncionario'
    ];
    
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
        return $this->periodos()->orderBy('idperiodofuncionario','desc')->first();
    }
    
    public function descUltimoPeriodo(){
        if($this->periodos->isEmpty()){
            return 'Não há';
        }
        $ultimoPeriodo = $this->ultimoPeriodo();
        $dataFim = $ultimoPeriodo->pefdatafim ? $ultimoPeriodo->pefdatafim : '(Atual)';
        return $ultimoPeriodo->pefdatainicio.' à '. $dataFim;
    }
}
