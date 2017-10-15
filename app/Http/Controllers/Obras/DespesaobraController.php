<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Models\Obras\Obra;


class DespesaobraController extends Controller{
    
    protected function getColumns() {
        return [
            ['name'=>'iddespesaobra','label'=>'Código','width'=>'5'],
            ['name'=>'dsoobs','label'=>'Descrição','width'=>'20'],
            ['name'=>'dsovalortotal','label'=>'Valor Total','width'=>'10'],
        ];
    }

    protected function getFilters() {
        return [
                ['value'=>'iddespesaobra','label'=>'Código','type'=>'int','data-column'=>1],
            ];
    }
    protected function getTitulo() {
        return 'Despesa da Obra';
    }

    protected function getModalSize(){
        return 'modal-lg';
    }

    protected function getPropExtra($acao){
        switch ($acao) {
            case 'index':
            case 'novo':
                $id = $this->request->idobra ? $this->request->idobra : $this->request->id[0];
                $obra = Obra::find($id);
                $disableAll = false;
                return compact('obra','disableAll');
            default:
                return array_merge(['obra'=>null],parent::getPropExtra($acao));
        }
    }

    protected function getRecords(){
        return parent::getRecords()->where('idobra',$this->request->idobra);
    }

    protected function indexAsModal(){
        return true;
    }

    protected function getInputIdPai(){
        return app('form')->hidden('idobra',$this->request->id[0]);
    }
}
