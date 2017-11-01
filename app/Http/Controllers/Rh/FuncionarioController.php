<?php

namespace App\Http\Controllers\Rh;
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
            ['name'=>'pessoa,pesnome','label'=>'Nome','width'=>'30','type'=>'string','length'=>'60'],
            ['name'=>'pessoa,pescpfcnpj','label'=>'Cpf','width'=>'20'],
            ['name'=>'cargo,carnome','label'=>'Cargo','width'=>'15'],
            ['name'=>'fundataadmissao','label'=>'Data Admissão','width'=>'15','type'=>'date'],
            ['name'=>'funsalariobase','label'=>'Salário','width'=>'10','type'=>'decimal'],
        ];
    }

    protected function getFilters() {
        return [
            
        ];
    }

    protected function getTitulo() {
        return 'Funcionários';
    }
    
    protected function getModalSize() {
        return 'modal-lg';
    }

}
