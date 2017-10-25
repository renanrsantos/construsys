<?php

namespace App\Http\Controllers\Obras;

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
                ['name'=>'fsoobservacao','label'=>'Observação','width'=>'30'],
                ['name'=>'fsodatainicio','label'=>'Data início','width'=>'15'],
                ['name'=>'fsodataprevistafim','label'=>'Data prev. fim','width'=>'15'],
                ['name'=>'status()','label'=>'Status','width'=>'15'],
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'fase,fsedescrocap','label'=>'Fase','type'=>'string','data-column'=>2],
                ['value'=>'fsostatus','label'=>'Status','type'=>'int','data-column'=>6],
                ['value'=>'fsodatainicio','label'=>'Data início','type'=>'date','data-column'=>4],
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
                        'to'=>$fase->fsodataprevistafim,
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
    
}
