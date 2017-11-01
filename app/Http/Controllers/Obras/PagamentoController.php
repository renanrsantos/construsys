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
                ['name'=>'pagobs','label'=>'Observação','width'=>'60','type'=>'string','length'=>'100'],
                ['name'=>'pagdata','label'=>'Data','width'=>'15','type'=>'date'],
                ['name'=>'pagvalor','label'=>'Valor','width'=>'15','type'=>'decimal'],
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'pagdata','label'=>'Data','type'=>'date'],
            ];
    }
    protected function getTitulo() {
        return 'Pagamentos';
    }
    
    protected function getModalSize(){
        return 'modal-lg';
    }    
}
