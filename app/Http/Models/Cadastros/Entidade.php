<?php

/**
 * Description of Pessoa
 *
 * @author renan.santos
 */
namespace App\Http\Models\Cadastros;

use App\Http\Models\Model;
use App\Http\Models\Estrutura\Moduloinstalado;

class Entidade extends Model{

    protected $fillable = [
        'idpessoa',
    ];
    
    public function pessoa(){
        return $this->belongsTo(Pessoa::class,'idpessoa','idpessoa');
    }
    
    public function modulosEntidade(){
        return $this->hasMany(Moduloinstalado::class,'identidade','identidade');
    }
    
    public function moduloAtivo($modpath){
        if($modpath == '/estrutura'){
            return true;
        }
        foreach ($this->modulosEntidade as $moduloEntidade){
            if($moduloEntidade->modulo->modpath == $modpath){
                return (bool) $moduloEntidade->mdiativo;
            }
        }
        return false;
    }

}
