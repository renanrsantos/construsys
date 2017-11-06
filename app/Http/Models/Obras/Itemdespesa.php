<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;
use App\Http\Models\Cadastros\Produto;

/**
 * Description of Itemdespesa
 *
 * @author Renan Rodrigues
 */
class Itemdespesa extends Model{
    protected $fillable = [
       'iddespesaobra','idproduto','itdquantidade','itdvalorunitario','itdcomplemento'
    ];

    public function produto(){
    	return $this->belongsTo(Produto::class,'idproduto');
    }
    
}
