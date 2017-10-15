<?php

namespace App\Http\Controllers\Estrutura;

use App\Http\Controllers\Controller;

class ModuloController extends Controller{
    
    protected function getColumns() {
        return [
                ['name'=>'idmodulo','label'=>'Código','width'=>'10'],
                ['name'=>'modnome','label'=>'Nome','width'=>'30'],
                ['name'=>'modpath','label'=>'Path','width'=>'30'],
                ['name'=>'modicone','label'=>'Ícone','width'=>'20'],
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'idmodulo','label'=>'Código','type'=>'int','data-column'=>1],
                ['value'=>'modnome','label'=>'Nome','type'=>'string','data-column'=>2],
            ];
        
    }

    protected function getBtns(){
        return [
                app('form')->button('Módulos Instalados',['icon'=>'fa fa-cogs','onclick'=>"window.location.href='".url($this->entidade.'/modulo/estrutura/rotina/moduloinstalado')."'",'color'=>'primary'])
            ];
    }
    
    protected function getTitulo() {
        return 'Módulos';
    }
    
    protected function getModalSize() {
        return 'modal-lg';
    }
}
