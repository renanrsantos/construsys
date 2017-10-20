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
                ['name'=>'obrtamanho','label'=>'Tamanho (m²)','width'=>'10'],
                ['name'=>'obrvalororcado','label'=>'Valor','width'=>'10'],
                ['name'=>'totalPago()','label'=>'Valor pago','width'=>'10'],
                ['name'=>'custo()','label'=>'Custo','width'=>'10'],
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
        $arrProp = ['data-toggle'=>'modal','data-target'=>'#modal-fr-obras-obra','color'=>'primary','class'=>'btn-single','data-form'=>'#fr-registros-obras-obra'];
        return [
            app('form')->button('Fases da Obra',array_merge($arrProp,['data-url'=>url($this->getUrl('','faseobra')),'icon'=>'fa fa-code-fork'])),
            app('form')->button('Cômodos',array_merge($arrProp,['data-url'=>url($this->getUrl('','comodo')), 'icon'=>'fa fa-bed'])),
            app('form')->button('Despesas',array_merge($arrProp,['data-url'=>url($this->getUrl('','despesaobra')), 'icon'=>'fa fa-shopping-cart'])),
            app('form')->button('Funcionários',array_merge($arrProp,['icon'=>'fa fa-users','data-toggle'=>'a','onclick'=>'alert("Em desenvolvimento"); return false;'])),
            app('form')->button('Cronograma',array_merge($arrProp,['data-url'=>url($this->getUrl('','faseobra/cronograma')),'icon'=>'fa fa-calendar'])),
            app('form')->button('Pagamentos', array_merge($arrProp,['data-url'=>url($this->getUrl('','pagamento')),'icon'=>'fa fa-usd'])),
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
        foreach ($this->getModel()->fasesObra as $fase){
            $fase->delete();
        }
    }

    private function processaComodos(){
        $idcomodo = $this->request->get('idcomodo');
        $idtipocomodo = $this->request->get('idtipocomodo');
        $comdescricao = $this->request->get('comdescricao');
        $comtamanho = $this->request->get('comtamanho');
        for($i = 0; $i < count($idcomodo); $i++){
            $comodo = ['idcomodo'=>$idcomodo[$i],'idtipocomodo'=>$idtipocomodo[$i],'comdescricao'=>$comdescricao[$i],'comtamanho'=>$comtamanho[$i],'idobra'=>$this->model->idobra];
            if($comodo['idtipocomodo']){
                if($comodo['idcomodo']){
                    Comodo::find($comodo['idcomodo'])->update($comodo);
                } else {
                    Comodo::create($comodo);
                }
            }
        }
    }

    private function processaFases(){
        $idfaseobra = $this->request->get('idfaseobra');
        $idfase = $this->request->get('idfase');
        $fsoobservacao = $this->request->get('fsoobservacao');
        $fsodatainicio = $this->request->get('fsodatainicio');
        $fsodataprevistafim = $this->request->get('fsodataprevistafim');
//        $fsoporcentagem = $this->request->get('fsoporcentagem');
        $fsostatus = $this->request->get('fsostatus');
        for($i = 0; $i < count($idfaseobra); $i++){
            $faseobra = ['idfaseobra'=>$idfaseobra[$i],'idfase'=>$idfase[$i],'fsoobservacao'=>$fsoobservacao[$i],'fsodataprevistafim'=>$fsodataprevistafim[$i],'fsodatainicio'=>$fsodatainicio[$i],'fsostatus'=>$fsostatus[$i],'idobra'=>$this->model->idobra];
            if($faseobra['idfase']){
                if($faseobra['idfaseobra']){
                    Faseobra::find($faseobra['idfaseobra'])->update($faseobra);
                } else {
                    Faseobra::create($faseobra);
                }
            }
        }
    }

}

