<?php

namespace App\Http\Models\Cadastros;

use App\Http\Models\Model;
/**
 * Description of Subcategoriaproduto
 *
 * @author Renan Rodrigues
 */
class Subcategoriaproduto extends Model{
    protected $fillable = [
        'sbcdescricao'
    ];
    
     public $consulta = ['visible'=>'idsubcategoriaproduto,sbcdescricao',
        'search'=>'sbcdescricao',
        'text'=>'sbcdescricao',
        'label'=>'Sub Categoria'
    ];
}
