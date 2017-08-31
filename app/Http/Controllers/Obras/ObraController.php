<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
/**
 * Description of Obra
 *
 * @author Renan Rodrigues
 */
class ObraController extends Controller{
    
    protected function getColumns() {
        return [
                ['name'=>'idobra','label'=>'Código','width'=>'5'],
                ['name'=>'obrdescricao','label'=>'Obra','width'=>'30'],
                ['name'=>'cliente,pessoa,pesnome','label'=>'Cliente','width'=>'15'],
                ['name'=>'endereco','label'=>'Endereço','width'=>'10'],
                ['name'=>'obrtamanho','label'=>'Tamanho','width'=>'10']
            ];
    }

    protected function getFilters() {
        return [
                ['value'=>'idobra','label'=>'Código','type'=>'int','data-column'=>1],
                ['value'=>'cliente,pessoa,pesnome','label'=>'Cliente','type'=>'string','data-column'=>3],
                ['value'=>'endereco','label'=>'Endereço','type'=>'string','data-column'=>4]
            ];
    }
    
    protected function getTitulo() {
        return 'Obras';
    }

}
