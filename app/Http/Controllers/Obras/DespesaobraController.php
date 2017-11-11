<?php

namespace App\Http\Controllers\Obras;

use App\Http\Models\Obras\Itemdespesa;


class DespesaobraController extends DependenciaObraController{
    
    protected function getColumns() {
        return [
            ['name'=>'iddespesaobra','label'=>'Código','width'=>'5'],
            ['name'=>'dsodata','label'=>'Data','width'=>'10','type'=>'date'],
            ['name'=>'descricao()','label'=>'Descrição','width'=>'20','type'=>'string','length'=>'40'],
            ['name'=>'getTipoDespesa()','label'=>'Tipo','width'=>'10'],
            ['name'=>'dsovalortotal','label'=>'Valor Total','width'=>'10','type'=>'decimal'],
        ];
    }

    protected function getFilters() {
        return [
            ['value'=>'iddespesaobra','label'=>'Código','type'=>'int'],
            ['value'=>'dsoobs','label'=>'Descrição','type'=>'string'],
            ['value'=>'dsotipo','label'=>'Tipo','type'=>'multi','options'=>$this->getModel()->getTiposDespesa(false)],
            ['value'=>'dsodata','label'=>'Data','type'=>'date'],
        ];
    }
    
    protected function getBtns() {
        return [
            app('form')->button('Itens',['id'=>'btn-itemdespesa','data-url'=>url($this->getUrl('','itemdespesa')),'icon'=>'fa fa-list-ol','data-toggle'=>'modal','data-target'=>'#modal-fr-obras-despesaobra','color'=>'primary','class'=>'btn-single','data-form'=>'#fr-registros-obras-despesaobra'])
        ];
    }
    
    protected function getTitulo() {
        return 'Despesa da Obra';
    }

    protected function getModalSize(){
        return 'modal-lg';
    }

    protected function processaNovoRelacao(){
        $this->processaItensDespesa();
    }

    protected function processaAlterarRelacao(){
        $this->processaItensDespesa();
    }

    protected function excluirRelacao(){
        foreach ($this->model->itens as $item) {
            $item->delete();
        }
    }

    private function processaItensDespesa(){
        // despesa por item
        if($this->request->dsotipo == 2){
            $iddespesaobra = $this->id;
            $iditemdespesa = $this->request->get('iditemdespesa');
            $idproduto = $this->request->get('idproduto');
            $itdquantidade = $this->request->get('itdquantidade');
            $itdvalorunitario = $this->request->get('itdvalorunitario');
            $itdcomplemento = $this->request->get('itdcomplemento');

            for ($i=0; $i < count($iditemdespesa); $i++) {
                if($idproduto[$i]){
                    $itemdespesa = ['iditemdespesa'=>$iditemdespesa[$i],'iddespesaobra'=>$iddespesaobra,'idproduto'=>$idproduto[$i],'itdquantidade'=>$itdquantidade[$i],'itdvalorunitario'=>$itdvalorunitario[$i],'itdcomplemento'=>$itdcomplemento[$i]]    ;
                    if($itemdespesa['iditemdespesa']){
                        Itemdespesa::find($itemdespesa['iditemdespesa'])->update($itemdespesa);
                    } else {
                        Itemdespesa::create($itemdespesa);
                    }
                }
            }
        }
    }
}
