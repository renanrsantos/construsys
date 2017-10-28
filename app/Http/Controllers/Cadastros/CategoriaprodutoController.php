<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;

class CategoriaprodutoController extends Controller{
    
    protected function getColumns() {
        return [
            ['name'=>'idcategoriaproduto','label'=>'Código','width'=>'5'],
            ['name'=>'catdescricao','label'=>'Descrição','width'=>'90'],                  
        ];
    }

    protected function getFilters() {
        return [
                ['value'=>'idcategoriaproduto','label'=>'Código','type'=>'int','data-column'=>1],
                ['value'=>'catdescricao','label'=>'Descrição','type'=>'string','data-column'=>2],
            ];
    }
    protected function getTitulo() {
        return 'Categoria dos Produtos';
    }
    
    protected function getModalSize() {
        return 'modal-md';
    }

}
