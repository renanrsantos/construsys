<?php

namespace App\Http\Models\Estrutura;

use App\Http\Models\Model;

class Moduloinstalado extends Model
{
    protected $fillable = [
        'idmodulo', 'identidade', 'mdiativo',
    ];
      
    public function getCampoAtivo() {
        return 'mdiativo';
    }
    
    public function modulo(){
        return $this->belongsTo(Modulo::class,'idmodulo','idmodulo');
    }
    
    public function entidade(){
        return $this->belongsTo(\App\Http\Models\Cadastros\Entidade::class,'identidade','identidade');
    }
    
    public function processaNovo() {
        parent::processaNovo();
        $this->mdiativo = 1;
    }
}
