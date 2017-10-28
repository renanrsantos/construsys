<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;

class SubcategoriaprodutoController extends Controller{
    
    protected function getColumns() {
        return [
            ['name'=>'idsubcategoriaproduto','label'=>'Código','width'=>'5'],
            ['name'=>'sbcdescricao','label'=>'Descrição','width'=>'90'],                  
        ];
    }

    protected function getFilters() {
        return [
                ['value'=>'idsubcategoriaproduto','label'=>'Código','type'=>'int','data-column'=>1],
                ['value'=>'sbcdescricao','label'=>'Descrição','type'=>'string','data-column'=>2],
            ];
    }
    protected function getTitulo() {
        return 'Sub Categoria dos Produtos';
    }
    
    protected function getModalSize() {
        return 'modal-md';
    }

}
