<?php

/**
 * Description of Pessoa
 *
 * @author renan.santos
 */
namespace App\Http\Models\Cadastros;

use App\Http\Models\Model;

class Pessoa extends Model{
    
    protected $fillable = [
        'idpessoa','pestipo','pesnome','pescpfcnpj','pesrgie'
    ];
    
    public $consulta = [
        'visible'=>'idpessoa,pesnome,pescpfcnpj',
        'search'=>'pesnome,pescpfcnpj',
        'text'=>'pesnome',
        'label'=>'Pessoa'
    ];

    public function tiposPessoa(){
    	return [
            1=>'Física',
            2=>'Jurídica'
        ];
    }

    public function tipoPessoaFisica(){
    	return [1=>'Física'];
    }

    public function tipoPessoaJuridica(){
    	return [2=>'Jurídica'];
    }
        
    public function contatos(){
        return $this->hasMany(Pessoacontato::class,'idpessoa','idpessoa');
    }
    
    public function contato($pectipo){
        $contatos = $this->contatos->where('pectipo',$pectipo);
        if($contatos->isEmpty()){
            $contato = new Pessoacontato;
        } else {
            $contato = $contatos->first();
        }
        return $contato;
    }

    public function enderecos(){
        return $this->hasMany(Pessoaendereco::class,'idpessoa','idpessoa');
    }
    
    public function endereco(){
        $enderecos = $this->enderecos;
        if(!$enderecos->isEmpty()){
            return $enderecos->first(); // até que seja implementado na tela para trazer todos os endereços
        }
        return new Pessoaendereco(); 
    }

    public function cliente(){
        return $this->hasOne(Cliente::class,'idpessoa');
    }

    public function fornecedor(){
        return $this->hasOne(Fornecedor::class,'idpessoa');
    }
}
