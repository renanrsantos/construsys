<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;

/**
 * Description of Pagamento
 *
 * @author renan.santos
 */
class Pagamento extends Model{
    protected $fillable = ['idobra','pagobs','pagdata','pagvalor'];
    
    public function obra(){
        return $this->belongsTo(Obra::class,'idobra');
    }
    
    protected function getPropExtra($acao){
        switch ($acao) {
            case 'index':
            case 'novo':
                $obra = $this->getObra();
                $disableAll = false;
                return compact('obra','disableAll');
            default:
                return array_merge(['obra'=>null],parent::getPropExtra($acao));
        }
    }
}
