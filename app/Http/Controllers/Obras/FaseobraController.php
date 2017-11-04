<?php

namespace App\Http\Controllers\Obras;
use App\Http\Models\Obras\Fase;

/**
 * Description of FaseobraController
 *
 * @author Renan Rodrigues
 */
class FaseobraController extends DependenciaObraController{
       
    protected function getColumns() {
        return [
                ['name'=>'idfaseobra','label'=>'Código','width'=>'5'],
                ['name'=>'fase,fsedescricao','label'=>'Fase','width'=>'20'],            
                ['name'=>'fsoobservacao','label'=>'Observação','width'=>'30','type'=>'string','length'=>'50'],
                ['name'=>'fsodatainicio','label'=>'Data início','width'=>'15','type'=>'date'],
                ['name'=>'fsodataprevistafim','label'=>'Data prev. fim','width'=>'15','type'=>'date'],
                ['name'=>'status()','label'=>'Status','width'=>'15'],
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'idfase','label'=>'Tipo da Fase','type'=>'multi','options'=>Fase::getFases(false)],
                ['value'=>'fsostatus','label'=>'Status','type'=>'multi','options'=>$this->getModel()->getStatusFase()],
                ['value'=>'fsodatainicio','label'=>'Data início','type'=>'date'],
            ];
    }
    protected function getTitulo() {
        return 'Fases da Obra';
    }
    
    protected function getModalSize(){
        return 'modal-lg';
    }
    
    protected function getDataGantt() {
        $data = [];
        foreach($this->getObra()->fasesObra as $fase){
            $data[] = [
                'name'=>$fase->fase->fsedescricao,
                'desc'=>$fase->fsoobservacao,
                'values'=>[
                    [
                        'from'=>$fase->fsodatainicio,
                        'to'=>$fase->fsodataprevistafim ? $fase->fsodataprevistafim : $fase->obra->dataFim(),
                        'label'=>$fase->fase->fsedescricao
                    ]
                ]
            ];
        }
        return $data;
    }
    
    public function cronograma(){
        $url = url($this->getUrl('','faseobra').'/data?gantt=true&idobra='.$this->getObra('index')->idobra);
        return $this->view('obras.form-cronograma',['acao'=>'Visualizar','url'=>$url,'modalSize'=>'modal-xl']);
    }
    
    public function getBtns() {
        return [
            app('form')->button('',['id'=>'btn-inicia','data-url'=>url($this->getUrl('','faseobra/inicia')),'icon'=>'fa fa-play','data-toggle'=>'modal','data-target'=>'#modal-fr-obras-faseobra','color'=>'success','class'=>'btn-single','data-form'=>'#fr-registros-obras-faseobra']),
            app('form')->button('',['id'=>'btn-para','data-url'=>url($this->getUrl('','faseobra/para')),'icon'=>'fa fa-pause','data-toggle'=>'modal','data-target'=>'#modal-fr-obras-faseobra','color'=>'danger','class'=>'btn-single','data-form'=>'#fr-registros-obras-faseobra']),
            app('form')->button('',['id'=>'btn-finaliza','data-url'=>url($this->getUrl('','faseobra/finaliza')),'icon'=>'fa fa-flag-checkered','data-toggle'=>'modal','data-target'=>'#modal-fr-obras-faseobra','color'=>'primary','class'=>'btn-single','data-form'=>'#fr-registros-obras-faseobra']) 
        ];
    }
    
    public function getValidaController($record) {
        return [
            ['btns'=>['#btn-inicia','#btn-para','#btn-finaliza'],'value'=>0,'hint'=>'Não implementado']
        ];
    }
}
