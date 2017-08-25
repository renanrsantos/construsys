<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;

class UnidademedidaController extends Controller{
    
    protected function getColumns() {
        return [
            ['name'=>'idunidademedida','label'=>'Código','width'=>'5'],
            ['name'=>'unmsigla','label'=>'Sigla','width'=>'20'],
            ['name'=>'unmdescricao','label'=>'Descrição','width'=>'85'],                    
//            ['name'=>'pesrgie','label'=>'RG / IE','width'=>'20'],                    
        ];
    }

    protected function getFilters() {
        return [
                ['value'=>'idunidademedida','label'=>'Código','type'=>'int','data-column'=>1],
                ['value'=>'unmsigla','label'=>'Sigla','type'=>'string','data-column'=>2],
                ['value'=>'unmdescricao','label'=>'Descrição','type'=>'string','data-column'=>3],
            ];
    }

}
