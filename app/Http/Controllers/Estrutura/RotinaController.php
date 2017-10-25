<?php

namespace App\Http\Controllers\Estrutura;

use App\Http\Controllers\Controller;

class RotinaController extends Controller{
    
    protected function getColumns() {
        return [
                ['name'=>['modulo','idmodulo'],'label'=>'Código','width'=>'10','grupo'=>'Módulo'],
                ['name'=>['modulo','modnome'],'label'=>'Nome','width'=>'25','grupo'=>'Módulo'],
                ['name'=>'idrotina','label'=>'Código','width'=>'10','grupo'=>'Rotina'],
                ['name'=>'rotnome','label'=>'Nome','width'=>'25','grupo'=>'Rotina'],
                ['name'=>'rotpath','label'=>'Path','width'=>'15','grupo'=>'Rotina'],
                ['name'=>'roticone','label'=>'Ícone','width'=>'15','grupo'=>'Rotina'],
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'modulo,idmodulo','label'=>'Cód. Módulo','type'=>'int','data-column'=>1],
                ['value'=>'modulo,modnome','label'=>'Módulo','type'=>'string','data-column'=>2],
                ['value'=>'idrotina','label'=>'Cód. Rotina','type'=>'int','data-column'=>3],
                ['value'=>'rotnome','label'=>'Rotina','type'=>'string','data-column'=>4],
            ];
    }
    
    protected function getTitulo() {
        return 'Rotinas';
    }
    
    protected function getModalSize() {
        return 'modal-lg';
    }

}
