<?php

namespace App\Http\Models\Cadastros;

use App\Http\Models\Model;
/**
 * Description of Produto
 *
 * @author Renan Rodrigues
 */
class Produto extends Model{
    protected $fillable = [
        'idproduto','prddescricao','prddescdet','prdcodigobarras','idunidademedida',
        'idcategoriaproduto','idsubcategoriaproduto','prdvalorunitario'
    ];
    
    public $consulta = ['visible'=>'idproduto,prddescricao,unmsigla,prdvalorunitario',
        'search'=>'prddescricao,prddescdet',
        'text'=>'prddescricao',
        'label'=>'Produto',
        'objetos'=>['unmsigla'=>'unidadeMedida']
    ];

    public function unidadeMedida(){
        return $this->belongsTo(Unidademedida::class,'idunidademedida');
    }
    
    public function categoria(){
        return $this->belongsTo(Categoriaproduto::class,'idcategoriaproduto');
    }
    
    public function subcategoria(){
        return $this->belongsTo(Subcategoriaproduto::class,'idsubcategoriaproduto');
    }
}
