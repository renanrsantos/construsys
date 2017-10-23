<?php

namespace App\Http\Controllers\Obras;

use App\Http\Models\Obras\Funcionarioobra;

/**
 * Description of PeriodofuncionarioController
 *
 * @author renan.santos
 */
class PeriodofuncionarioController extends \App\Http\Controllers\Controller{
    private $funcionarioObra;
    
    protected function getColumns() {
        return [
            ['name'=>'idperiodofuncionario','label'=>'Código','width'=>'5'],
            ['name'=>'pefdatainicio','label'=>'Data início','width'=>'45'],
            ['name'=>'pefdatafim','label'=>'Data fim','width'=>'45'],
        ];
    }

    protected function getFilters() {
        return [
            
        ];
    }

    protected function getTitulo() {
        return 'Período';
    }    
    
    protected function getFuncionarioObra(){
        if(is_null($this->funcionarioObra)){
            $id = $this->request->idfuncionarioobra ? $this->request->idfuncionarioobra : $this->request->id[0];
            $this->funcionarioObra = $this->getModel()->funcionarioObra ? $this->getModel()->funcionarioObra : Funcionarioobra::find($id);
        }
        return $this->funcionarioObra;
    }
    
    protected function getRecords(){
        return parent::getRecords()->where('idfuncionarioobra',$this->request->idfuncionarioobra);
    }

    protected function indexAsModal(){
        return true;
    }

    protected function getInputIdPai(){
        return app('form')->hidden('idfuncionarioobra',$this->request->id[0]);
    }
    
    protected function getHeaderPai() {
        return '';
    }
    
    protected function getPropExtra($acao){
        $funcionarioObra = $this->getFuncionarioObra();
        switch ($acao) {
            case 'index':
            case 'novo':
                $disableAll = false;
                return compact('funcionarioObra','disableAll');
            default:
                return array_merge(['funcionarioObra'=>$funcionarioObra],parent::getPropExtra($acao));
        }
    }
    
    protected function getModalSize() {
        return 'modal-lg';
    }

}
