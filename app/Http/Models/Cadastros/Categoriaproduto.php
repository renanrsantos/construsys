<?php

/**
 * Description of Categoriaproduto
 *
 * @author renan.santos
 */
namespace App\Http\Models\Cadastros;

use App\Http\Models\Model;

class Categoriaproduto extends Model{

    protected $fillable = [
        'catdescricao',
    ];
    
    public $consulta = ['visible'=>'idcategoriaproduto,catdescricao',
        'search'=>'catdescricao',
        'text'=>'catdescricao',
        'label'=>'Categoria'
    ];
    
}
