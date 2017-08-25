<?php

namespace App\Http\Controllers\Estrutura;

use App\Http\Controllers\Controller;

class SistemaController extends Controller{
    
    protected function getColumns() {
        return [
                ['name'=>'idsistema','label'=>'Código','width'=>'10'],
                ['name'=>'sisnome','label'=>'Nome','width'=>'30'],
                ['name'=>'sispath','label'=>'Path','width'=>'30'],
                ['name'=>'sisicone','label'=>'Ícone','width'=>'15'],
            ];
    }

    protected function getFilters() {
        return [
                ['name'=>'idsistema','label'=>'Código','type'=>'int'],
                ['name'=>'sisnome','label'=>'Nome','type'=>'string'],
            ];
    }

}
