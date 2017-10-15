<?php

namespace App\Http\Models\Estrutura;

use \Illuminate\Database\Eloquent\Model;

/**
 * Description of Sistema
 *
 * @author renan
 */
class Sistema extends Model{
    
    protected $modulo = 'estrutura';
    protected $tabela = 'tbsistema';
    
    protected $primaryKey = 'idsistema';
    
    protected $fillable = [
        'idsistema','sisnome', 'sispath', 'sisicone'
    ];
    
    private $rotinas;
    
    public function rotinas(){
        if(is_null($this->rotinas)){
            $this->rotinas = $this->hasMany(Rotina::class,'idsistema','idsistema')->get();
        }
        return $this->rotinas;
    }
    
    public function hasRotinas(){
        return (bool) $this->rotinas();
    }
   
}
