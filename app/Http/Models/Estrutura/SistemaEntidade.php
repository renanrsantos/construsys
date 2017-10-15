<?php

namespace App\Http\Models\Estrutura;

use Illuminate\Database\Eloquent\Model;

class SistemaEntidade extends Model
{
    protected $modulo = 'estrutura';
    protected $tabela = 'tbsistemaentidade';
    
    protected $primaryKey = 'idsistemaentidade';
    protected $fillable = [
        'idsistema','sieativo'
    ];
    
    private $sistema;
    private $entidade;
    
    public function sistema(){
        if(is_null($this->sistema)){
            $this->sistema = $this->hasOne(Sistema::class,'idsistema','idsistema')->first();
        }
        return $this->sistema;
    }
    public function entidade(){
        if(is_null($this->entidade)){
            $this->entidade = $this->hasOne(Entidade::class,'identidade','identidade')->first();
        }
        return $this->entidade;
    }
}
