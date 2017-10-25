<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use App\Http\Models\Obras\Obra;

/**
 * Description of DependenciaObraController
 *
 * @author renan.santos
 */
abstract class DependenciaObraController extends Controller{
    
    private $obra;
    
    protected function getObra($acao = ''){
        if(is_null($this->obra)){
            $id = $acao === 'index' ? $this->request->id[0] : $this->request->idobra;
            $this->obra = $this->getModel()->obra ? $this->getModel()->obra : Obra::find($id);
        }
        return $this->obra;
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
    
    protected function getHeaderPai() {
        return '';
    }
    
    protected function getPropExtra($acao){
        $obra = $this->getObra($acao);
        switch ($acao) {
            case 'index':
            case 'novo':
                $disableAll = false;
                return compact('obra','disableAll');
            default:
                return array_merge(['obra'=>$obra],parent::getPropExtra($acao));
        }
    }
    
}
