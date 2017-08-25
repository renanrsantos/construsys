<?php

/**
 * Description of Unidademedida
 *
 * @author renan.santos
 */
namespace App\Http\Models\Cadastros;

use App\Http\Models\Model;

class Unidademedida extends Model{
    
    protected $fillable = [
        'idunidademdida','unmsigla','unmdescricao'
    ];

    public $consulta = ['visible'=>'idunidademdida,unmsigla,unmdescricao',
        'search'=>'unmsigla,unmdescricao',
        'text'=>'unmdescricao',
        'label'=>'Unidade Medida'
    ];
}
