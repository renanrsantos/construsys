<?php

namespace App\Http\Controllers\Obras;

/**
 * Description of PagamentoController
 *
 * @author renan.santos
 */
class PagamentoController extends DependenciaObraController{
    
    protected function getColumns() {
        return [
                ['name'=>'idpagamento','label'=>'Código','width'=>'5'],
                ['name'=>'pagobs','label'=>'Observação','width'=>'60'],
                ['name'=>'pagdata','label'=>'Data','width'=>'15'],
                ['name'=>'pagvalor','label'=>'Valor','width'=>'15'],
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'pagdata','label'=>'Data','type'=>'date','data-column'=>2],
            ];
    }
    protected function getTitulo() {
        return 'Pagamentos';
    }
    
    protected function getModalSize(){
        return 'modal-lg';
    }    
}
