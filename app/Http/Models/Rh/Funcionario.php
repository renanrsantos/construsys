<?php

namespace App\Http\Models\Rh;

use App\Http\Models\Model;
use App\Http\Models\Cadastros\Pessoa;
/**
 * Description of Funcionario
 *
 * @author renan.santos
 */
class Funcionario extends Model{
    protected $fillable = ['idcargo','idpessoa','fundataadmissao','funsalariobase'];
    
    public $consulta = [
        'visible'=>'idfuncionario,pesnome,carnome',
        'search'=>'pesnome',
        'text'=>'pesnome',
        'label'=>'Funcionário',
        'objetos'=>['pesnome'=>'pessoa','carnome'=>'cargo']
    ];
    
    public function pessoa(){
        return $this->belongsTo(Pessoa::class,'idpessoa');
    }
    
    public function cargo(){
        return $this->belongsTo(Cargo::class,'idcargo');
    }
}
