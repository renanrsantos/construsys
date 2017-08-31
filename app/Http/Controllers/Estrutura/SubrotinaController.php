<?php

namespace App\Http\Controllers\Estrutura;

use App\Http\Controllers\Controller;

class SubrotinaController extends Controller{
    
    protected function getColumns() {
        return [
                ['name'=>'rotina,modulo,idmodulo','label'=>'Código','width'=>5,'grupo'=>'Módulo'],
                ['name'=>'rotina,modulo,modnome','label'=>'Nome','width'=>15,'grupo'=>'Módulo'],
                ['name'=>'rotina,idrotina','label'=>'Código','width'=>5,'grupo'=>'Rotina'],
                ['name'=>'rotina,rotnome','label'=>'Nome','width'=>15,'grupo'=>'Rotina'],
                ['name'=>'idsubrotina','label'=>'Código','width'=>5,'grupo'=>'Subrotina'],
                ['name'=>'sbrnome','label'=>'Nome','width'=>20,'grupo'=>'Subrotina'],
                ['name'=>'sbrpath','label'=>'Path','width'=>20,'grupo'=>'Subrotina'],
                ['name'=>'sbricone','label'=>'Ícone','width'=>15,'grupo'=>'Subrotina'] 
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'rotina,modulo,idmodulo','label'=>'Cód. Módulo','type'=>'int','data-column'=>3],
                ['value'=>'rotina,modulo,modnome','label'=>'Módulo','type'=>'string','data-column'=>4],
                ['value'=>'rotina,idrotina','label'=>'Cód. Rotina','type'=>'int','data-column'=>3],
                ['value'=>'rotina,rotnome','label'=>'Rotina','type'=>'string','data-column'=>4],
                ['value'=>'idsubrotina','label'=>'Cód. Subrotina','type'=>'int','data-column'=>5],
                ['value'=>'sbrnome','label'=>'Subrotina','type'=>'string','data-column'=>6],
            ];
    }
    protected function getTitulo() {
        return 'Sub rotinas';
    }
}