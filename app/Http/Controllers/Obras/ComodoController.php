<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
/**
 * Description of ComodoController
 *
 * @author Renan Rodrigues
 */
class ComodoController extends Controller{
    
    protected function getColumns() {
        return [
            ['name'=>'idcomodo','label'=>'Código','width'=>'5'],
            ['name'=>'comdescricao','label'=>'Cômodo','width'=>'50'],
            ['name'=>'tipoComodo,tconome','label'=>'Tipo','width'=>'30'],
            ['name'=>'comtamanho','label'=>'Tamanho','width'=>'10']
        ];
    }

    protected function getFilters() {
        return [
//            ['value'=>'idfase','label'=>'Código','type'=>'int','data-column'=>1],
//            ['value'=>'fsedescricao','label'=>'Fase','type'=>'string','data-column'=>2],
        ];
    }
    
    protected function getTitulo() {
        return 'Cômodos';
    }
    
    protected function getRecords() {
        return parent::getRecords()->where('idobra',$this->request->idobra);
    }

}
