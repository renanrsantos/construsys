<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;

class TipocomodoController extends Controller{
    
    protected function getColumns() {
        return [
                ['name'=>'idtipocomodo','label'=>'Código','width'=>'5'],
                ['name'=>'tconome','label'=>'Tipo','width'=>'85'],
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'idtipocomodo','label'=>'Código','type'=>'int','data-column'=>1],
                ['value'=>'tconome','label'=>'Tipo','type'=>'string','data-column'=>2],
            ];
    }
    protected function getTitulo() {
        return 'Tipos de Cômodo';
    }
}
