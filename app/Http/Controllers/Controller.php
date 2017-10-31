<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Models\Cadastros\Entidade;
use App\Http\Models\Estrutura\Moduloinstalado;
use App\Http\Models\Estrutura\Modulo;
use App\Http\Models\Estrutura\Rotina;
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
    protected $model;

    protected $id;
    
    private $camposFiltro;
    private $operadoresFiltro;
    private $valoresFiltro;
    
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
    
    public static function getRotina(){
        $rotina = Request::segment(5);
        if($rotina){
            $subrotina = self::getSubrotina();
            if($subrotina){
                return $subrotina->rotina;
            }
            $rotina = Rotina::where('rotpath','/'.$rotina)
                        ->where('idmodulo',self::getModuloSelecionado()->idmodulo)->first();
            return $rotina;
        }
        return new Rotina();
    }
    
    public static function getSubrotina(){
        $subrotina = Request::segment(5);
        if($subrotina){
            $rotinas = Rotina::where('idmodulo',self::getModuloSelecionado()->idmodulo)->get();
            foreach($rotinas as $rotina){
                foreach($rotina->subrotinas as $subrotinaAlt){
                    if($subrotinaAlt->sbrpath === '/'.$subrotina){
                        return $subrotinaAlt;
                    }
                }
            }
        }
        return null;
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
    
    protected function getUrl($modulo = '',$rotina = ''){
        $modulo = $modulo ? $modulo : $this->modulo;
        $rotina = $rotina ? $rotina : $this->rotina;
        return $this->entidade.'/modulo/'.$modulo.'/rotina/'.$rotina;
    }
    
    private function formatFilters($filters){
        $filtersAux = ['options'=>[],'attributes'=>[]];
        foreach ($filters as $filter){
            $value = $filter['value'];
            $filtersAux['options'][$value] = $filter['label'];
            unset($filter['value']);
            unset($filter['label']);
            $filtersAux['attributes'][$value] = $filter;
        }
        return $filtersAux;
    }
    protected function getRecords(){
        return $this->getModel()->orderBy($this->getCamposOrdenacao());
    }
    
    protected function getHeightTable(){
        $height = 305;
        foreach($this->getColumns() as $column){
            if(isset($column['grupo'])){
                $height = 275;
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
        if (strpos($column,'()')){
            $column = str_replace('()', '', $column);
            return $record->$column();
        }
        return $record->$column;
    }
    
    private function getTipoFiltro($campo){
        foreach ($this->getFilters() as $filtro){
            if($filtro['value'] === $campo){
                return $filtro['type'];
            }
        }
    }
    
    private function formataValorFiltro(&$valor, &$valorFiltro,$tipo){
        switch($tipo){
            case 'string':
                $valor = mb_strtoupper($valor);
                $valorFiltro = mb_strtoupper($valorFiltro);
                break;
            case 'int':
                $valor = (int) $valor;
                $valorFiltro = (int) $valorFiltro;
                break;
            case 'boolean':
                $valor = (bool) $valor;
                $valorFiltro = (bool) $valorFiltro;
                break;
        }
    }
    
    private function comparaValorFiltro($valor, $valorFiltro, $operador){
        switch ($operador){
            case '=':
                return $valor == $valorFiltro;
            case '<>' :
                return $valor != $valorFiltro;
            case '%%' :
                return strpos($valor,$valorFiltro) > -1;
            case '%' :
                return strpos($valor,$valorFiltro) === 0;
            case '>' :
                return $valor > $valorFiltro;
            case '<' :
                return $valor < $valorFiltro;
        }
    }
    
    private function registroEncontrado($record){
        $retorno = true;
        if(is_array($this->valoresFiltro) && count($this->valoresFiltro) > 1){
            for($i=1; $i < count($this->valoresFiltro); $i++){
                $campo = $this->camposFiltro[$i];
                $operador = $this->operadoresFiltro[$i];
                $valorFiltro = $this->valoresFiltro[$i];
                if($valorFiltro){
                    $valor = $this->getValueFromRecord($record, $campo);
                    $this->formataValorFiltro($valor, $valorFiltro, $this->getTipoFiltro($campo));
                    $retorno = $this->comparaValorFiltro($valor, $valorFiltro, $operador);
                    if(!$retorno){
                        break;
                    }
                }
            }            
        }
        return $retorno;
    }
    
    protected function getRecordsDataTable(){
        $data = [];
        $this->camposFiltro = $this->request->get('campo-filtro');
        $this->operadoresFiltro = $this->request->get('operador-filtro');
        $this->valoresFiltro = $this->request->get('valor-filtro');
        foreach($this->getRecords()->get() as $record){
            if($this->registroEncontrado($record)){
                $row = [];
                $row[] = app('form')->checkboxSimple('id[]',$record->getKey(),null,['class'=>'chk-acao','data-valida-controller'=>$this->getValidaController($record)])->toHtml();
                foreach ($this->getColumns() as $column) {
                    $column = $column['name']; 
                    $value = $this->getValueFromRecord($record, $column);
                    $row[] = $value;
                }
                $data[] = $row;
            }
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
        $totalColunas = count($this->getColumns()) ? count($this->getColumns()) : 1;
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

    protected function getDataGantt(){
        return [];
    }
    
    protected function getBtns(){
        return [];
    }

    protected function getModalSize(){
        return '';
    }
    
    protected function getValidaController($record){
        return '';
    }

    protected abstract function getTitulo();
    
    protected function getPropExtra($acao){
        return [];
    }

    protected function getInputIdPai(){
        return null;
    }
    
    protected function getHeaderPai(){
        return '';
    }

    public function index(){
        if(!$this->rotina){
            return self::view('home');
        }
        $filters = $this->formatFilters($this->getFilters());
        $btns = $this->getBtns();
        $ajax = false;
        $section = 'content';
        $main = $this->indexAsModal() ? '' : 'main';
        $scrollY = $this->getHeightTable() - ($main ? 0 : 80);
        $titulo = $this->getTitulo();
        $modalSize = $this->getModalSize();
        $view = $this->indexAsModal() ? 'layouts.table-modal' : 'layouts.table-index';
        $acao = '';
        $inputId = null;
        $headerPai = '';
        if(!$main){
            $inputId = $this->getInputIdPai();
            $headerPai = $this->getHeaderPai();
        }
        return self::view($view,array_merge(compact('filters','btns','ajax','section','scrollY','titulo','modalSize','acao','main','inputId','headerPai'),$this->getPropExtra('index')));
    }
    
    public function novo(){
        $record = $this->getModel();
        $record->processaNovo();
        $acao = 'Inserir';
        $modalSize = $this->getModalSize();
        return self::view($this->modulo.'.form-'.$this->rotina,array_merge(compact('record','acao','modalSize'),$this->getPropExtra('novo')));
    }
    
    public function alterar(){
        $id = $this->request->get('id');
        $record = $this->getModel()->find($id[0]);
        $acao = 'Alterar';
        $modalSize = $this->getModalSize();
        return self::view($this->modulo.'.form-'.$this->rotina,array_merge(compact('record','acao','modalSize'),$this->getPropExtra('alterar')));
    }
    
    public function visualizar(){
        $id = $this->request->get('id');
        $record = $this->getModel()->find($id[0]);
        $acao = 'Visualizar';
        $modalSize = $this->getModalSize();
        return self::view($this->modulo.'.form-'.$this->rotina,array_merge(compact('record','acao','modalSize'),$this->getPropExtra('visualizar')));
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
        if($this->request->get('gantt')){
            $arr = $this->getDataGantt();
        }
        return Response::json($arr);
    }
    
    public function processaNovo(){
        $msgRelacao = "";
        try{
            DB::beginTransaction();
            $this->model = $this->getModel()->create($this->request->toArray());
            $this->id = $this->model->getKey();
            try{
                $this->processaNovoRelacao();
            } catch (\Exception $ex1) {
                $msgRelacao = "\n".'[Problema ao inserir o(s) registro(s) vinculado(s)]';
                throw new \Exception($ex1->getMessage());
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
            $this->model = $model;
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
        $data['rotina'] = self::getRotina();
        $data['subrotina'] = self::getSubrotina();
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
    
    protected function indexAsModal(){
        return false;
    }
    
    public function model(){
        $filters = $this->formatFilters($this->getFilters());
        $btns = [];
        $ajax = false;
        $section = 'content';
        $main = '';
        $scrollY = $this->getHeightTable() - ($main ? 0 : 80);
        $titulo = $this->getTitulo();
        $modalSize = 'modal-xl';
        $view = 'layouts.table-modal';
        $acao = '';
        $inputId = null;
        $headerPai = '';
        $urlAlt = str_replace('/model', '', $this->request->url());
        $consulta = app('form')->button('Selecionar',['color'=>'primary','icon'=>'fa fa-hand-o-up','class'=>'btn-single btn-seleciona','data-camporetorno'=>'#'.$this->request->get('camporetorno')]);
        return self::view($view,array_merge(compact('consulta','filters','btns','ajax','section','scrollY','titulo','modalSize','acao','main','inputId','headerPai','urlAlt'),$this->getPropExtra('index')));
    }
}