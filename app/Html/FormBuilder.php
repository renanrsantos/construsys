<?php

namespace App\Html;
use \Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Request;

class FormBuilder extends \Collective\Html\FormBuilder{
    
    /** @var \App\Html\HtmlBuilder */
    protected $html;
    
protected function formatSizeInput($size){
        switch($size){
            case 'xs':
                return 'col-md-1';
            case 'sm':
                return 'col-md-2';
            case 'sm1':
                return 'col-md-3';
            case 'md':
                return 'col-md-4';
            case 'md1':
                return 'col-md-5';
            case 'md2':
                return 'col-md-6';
            case 'lg':
                return 'col-md-8';
            case 'lg1':
                return 'col-md-10';
            case 'xl':
                return 'col-md-12';
            default :
                return 'col-md-12';
        }
    }
    
    public function input($type, $name, $value = null, $options = array()) {
        $label = '';
        $input = parent::input($type, $name, $value, $options);
        if(!in_array($type, ['checkbox','hidden','button'])){
            $this->html->addClassAttributes($options,'form-control input-sm');
            if(!isset($options['label'])){
                $options['label'] = $this->html->nbsp();
            }
            if($options['label'] != ''){
                $label = $this->label($name,$options['label'],['class'=>'col-md-3 control-label']);
            }
            if(!isset($options['size'])){
                $options['size'] = 'md2';
            }
            $input = $this->html->tag('div',parent::input($type, $name, $value, $options),['class'=>$this->formatSizeInput($options['size'])]);
        }
        
        return $this->toHtmlString($label . $input);
    }
    
    public function open(array $options = array()) {
        $options['data-toggle'] = 'validator';
        return $this->toHtmlString(parent::open($options) . $this->hidden('redirect',Request::url()));
    }
    
    public function text($name, $value = null, $options = array()) {
        return parent::text($name, $value, $options);
    }
    
    public function password($name, $value = null, $options = array()){
        return parent::password($name,$value,$options);
    }
    
    public function checkbox($name, $value = 1, $checked = null, $options = []){
        $label = '';
        if(isset($options['label'])){
            $label = $this->html->tag('strong',$options['label']);
            unset($options['label']);
        }
        $checkbox = parent::checkbox($name, $value, $checked, $options);
        if($label){
            $checkbox = $this->html->tag('label',$checkbox . ' ' . $label);
        }
        return $this->html->tag('div',$checkbox/*,['class'=>'checkbox col-md-offset-2']*/);
    }

    public function checkboxSimple($name, $value = 1, $checked = null, $options = []){
        return parent::checkbox($name,$value,$checked,$options);
    }
    
    public function button($value = null, $options = array()) {
        if(isset($options['icon'])){
            $value = $this->html->icon($options['icon']) . $value;
            unset($options['icon']);
        }
        if(!isset($options['color'])){
            $options['color'] = 'secondary';
        }
        $this->html->addClassAttributes($options, 'btn btn-'.$options['color']);
        unset($options['color']);
        return parent::button($value, $options);
    }

    public function formGroup($elements = array(), $attributes = array(), $row = true, $validator = true){
        if(count($elements) == 0){
            return '';
        }
        $html = '';
        foreach($elements as $element){
            $html .= ($element instanceof HtmlString) ? $element->toHtml() : $element;
        }
        $classRow = ($row) ? ' row' : '';
        $this->html->addClassAttributes($attributes,'form-group' . $classRow);
        if($validator){
//            $this->html->addClassAttributes($attributes,'has-feedback');
//            $html .= $this->html->tag('span', '',['class'=>'glyphicon form-control-feedback','aria-hiden'=>'true']);
            $html .= $this->html->tag('div', '',['class'=>'col-md-12 col-md-offset-3 help-block with-errors']);
        }
        return $this->html->tag('div', $html, $attributes);
    }
    
    public function select($name, $list = [], $selected = null,
            array $selectAttributes = [], array $optionsAttributes = [])  {
        $this->html->addClassAttributes($selectAttributes, 'form-control ');
        $label = "";
        if(isset($selectAttributes['label'])){
            $label = $this->label($name,$selectAttributes['label'],['class'=>'col-md-3 control-label']);
        }
        $listAlt = [];
        foreach($list as $item){
            $value = $item['value'];
            $listAlt[$value] = $item['label'];
            unset($item['value']);
            unset($item['label']);
            $optionsAttributes[$value] = $item;
        }
        $select = parent::select($name, $listAlt, $selected, $selectAttributes, $optionsAttributes);
        if(isset($selectAttributes['size'])){
            $select = $this->html->tag('div',$select, ['class'=>$this->formatSizeInput($selectAttributes['size'])]);
        }
        return $this->toHtmlString($label . $select); 
    }
    
//     public function getSelectOption($display,$value, $selected,array $attributes = []) {
//         return $this->html->tag('option', $display['label'],$display);
//     }
    
    public function getOperadoresFiltro(){
        $operadores[] = ['value'=>'=','label'=>'Igual'];
        $operadores[] = ['value'=>'<>','label'=>'Diferente'];
        $operadores[] = ['value'=>'%%','label'=>'Contém'];
        return $operadores;
    }
    
    public function tableFilter($filters,$table){
        $pattern = $this->formGroup([
            $this->select('campo-filtro',$filters,null,['class'=>'input-sm','style'=>'width:100px;']),
            $this->select('operador-filtro',$this->getOperadoresFiltro(),null,['class'=>'input-sm','style'=>'width:100px;']),
            $this->html->tag('input','',['placeholder'=>'Pesquisar...','name'=>'valor-filtro','class'=>'form-control input-sm','style'=>'width:200px;'])
        ],[],false,false);
        $return[] = $this->html->tag('div',$this->html->tag('div',$pattern,['class'=>'row']),['class'=>'sr-only','id'=>'filtro-padrao']);
        $return[] = '<form class="form-inline" id="filtro-'.$table.'">';
        $return[] = $this->formGroup([
            $pattern,
            $this->splitButton(['Filtrar',['id'=>'btn-filtrar','aria-controls'=>$table]],
                    [[$this->html->icon('fa fa-plus').'Adicionar Filtro',['id'=>'add-filter','aria-controls'=>'#filtro-'.$table]],
                     [$this->html->icon('fa fa-close').'Remover Filtros',['id'=>'remove-filter','aria-controls'=>'#filtro-'.$table]],
                     [$this->html->icon('fa fa-refresh').'Limpar Filtros',['id'=>'reset-filter','aria-controls'=>'#filtro-'.$table]]],'info')
        ],[],true,false);
        $return[] = '</form>';
        return $this->toHtmlString(implode('', $return));
    }
       
    public function splitButton(array $button, array $elements, string $color = 'primary'){
        $this->html->addClassAttributes($button[1], 'btn-'.$color.' btn-sm');
        $attributes = array_merge($button[1],['icon'=>'fa fa-search']);
        $btn = $this->button($button[0],$attributes);
        $this->html->addClassAttributes($button[1], 'dropdown-toggle');
        $attributes = array_merge($button[1],['data-toggle'=>'dropdown','aria-haspopup'=>'true','aria-expanded'=>'false']);
        $attributes['id'] = '';
        $split = $this->button($this->html->tag('span','',['class'=>'caret']),$attributes);
        foreach($elements as $element){
            $this->html->addClassAttributes($element[1], 'dropdown-item');
            $list[] = $this->html->tag('a',$element[0],$element[1])->toHtml();
        }
        $elements = $this->html->ul($list,['class'=>'dropdown-menu']);
        $content = $btn . $split . $elements;
        return $this->html->tag('div',$content,['class'=>'btn-group']);
    }
    
    private function formataCamposInputConsulta($campos){
        $campos = explode(',', $campos);
        $retorno = [];
        foreach($campos as $campo){
            $retorno[] = '"'.$campo.'"';
        }
        return implode(',', $retorno);
    }
    
    public function mergeAttributesConsulta($attributes, $url,$search,$visible,$visibleAlt,$text,$textAlt,$placeholder){
        return array_merge($attributes,['data-data'=> url($url), 
                            'data-focus-first-result'=>'true',
                            'data-min-length'=>'2',
                            'data-search-contain'=>'true',
                            'data-search-in'=>'['.$search.']',
                            'data-visible-properties'=>'['.$visible.']',
                            'data-visible-properties-alt'=>'['.$visibleAlt.']',
                            'data-text-property'=>'{'.$text.'}',
                            'data-request-type'=>'get',
                            'size'=>'md',
                            'label'=>'',
                            'id'=>$textAlt,
                            'placeholder'=>$placeholder,
                            'class'=>'flexdatalist']);
    }
    
    public function inputConsulta(string $modulo, string $rotina, array $attributes,$required = true,$consulta = null){
        $model = app()->make('\\App\\Http\\Models\\'. ucfirst($modulo).'\\'.ucfirst($rotina));
        $visible = $this->formataCamposInputConsulta($model->consulta['visible']);
        $search = $this->formataCamposInputConsulta($model->consulta['search']);
        $text = $model->consulta['text'];
        $textAlt = isset($consulta['text']) ? $consulta['text'] : $text;
        $visibleAlt = isset($consulta['visible']) ? $this->formataCamposInputConsulta($consulta['visible']) : $visible;
        $placeholder = isset($consulta['placeholder']) ? $consulta['placeholder'] : isset($model->consulta['placeholder']) ? $model->consulta['placeholder'] : 'Digite para pesquisar...';
        $id = isset($consulta['id']) ? $consulta['id'] : $model->getKeyName();
        $label = $model->consulta['label'];
        $url = Request::segment(1).'/modulo/'.$modulo.'/rotina/'.$rotina.'/data?datalist=true&campos='.$model->consulta['visible'];//.'&_token='.csrf_token();
        if(!isset($attributes['readonly'])){
            $attributes = $this->mergeAttributesConsulta($attributes, $url,$search,$visible,$visibleAlt,$text,$textAlt,$placeholder);
        }
        $readonly = in_array('readonly',$attributes) ? 'readonly' : '';
        $validado = in_array('readonly',$attributes) ? 'true' : 'false';
        $attributesId = ['campoId'=>$model->getKeyName(),'class'=>'flexdatalist-id','label'=>$label,'size'=>'sm','validado'=>$validado,'data-target'=>'#'.$textAlt,$readonly];
        if($required){
            $attributesId['required'] = '';
        }
        unset($attributes[0]);
        $inputId = $this->input('text',$id,$attributes['value-id'],$attributesId);
        $inputText = $this->input('text', $textAlt, $attributes['value'],$attributes);
        return $this->toHtmlString($inputId.$inputText);
    } 
    
    public function textarea($name, $value = null, $options = array()) {
        parent::textarea($name, $value, $options);
    }

}
