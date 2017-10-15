<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use App\Http\Models\Obras\Comodo;
use App\Http\Models\Obras\Faseobra;

/**
 * Description of Obra
 *
 * @author Renan Rodrigues
 */
class ObraController extends Controller{
    
    protected function getColumns() {
        return [
                ['name'=>'idobra','label'=>'Código','width'=>'5'],
                ['name'=>'obrdescricao','label'=>'Descrição','width'=>'20'],
                ['name'=>'cliente,pessoa,pesnome','label'=>'Cliente','width'=>'20'],
                ['name'=>'endereco()','label'=>'Endereço','width'=>'20'],
                ['name'=>'obrvalororcado','label'=>'Valor','width'=>'10'],
                ['name'=>'obrtamanho','label'=>'Tamanho (m²)','width'=>'10']
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'idobra','label'=>'Código','type'=>'int','data-column'=>1],
                ['value'=>'cliente,pessoa,pesnome','label'=>'Cliente','type'=>'string','data-column'=>3],
                ['value'=>'endereco','label'=>'Endereço','type'=>'string','data-column'=>4]
            ];
    }
    
    protected function getBtns() {
        $urlDespesa = url(str_replace('/rotina/obra','/rotina/despesaobra',$this->getUrl()));
        return [
            app('form')->button('Despesas',['data-url'=>$urlDespesa, 'data-toggle'=>'modal','data-target'=>'#modal-fr-obras-obra','color'=>'primary','icon'=>'fa fa-shopping-cart','class'=>'btn-single','data-form'=>'#fr-registros-obras-obra']),
            app('form')->button('Funcionários',['color'=>'primary','icon'=>'fa fa-users','class'=>'btn-single']),
            app('form')->button('Cronograma',['color'=>'primary','icon'=>'fa fa-calendar','class'=>'btn-single']),
            app('form')->button('Pagamentos',['color'=>'primary','icon'=>'fa fa-usd','class'=>'btn-single'])
        ];
    }

    protected function getTitulo() {
        return 'Obras';
    }

    protected function getModalSize(){
        return 'modal-xl';
    }

    protected function processaNovoRelacao() {
        $this->processaComodos();
        $this->processaFases();
    }
    
    protected function processaAlterarRelacao() {
        $this->processaComodos();
        $this->processaFases();
    }
    
    protected function excluirRelacao() {
        foreach ($this->getModel()->comodos as $comodo){
            $comodo->delete();
        }
        foreach ($this->getModel()->fases as $fase){
            $fase->delete();
        }
    }

    private function processaComodos(){
        $idcomodo = $this->request->get('idcomodo');
        $idtipocomodo = $this->request->get('idtipocomodo');
        $comdescricao = $this->request->get('comdescricao');
        $comtamanho = $this->request->get('comtamanho');
        $comodos = [];
        for($i = 0; $i < count($idcomodo); $i++){
            $comodo = ['idcomodo'=>$idcomodo[$i],'idtipocomodo'=>$idtipocomodo[$i],'comdescricao'=>$comdescricao[$i],'comtamanho'=>$comtamanho[$i],'idobra'=>$this->getModel()->idobra];
            if($comodo['idcomodo']){
                $altcomodo = Comodo::find($comodo['idcomodo']);
                $altcomodo->update($comodo);
            } else if($comodo['idtipocomodo']){
                Comodo::create($comodo);
            }
        }
    }

    private function processaFases(){
        $idfaseobra = $this->request->get('idfaseobra');
        $idfase = $this->request->get('idfase');
        $fsoobservacao = $this->request->get('fsoobservacao');
        $fsodatainicio = $this->request->get('fsodatainicio');
        $fsoporcentagem = $this->request->get('fsoporcentagem');
        $fsostatus = $this->request->get('fsostatus');
        for($i = 0; $i < count($idfaseobra); $i++){
            $faseobra = ['idfaseobra'=>$idfaseobra[$i],'idfase'=>$idfase[$i],'fsoobservacao'=>$fsoobservacao[$i],'fsodatainicio'=>$fsodatainicio[$i],'fsoporcentagem'=>$fsoporcentagem[$i],'fsostatus'=>$fsostatus[$i],'idobra'=>$this->getModel()->idobra];
            if($faseobra['idfase']){
                Faseobra::updateOrCreate($faseobra);
            }
        }
    }

}

