<?php


namespace App\Http\Controllers\Estrutura;

use App\Http\Controllers\Controller;

class ModuloinstaladoController extends Controller{
    
    protected function getColumns() {
        return [
                ['name'=>'entidade,pessoa,pesnome','label'=>'Empresa','width'=>'30'],                
                ['name'=>'modulo,idmodulo','label'=>'Cód. Módulo','width'=>'10'],
                ['name'=>'modulo,modnome','label'=>'Módulo','width'=>'15'],
                ['name'=>'mdiativo','label'=>'Ativo','width'=>'5'],
            ];        
    }

    protected function getFilters() {
        return [
            ['value'=>'modulo,idmodulo','label'=>'Cód. Módulo','type'=>'int','data-column'=>2],
            ['value'=>'mdiativo','label'=>'Ativo','type'=>'boolean','data-column'=>4],            
        ];
    }
    protected function getRecords() {
        $records = parent::getRecords();
        $records = $records->where('identidade',$this->entidade);
        return $records;
    }
    
    protected function getTitulo() {
        return 'Módulos Instalados';
    }

}
