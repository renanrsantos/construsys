<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;

class CategoriaprodutoController extends Controller{
    
    protected function getColumns() {
        return [
            ['name'=>'idcategoriaproduto','label'=>'Código','width'=>'5'],
            ['name'=>'catdescricao','label'=>'Descrição','width'=>'90','type'=>'string','length'=>'200'],                  
        ];
    }

    protected function getFilters() {
        return [
            ['value'=>'idcategoriaproduto','label'=>'Código','type'=>'int'],
            ['value'=>'catdescricao','label'=>'Descrição','type'=>'string'],
        ];
    }
    protected function getTitulo() {
        return 'Categoria dos Produtos';
    }
    
    protected function getModalSize() {
        return 'modal-md';
    }

}
