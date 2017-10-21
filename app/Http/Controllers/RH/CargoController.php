<?php

namespace App\Http\Controllers\RH;

/**
 * Description of CargoController
 *
 * @author renan.santos
 */
class CargoController extends \App\Http\Controllers\Controller{
    //put your code here
    protected function getColumns() {
        return [
            ['name'=>'idcargo','label'=>'Código','width'=>'5'],
            ['name'=>'carnome','label'=>'Cargo','width'=>'70']
        ];
    }

    protected function getFilters() {
        return [
            
        ];
    }

    protected function getTitulo() {
        return 'Cargos';
    }

}
