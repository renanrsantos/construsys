<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
/**
 * Description of FaseobraController
 *
 * @author Renan Rodrigues
 */
class FaseobraController extends Controller{
    
    protected function getColumns() {
        return [
        ];
    }

    protected function getFilters() {
        return [
        ];
    }
    
    protected function getTitulo() {
        return 'Fases da Obra';
    }

}
