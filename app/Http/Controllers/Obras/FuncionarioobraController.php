<?php

namespace App\Http\Controllers\Obras;

/**
 * Description of FuncionarioobraController
 *
 * @author renan.santos
 */
class FuncionarioobraController extends DependenciaObraController{
    
    protected function getColumns() {
        return [
                ['name'=>'idfuncionarioobra','label'=>'Código','width'=>'5'],
                ['name'=>'funcionario,pessoa,pesnome','label'=>'Nome','width'=>'65'],            
                ['name'=>'cargo,carnome','label'=>'Cargo','width'=>'25'],
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'funcionario,pessoa,pesnome','label'=>'Nome Funcionário','type'=>'string','data-column'=>2],
                ['value'=>'cargo,carnome','label'=>'Cargo','type'=>'string','data-column'=>3],
            ];
    }
    
    protected function getBtns() {
        return [
            app('form')->button('Períodos',['data-url'=>url($this->getUrl('','periodofuncionario')),'icon'=>'fa fa-calendar','data-toggle'=>'modal','data-target'=>'#modal-fr-obras-funcionarioobra','color'=>'primary','class'=>'btn-single','data-form'=>'#fr-registros-obras-funcionarioobra'])
        ];
    }

    protected function getTitulo() {
        return 'Funcionários da Obra';
    }
    
    protected function getModalSize() {
        return 'modal-lg';
    }

}
