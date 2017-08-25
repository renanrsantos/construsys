<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;
use App\Http\Models\Cadastros\Pessoa;
use App\Http\Models\Cadastros\Pessoacontato;
use App\Http\Models\Cadastros\Pessoaendereco;

class PessoaController extends Controller{
    
    protected function getColumns() {
        return [
            ['name'=>'idpessoa','label'=>'Código','width'=>'5'],
            ['name'=>'pesnome','label'=>'Nome','width'=>'80'],
            ['name'=>'pescpfcnpj','label'=>'Cpf / Cnpj','width'=>'15'],                    
//            ['name'=>'pesrgie','label'=>'RG / IE','width'=>'20'],                    
        ];
    }

    protected function getFilters() {
        return [
                ['value'=>'idpessoa','label'=>'Código','type'=>'int','data-column'=>1],
                ['value'=>'pesnome','label'=>'Nome','type'=>'string','data-column'=>2],
                ['value'=>'pescpfcnpj','label'=>'Cpf / Cnpj','type'=>'string','data-column'=>3],
            ];
    }
    
    protected function processaNovoRelacao() {
        $pessoa = $this->getModel();
        $idpessoa = $pessoa->idpessoa;
        if($this->request->pectelefone){
            Pessoacontato::create(['idpessoa'=>$idpessoa,'pectipo'=>1,'peccontato'=>$this->request->pectelefone]);
        }
        if($this->request->peccelular){
            Pessoacontato::create(['idpessoa'=>$idpessoa,'pectipo'=>2,'peccontato'=> $this->request->peccelular]);
        }
        if($this->request->pecemail){
            Pessoacontato::create(['idpessoa'=>$idpessoa,'pectipo'=>3,'peccontato'=> $this->request->pecemail]);
        }
        if($this->request->peetipo){
            $arr = array_merge(['idpessoa'=>$idpessoa],$this->request->toArray());
            Pessoaendereco::create($arr);
        }
    }
    
    protected function processaAlterarRelacao() {
        $this->processaAlterarContato();
        $this->processaAlterarEndereco();
    }
    
    protected function excluirRelacao() {
        foreach ($this->getModel()->enderecos as $endereco){
            $endereco->delete();
        }
        foreach ($this->getModel()->contatos as $contato){
            $contato->delete();
        }
    }
    
    private function processaAlterarContato(){
        $arrRequest = $this->request->toArray();
        if($this->request->idpectelefone){
            $contato = Pessoacontato::find($this->request->idpectelefone);
            $contato->update($arrRequest);
        } else if($this->request->pectelefone){
            $arrRequest['peccontato'] = $this->request->pectelefone;
            $arrRequest['pectipo'] = 1;
            Pessoacontato::create($arrRequest);
        }
        if($this->request->idpeccelular){
            $contato = Pessoacontato::find($this->request->idpeccelular);
            $contato->update($arrRequest);
        } else if ($this->request->peccelular){
            $arrRequest['peccontato'] = $this->request->peccelular;
            $arrRequest['pectipo'] = 2;
            Pessoacontato::create($arrRequest);
        }
        if($this->request->idpecemail){
            $contato = Pessoacontato::find($this->request->idpecemail);
            $contato->update($arrRequest);
        } else if($this->request->pecemail) {
            $arrRequest['peccontato'] = $this->request->pecemail;
            $arrRequest['pectipo'] = 3;
            Pessoacontato::create($arrRequest);
        }
    }
    
    private function processaAlterarEndereco(){
        if($this->request->idpessoaendereco){
            $endereco = Pessoaendereco::find($this->request->idpessoaendereco);
            $endereco->update($this->request->toArray());
        } else {
            Pessoaendereco::create($this->request->toArray());
        }
    }

}
