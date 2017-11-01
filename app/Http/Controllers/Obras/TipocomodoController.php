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
            ['value'=>'idtipocomodo','label'=>'Código','type'=>'int'],
            ['value'=>'tconome','label'=>'Tipo','type'=>'string'],
        ];
    }
    protected function getTitulo() {
        return 'Tipos de Cômodo';
    }
    
    public function getModalSize() {
        return 'modal-md';
    }
}
