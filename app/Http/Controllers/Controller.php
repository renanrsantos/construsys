<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Models\Cadastros\Entidade;
use App\Http\Models\Estrutura\Moduloinstalado;
use App\Http\Models\Estrutura\Modulo;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Model;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /** @var Request */
    public $request;
    public $entidade;
    public $modulo;
    public $rotina;
//    public $acao;
    
    /** @var Model */
    private $model;

    public function __construct() {
        $this->entidade = self::getEntidade();
    }
    
    public static function entidadeAtiva($entidade){
        $modelEntidade = Entidade::find($entidade);
        return !(empty($modelEntidade));
    }
    
    public static function getModulosEntidade($entidade){
        return Moduloinstalado::where('identidade',$entidade)->orderBy('idmodulo');
    }
    
    public static function getModuloSelecionado(){
        $modulo = Request::segment(3);
        if($modulo){
            $modulo = Modulo::where('modpath','/'.$modulo)->first();
            if($modulo){
                return $modulo;
            }
        }
        return new Modulo();
    }
    
    public static function getEntidadePrincipal(){
        return 1;
    }
    
    private static function getEntidade(){
        $entidade = (int) Request::segment(1);
        if(!$entidade){
            return self::getEntidadePrincipal();
        }
        return $entidade;
    }
    
    protected abstract function getColumns();
    protected abstract function getFilters();
    
    protected function getClassModel(){
        return '\\App\\Http\\Models\\'.ucfirst($this->modulo).'\\'.  ucfirst($this->rotina);
    }
    
    protected function getCamposOrdenacao(){
        return $this->getModel()->getKeyName();
    }
    
    protected function getModel() {
        if(is_null($this->model)){
            $classModel = $this->getClassModel();
            $this->model = new $classModel();
        }
        return $this->model;
    }
    
    private function getUrl(){
        return $this->entidade.'/modulo/'.$this->modulo.'/rotina/'.$this->rotina;
    }
    
    protected function getRecords(){
        return $this->getModel()->orderBy($this->getCamposOrdenacao());
    }
    
    protected function getHeightTable(){
        $height = 355;
        foreach($this->getColumns() as $column){
            if(isset($column['grupo'])){
                $height = 325;
                break;
            }
        }
        return $height;
    }
    
    protected function getValueFromRecord($record,$column){
        if((!is_array($column)) && (strpos($column, ','))){
            $column = explode(',', $column);
        }
        if(is_array($column)){
            $objeto = $record;
            for($i=0; $i < count($column)-1; $i++){
                $relacao = $column[$i];
                $objeto = $objeto->$relacao;
            }
            $column = $column[count($column)-1];
            return $objeto->$column;
        }
        if ($record->getCampoAtivo() === $column){
            return $record->ativo();
        }
        return $record->$column;
    }
    
    protected function getRecordsDataTable(){
        $data = [];
        foreach($this->getRecords()->get() as $record){
            $row = [];
            $row[] = app('form')->checkboxSimple('id[]',$record->getAttributeValue($record->getKeyName()),null,['class'=>'chk-acao'])->toHtml();
            foreach ($this->getColumns() as $column) {
                $column = $column['name']; 
                $row[] = $this->getValueFromRecord($record, $column);
            }
            $data[] = $row;
        }
        return $data;
    }
    
    protected function getRecordsDataList($campos,$id){
        $data = [];
        $records = [];
        $campos = explode(',', $campos);
        $objetos = isset($this->getModel()->consulta['objetos']) ? $this->getModel()->consulta['objetos'] : [];
        if($id){
            $record = $this->getRecords()->find($id);
            if($record){
                $records[] = $record;
            }
        } else {
            $records = $this->getRecords()->get();
        }
        foreach($records as $record){
            $row = [];
            foreach($campos as $campo){
                $camposObj = isset($objetos[$campo]) ? $objetos[$campo].','.$campo : $campo;
                $row[$campo] = $this->getValueFromRecord($record, $camposObj);
            }
            $data[] = $row;
        }
        return $data;
    }
    
    protected function getColumnsDataTable(){
        $columns[] = app('html')->column('checkbox',app('form')->checkboxSimple('','',null,['id'=>'chk-all','title'=>'Selecionar todos'])->toHtml());
        $totalColunas = count($this->getColumns());
        $widthFixed = 100 / $totalColunas;
        foreach ($this->getColumns() as $column) {
            if((!is_array($column['name'])) && (strpos($column['name'], ','))){
                $column['name'] = explode(',', $column['name']);
            }
            if(is_array($column['name'])){
                $name = $column['name'][count($column['name'])-1];
            } else {
                $name = $column['name'];
            }
            $grupo = isset($column['grupo']) ? $column['grupo'] : '';
            $type = isset($column['type']) ? $column['type'] : 'text';
            $width = isset($column['width']) ? $column['width'].'%' : $widthFixed;
            $columns[] = app('html')->column($name,$column['label'],$type,$grupo,$width);
        }
        return $columns;
    }


    protected function getBtns(){
        return [];
    }

    public function index(){
        if(!$this->rotina){
            return self::view('home');
        }
        $filters = $this->getFilters();
        $btns = $this->getBtns();
        $ajax = false;
        $section = 'content';
        $scrollY = $this->getHeightTable();
        return self::view('layouts.table',compact('filters','btns','ajax','section','scrollY'));
    }
    
    public function novo(){
        $record = $this->getModel();
        $record->processaNovo();
        $acao = 'Inserir';
        return self::view($this->modulo.'.form-'.$this->rotina,compact('record','acao'));
    }
    
    public function alterar(){
        $id = $this->request->get('id');
        $record = $this->getModel()->find($id[0]);
        $acao = 'Alterar';
        return self::view($this->modulo.'.form-'.$this->rotina,compact('record','acao'));
    }
    
    public function visualizar(){
        $id = $this->request->get('id');
        $record = $this->getModel()->find($id[0]);
        $acao = 'Visualizar';
        return self::view($this->modulo.'.form-'.$this->rotina,compact('record','acao'));
    }
    
    public function data(){
        $arr = [];
        if($this->request->get('columns')){
            $arr['columns'] = app('html')->getTableHeader($this->getColumnsDataTable());
        }
        if($this->request->get('data')){
            $arr['data'] = $this->getRecordsDataTable();
        }
        if($this->request->get('datalist')){
            $campos = $this->request->get('campos');
            $id = $this->request->get($this->getModel()->getKeyName());
            $arr = $this->getRecordsDataList($campos,$id);
        }
        return Response::json($arr);
    }
    
    public function processaNovo(){
        $msgRelacao = "";
        try{
            DB::beginTransaction();
            $this->model = $this->getModel()->create($this->request->toArray());
            try{
                $this->processaNovoRelacao();
            } catch (\Exception $ex1) {
                $msgRelacao = "\n".'[Problema ao inserir o(s) registro(s) vinculado(s)]';
                throw new Exception($ex1->getMessage());
            }
            $response = $this->getResponseAsSuccess('Registro inserido com sucesso.');
            DB::commit();
        } catch (\Exception $ex2){
            DB::rollBack();
            $response = $this->getResponseAsError('[Problema ao inserir o registro]'.$msgRelacao, $ex2->getMessage());
        }
        return $response;
    }

    public function processaAlterar(){
        $msgRelacao = "";
        try{
            DB::beginTransaction();
            $id = $this->request->get($this->getModel()->getKeyName());
            $model = $this->getModel()->find($id);
            if(!$model){
                $msgRelacao .= "\n".'[Registro não encontrado]';
                throw new Exception();
            }
            $model->update($this->request->toArray());
            try{
                $this->processaAlterarRelacao();
            } catch (Exception $ex1) {
                $msgRelacao .= "\n" . '[Problema ao alterar o(s) registro(s) vinculado(s)]';
                throw new Exception($ex1->getMessage());
            }
            $response = $this->getResponseAsSuccess('Registro alterado com sucesso.');
            DB::commit();
        } catch (\Exception $ex2){
            DB::rollBack();
            $response = $this->getResponseAsError('[Problema ao alterar o registro]' . $msgRelacao,$ex2->getMessage());
        }
        return $response;    
    }
    
    public function excluir(){
        $msgRelacao = "";
        $rollback = false;
        try{
            DB::beginTransaction();
            $ids = $this->request->get('id');
            try{
                foreach ($ids as $id){
                    $this->model = $this->getModel()->find($id);
                    $this->excluirRelacao();
                }
            } catch (Exception $ex1) {
                $msgRelacao .= "\n" . '[Problema ao excluir o(s) registro(s) vinculado(s)]';
                DB::rollBack();
                $rollback = true;
                throw new Exception($ex1->getMessage());
            }
            $this->getModel()->destroy($ids);
            $response = $this->getResponseAsSuccess('Registro(s) excluído(s) com sucesso.');
            DB::commit();
        } catch (\Exception $ex2) {
            if(!$rollback){
                DB::rollBack();
            }
            $response = $this->getResponseAsError('[Problema ao excluir o(s) registro(s)]'.$msgRelacao,$ex2->getMessage());
        }
        return $response;
    }
    
    static function view($view = null, $data = [], $mergeData = []){
        $entidade = self::getEntidade();
        $data['modulosEntidade'] = self::getModulosEntidade($entidade)->get();
        $data['moduloSelecionado'] = self::getModuloSelecionado();
        $data['entidadeSelecionada'] = Entidade::find($entidade);
        $data['entidades'] = Entidade::where('identidade','<>',$entidade)->get();
        $data['auth'] = true;
        return view($view,$data,$mergeData);
    }
    
    protected function getResponseAsError($msg = '',$exception = '',$data = ''){
        if(config('app.debug')){
            $msg .= "\n" . $exception;
        }
        return Response::json(['status'=>'ERRO','data'=>$data,'msg'=>app('html')->alert($msg,'danger'),'redirect'=>url($this->getUrl())]);
    }
    
    protected function getResponseAsSuccess($msg = '',$data = ''){
        return Response::json(['status'=>'OK','data'=>$data,'msg'=>app('html')->alert($msg,'success'),'redirect'=>url($this->getUrl())]);
    }
    
    protected function processaAlterarRelacao(){
        // implementar caso haja registros filhos em uma mesma tela
    }
    
    protected function processaNovoRelacao(){
        // implementar caso haja registros filhos em uma mesma tela
    }
    
    protected function excluirRelacao(){
        // implementar caso haja registros filhos em uma mesma tela
    }
    
}