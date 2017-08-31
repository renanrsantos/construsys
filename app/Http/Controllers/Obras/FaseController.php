<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
/**
 * Description of FaseController
 *
 * @author Renan Rodrigues
 */
class FaseController extends Controller{
    
    protected function getColumns() {
        return [
            ['name'=>'idfase','label'=>'Código','width'=>'5'],
            ['name'=>'fsedescricao','label'=>'Fase','width'=>'85'],
        ];
    }

    protected function getFilters() {
        return [
            ['value'=>'idfase','label'=>'Código','type'=>'int','data-column'=>1],
            ['value'=>'fsedescricao','label'=>'Fase','type'=>'string','data-column'=>2],
        ];
    }
    
    protected function getTitulo() {
        return 'Fases da Obra';
    }

}
