<?php

/**
 * Description of Pessoaendereco
 *
 * @author renan.santos
 */
namespace App\Http\Models\Cadastros;

use App\Http\Models\Model;

class Pessoaendereco extends Model{
    
    protected $fillable = [
        'idpessoaendereco','peetipo','peecomplemento','peebairro','peelogradouro',
        'peenumero','idpessoa','peecep','peecidade','peeestado'
    ];
    
    public function tiposEndereco(){
        return [
            ''=>'',
            1=>'Residencial',
            2=>'Comercial',
            3=>'Correspondência'
        ];
    }
    
    public function estados(){
        $siglas = ["","AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO"];
        foreach($siglas as $sigla){
            $return[$sigla] = $sigla;
        }
        return $return;
    }
    
}


