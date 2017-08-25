<?php

/**
 * Description of Pessoacontato
 *
 * @author renan.santos
 */
namespace App\Http\Models\Cadastros;

use App\Http\Models\Model;

class Pessoacontato extends Model{
    
    protected $fillable = [
        'idpessoacontato','pectipo','pecprefencial','idpessoa','peccontato'
    ];
}
