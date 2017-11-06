<?php

namespace App\Http\Controllers\Cadastros;

use App\Http\Controllers\Controller;

class ProdutoController extends Controller{
    
    protected function getColumns() {
        return [
            ['name'=>'idproduto','label'=>'Código','width'=>'5'],
            ['name'=>'prddescricao','label'=>'Descrição','width'=>'55','type'=>'string','length'=>'80'],
            ['name'=>'unidadeMedida,unmsigla','label'=>'Un. Medida','width'=>'15'],
            ['name'=>'prdvalorunitario','label'=>'Valor Unitário','width'=>'15','type'=>'decimal'],
        ];
    }

    protected function getFilters() {
        return [
                ['value'=>'idproduto','label'=>'Código','type'=>'int','data-column'=>1],
                ['value'=>'prddescricao','label'=>'Descrição','type'=>'string','data-column'=>2],
            ];
    }
        
    protected function getTitulo() {
        return 'Produtos';
    }
    
    protected function getModalSize() {
        return 'modal-lg';
    }

}
