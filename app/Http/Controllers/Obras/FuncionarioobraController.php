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
            ['name'=>'funcionario,pessoa,pesnome','label'=>'Nome','width'=>'50'],            
            ['name'=>'cargo,carnome','label'=>'Cargo','width'=>'20'],
            ['name'=>'descUltimoPeriodo()','label'=>'Último Período','15']
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
            app('form')->button('Períodos',['data-url'=>url($this->getUrl('','periodofuncionario')),'icon'=>'fa fa-calendar','data-toggle'=>'modal','data-target'=>'#modal-fr-obras-funcionarioobra','color'=>'primary','class'=>'btn-single','data-form'=>'#fr-registros-obras-funcionarioobra']),
            app('form')->button('',['id'=>'btn-entrada','data-url'=>url($this->getUrl('','periodofuncionario/entrada')),'icon'=>'fa fa-play','data-toggle'=>'modal','data-target'=>'#modal-fr-obras-funcionarioobra','color'=>'success','class'=>'btn-multi','data-form'=>'#fr-registros-obras-funcionarioobra']),
            app('form')->button('',['id'=>'btn-saida','data-url'=>url($this->getUrl('','periodofuncionario/saida')),'icon'=>'fa fa-stop','data-toggle'=>'modal','data-target'=>'#modal-fr-obras-funcionarioobra','color'=>'danger','class'=>'btn-multi','data-form'=>'#fr-registros-obras-funcionarioobra'])
        ];
    }

    protected function getTitulo() {
        return 'Funcionários da Obra';
    }
    
    protected function getModalSize() {
        return 'modal-xl';
    }
    protected function getValidaController($record) {
        if($record->periodos->isEmpty()){
            $valueI = 1;
            $valueP = 0;
        } else {
            if($record->ultimoPeriodo()->pefdatafim){
                $valueI = 1;
                $valueP = 0;
            } else {
                $valueI = 0;
                $valueP = 1;
            }
        }
        $valida[] = ['btns'=>['#btn-entrada'],'value'=>$valueI,'hint'=>'Já existe um período ativo.'];
        $valida[] = ['btns'=>['#btn-saida'],'value'=>$valueP,'hint'=>'Não existe um período ativo.'];
        return json_encode($valida);
    }
}
