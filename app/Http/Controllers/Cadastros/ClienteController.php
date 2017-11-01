<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;
// use App\Http\Models\Cadastros\Pessoa;
// use App\Http\Models\Cadastros\Pessoacontato;
// use App\Http\Models\Cadastros\Pessoaendereco;

class ClienteController extends Controller{
    protected function getColumns(){
        return [
            ['name'=>'idcliente','label'=>'Código','width'=>'5'],
            ['name'=>'pessoa,pesnome','label'=>'Nome','width'=>'40','type'=>'string','length'=>'60'],
            ['name'=>'pessoa,pescpfcnpj','label'=>'Cpf / Cnpj','20'],
        ];
    }

    protected function getFilters(){
            return [];
    }

    protected function getTitulo(){
            return 'Cliente';
    }
    
    protected function getModalSize() {
        return 'modal-md';
    }
}
