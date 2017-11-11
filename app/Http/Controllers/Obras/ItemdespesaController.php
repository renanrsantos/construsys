<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use App\Http\Models\Obras\Despesaobra;

/**
 * Description of ItemdespesaController
 *
 * @author renan
 */
class ItemdespesaController extends Controller{
    
    private $despesa;
    
    
    protected function getColumns() {
        return [
            ['name'=>'produto,prddescricao','label'=>'Produto','type'=>'string','length'=>'60'],
            ['name'=>'itdquantidade','label'=>'Qtd','type'=>'decimal'],
            ['name'=>'itdvalorunitario','label'=>'Vlr. Unit','type'=>'decimal'],
            ['name'=>'total()','label'=>'Vlr. Total','type'=>'decimal'],
            
        ];
    }

    protected function getFilters() {
        return [
            ['value'=>'produto,prddescricao','label'=>'Produto','type'=>'string'],
        ];        
    }

    protected function getTitulo() {
        'Itens da Despesa';
    }
    
    protected function getDespesa($acao = ''){
        if(is_null($this->despesa)){
            $id = $acao === 'index' ? $this->request->id[0] : $this->request->iddespesaobra;
            $this->despesa = $this->getModel()->despesa ? $this->getModel()->despesa : Despesaobra::find($id);
        }
        return $this->despesa;
    }
    
    protected function getRecords(){
        return parent::getRecords()->where('iddespesaobra',$this->request->iddespesaobra);
    }

    protected function indexAsModal(){
        return true;
    }

    protected function getInputIdPai(){
        return app('form')->hidden('iddespesaobra',$this->request->id[0]);
    }
    
    protected function getHeaderPai() {
        return '';
    }
    
    protected function getPropExtra($acao){
        $despesa = $this->getDespesa($acao);
        switch ($acao) {
            case 'index':
            case 'novo':
                $disableAll = false;
                return compact('despesa','disableAll');
            default:
                return array_merge(['despesa'=>$despesa],parent::getPropExtra($acao));
        }
    }
    
     protected function getValidaController($record) {
        $valida[] = ['btns'=>['#btn-itemdespesa'],'value'=>($record->dsotipo == 2 ? 1 : 0),'hint'=>'Somente despesa por item.'];
        return json_encode($valida);
    }
    
    protected function getModalSize() {
        return 'modal-md';
    }

}
