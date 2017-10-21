<?php

namespace App\Http\Controllers\RH;
/**
 * Description of FuncionarioController
 *
 * @author renan.santos
 */
class FuncionarioController extends \App\Http\Controllers\Controller{
    //put your code here
    protected function getColumns() {
        return [
            ['name'=>'idfuncionario','label'=>'Código','width'=>'5'],
            ['name'=>'pessoa,pesnome','label'=>'Nome','width'=>'30'],
            ['name'=>'pessoa,pescpfcnpj','label'=>'Cpf','width'=>'20'],
            ['name'=>'cargo,carnome','label'=>'Cargo','width'=>'15'],
            ['name'=>'fundataadmissao','label'=>'Data Admissão','width'=>'15'],
            ['name'=>'funsalariobase','label'=>'Salário','width'=>'10'],
        ];
    }

    protected function getFilters() {
        return [
            
        ];
    }

    protected function getTitulo() {
        return 'Funcionários';
    }

}
