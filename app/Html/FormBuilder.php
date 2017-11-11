<?php

namespace App\Html;

use \Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Request;

class FormBuilder extends \Collective\Html\FormBuilder {

    /** @var \App\Html\HtmlBuilder */
    protected $html;

    private function getElementsAsString(array $elements) {
        $html = '';
        foreach ($elements as $element) {
            $html .= ($element instanceof HtmlString) ? $element->toHtml() : $element;
        }
        return $html;
    }

    public function input($type, $name, $value = null, $options = array()) {
        if(!isset($options['id'])){
            $options['id'] = $name;
        }
        if(isset($options['data-vindicate'])){
            $options['data-function'] = 'vindicate';
        }
        if (!in_array($type, ['checkbox', 'hidden', 'button'])) {
            $this->html->addClassAttributes($options, 'form-control form-control-sm');
            return parent::input($type, $name, $value, $options);
        }
        return parent::input($type, $name, $value, $options);
    }

    public function open(array $options = array(),$validator = false) {
        if($validator){
            $options['data-toggle'] = 'validator';
        }
        return parent::open($options);
    }

    public function text($name, $value = null, $options = array()) {
        return parent::text($name, $value, $options);
    }

    public function password($name, $value = null, $options = array()) {
        return $this->input('password',$name, $value, $options);
    }

    public function checkbox($name, $value = 1, $checked = null, $options = []) {
        $options['class'] = 'custom-control-input';
        $label = isset($options['label']) ? $options['label'] : '';
        $checkbox = parent::checkbox($name, $value, $checked, $options);
        $spanIndicator = $this->html->tag('span','',['class'=>'custom-control-indicator']);
        $spanLabel = $this->html->tag('span',$label,['class'=>'custom-control-description']);
        return $this->html->tag('label', $checkbox . $spanIndicator . $spanLabel,
                    ['class'=>'custom-control custom-checkbox']);
    }

    public function date($name, $value = null, $options = array()) {
        if(isset($options['data-vindicate'])){
            if(strpos($options['data-vindicate'],'format') < 0){
                $options['data-vindicate'] .= '|format:date';
            }
        } else {
            $options['data-vindicate'] = 'format:date';
        }
        return parent::date($name, $value, $options);
    }
    
    public function checkboxSimple($name, $value = 1, $checked = null, $options = []) {
        return parent::checkbox($name, $value, $checked, $options);
    }

    public function buttonGroup(array $btns,array $attributes = []){
        $htmlBtns = '';
        foreach($btns as $btn){
            $htmlBtns.= $btn;
        }
        $this->html->addClassAttributes($attributes, 'btn-group btn-group-sm');
        return $this->html->tag('div',$htmlBtns,$attributes);
    }
    
    public function button($value = null, $options = array()) {
        if (isset($options['icon'])) {
            $value = $this->html->icon($options['icon'],'') .' '. $value;
            unset($options['icon']);
        }
        if (!isset($options['color'])) {
            $options['color'] = 'secondary';
        }
        $this->html->addClassAttributes($options, 'btn btn-' . $options['color']);
        unset($options['color']);
        return parent::button($value, $options);
    }

    public function formGroup($elements = array(), $attributes = array(), $row = true) {
        if (count($elements) == 0) {
            return '';
        }
        $html = $this->getElementsAsString($elements);
        $classRow = ($row) ? ' row' : '';
        $this->html->addClassAttributes($attributes, 'form-group' . $classRow);
        return $this->html->tag('div', $html, $attributes);
    }
    
    public function validate($input,$label = '',$attributes = []){
        $this->html->addClassAttributes($attributes, 'input-validate');
        $feedback = $this->html->tag('small','',['class'=>'form-control-feedback']);
        if($label !== '' && strpos($input,'required') > 0){
            $label = str_replace('</label>', ' <span class="text-danger"><b>*</b></span></label>', $label);
        }
        return $this->html->tag('div',$label.$input.$feedback,$attributes);
    }
    
    public function label($name, $value = null, $options = array(), $escape_html = true) {
        $this->html->addClassAttributes($options, "control-label");
        return parent::label($name, $value, $options, $escape_html);
    }

    public function formRow($elements = []) {
        $html = $this->getElementsAsString($elements);
        return $this->html->tag('div', $html, ['class' => 'form-row']);
    }

    public function select($name, $list = [], $selected = null, array $selectAttributes = [], array $optionsAttributes = []) {
        $this->html->addClassAttributes($selectAttributes, 'form-control form-control-sm');
        if(isset($selectAttributes['data-vindicate'])){
            $selectAttributes['data-function'] = 'vindicate';
            if(strpos($selectAttributes['data-vindicate'], 'required') >= 0){
                $optionsAttributes[''] = ['selected','disabled'];
            }
        }
        if(!isset($selectAttributes['id'])){
            $selectAttributes['id'] = $name;
        }
        return parent::select($name, $list, $selected, $selectAttributes, $optionsAttributes);
    }
    
    public function textarea($name, $value = null, $options = array()) {
        $this->html->addClassAttributes($options,'form-control');  
        if(isset($options['data-vindicate'])){
            $options['data-function'] = 'vindicate';
        } 
        if(!isset($options['id'])){
            $options['id'] = $name;
        }
        return parent::textarea($name, $value, $options);
    }
    
    public function tableFilter($filters, $table) {
        $botaoFiltro = $this->splitButton([' Filtrar', ['id' => 'btn-filtrar', 'aria-controls' => $table]], [[$this->html->icon('fa fa-plus') . ' Adicionar Filtro', ['id' => 'add-filter', 'aria-controls' => '#filtro-' . $table]],
            [$this->html->icon('fa fa-close') . 'Remover Filtros', ['id' => 'remove-filter', 'aria-controls' => '#filtro-' . $table]],
            [$this->html->icon('fa fa-refresh') . 'Limpar Filtros', ['id' => 'reset-filter', 'aria-controls' => '#filtro-' . $table]]], 'info');
        $filters['options'] = array_merge([''=>''],$filters['options']);
        $filters['attributes'] = array_merge([''=>['selected','disabled']],$filters['attributes']);
        $inputsFiltro = $this->html->col($this->select('campo-filtro[]', $filters['options'], null, [], $filters['attributes']), 'auto campo-filtro').
            $this->html->col($this->select('operador-filtro[]', [], null, []), '2 operador-filtro').
            $this->html->col($this->input('text', 'valor-filtro[]', ''), '3 valor-filtro');
        
        $inputsFiltroExtra = $this->html->tag('div', $this->formRow([$inputsFiltro]), ['class' => 'sr-only', 'id' => 'filtro-padrao']);
        
        $inputsFiltro = $this->formRow([
            $inputsFiltro,
            $this->html->col($botaoFiltro,'1')
        ]);
        $form = $this->html->tag('form',$inputsFiltro,['id'=>'filtro-'.$table,'class'=>'table-filter','style'=>'width:70%;','data-toggle'=>'validator']);
        $script = '<script>$("#filtro-'.$table.'").vindicate("init");</script>';
        return $this->html->tag('div',$inputsFiltroExtra . $form . $script,['class'=>'table-filter-main','style'=>'width:100%;']);
    }

    public function splitButton(array $button, array $elements, $color = 'primary') {
        $this->html->addClassAttributes($button[1], 'btn-' . $color . ' btn-sm');
        $attributes = array_merge($button[1], ['icon' => 'fa fa-search']);
        $btn = $this->button($button[0], $attributes);
        $this->html->addClassAttributes($button[1], 'dropdown-toggle');
        $attributes = array_merge($button[1], ['data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false']);
        $attributes['id'] = '';
        $split = $this->button($this->html->tag('span', '', ['class' => 'caret']), $attributes);
        foreach ($elements as $element) {
            $this->html->addClassAttributes($element[1], 'dropdown-item');
            $list[] = $this->html->tag('a', $element[0], $element[1])->toHtml();
        }
        $elements = $this->html->ul($list, ['class' => 'dropdown-menu dropdown-menu-right']);
        $content = $btn . $split . $elements;
        return $this->html->tag('div', $content, ['class' => 'btn-group']);
    }

    private function formataCamposInputConsulta($campos) {
        $campos = explode(',', $campos);
        $retorno = [];
        foreach ($campos as $campo) {
            $retorno[] = '"' . str_replace('[]','\\\[\\\]', $campo) . '"';
        }
        return implode(',', $retorno);
    }

    public function mergeAttributesConsulta($attributes, $url, $search, $visible, $props, $propsAlt, $text, $textAlt, $placeholder) {
        return array_merge($attributes, ['data-data' => url($url),
            'data-focus-first-result' => 'true',
            'data-min-length' => '2',
            'data-search-contain' => 'true',
            'data-search-in' => '[' . $search . ']',
            'data-visible-properties' => '[' . $visible . ']',
            'data-properties' => '[' . $props . ']',
            'data-properties-alt' => '[' . str_replace('[]','\\\[\\\]', $propsAlt) . ']',
            'data-text-property' => '{' . str_replace('[]','\\\[\\\]', $text) . '}',
            'data-request-type' => 'get',
            'id' => $textAlt,
            'placeholder' => $placeholder,
            'class' => 'flexdatalist']);
    }

    public function inputConsulta(string $modulo, string $rotina, array $attributes = [], $consulta = null) {
        $model = app()->make('\\App\\Http\\Models\\' . ucfirst($modulo) . '\\' . ucfirst($rotina));
        $visible = $this->formataCamposInputConsulta($model->consulta['visible']);
        $search = $this->formataCamposInputConsulta($model->consulta['search']);
        $text = $model->consulta['text'];
        $textAlt = isset($consulta['text']) ? $consulta['text'] : $text;
        $id = isset($consulta['id']) ? $consulta['id'] : $model->getKeyName();
        $props = isset($consulta['props']) ? $this->formataCamposInputConsulta($consulta['props']) : $visible;
        $propsAlt = isset($consulta['propsAlt']) ? $this->formataCamposInputConsulta($consulta['propsAlt']) : str_replace($model->getKeyName(),$id,$props);
        $placeholder = isset($consulta['placeholder']) ? $consulta['placeholder'] : isset($model->consulta['placeholder']) ? $model->consulta['placeholder'] : 'Digite para pesquisar...';
        $label = isset($consulta['label']) ? $consulta['label'] : $model->consulta['label'];
        $labelText = $this->label($text,$label);
        $url = Request::segment(1) . '/modulo/' . $modulo . '/rotina/' . $rotina . '/data?datalist=true&campos=' . (isset($consulta['props']) ? $consulta['props'] : $model->consulta['visible']); //.'&_token='.csrf_token();
        if (!isset($attributes['readonly'])) {
            $attributes = $this->mergeAttributesConsulta($attributes, $url, $search, $visible, $props, $propsAlt, $text, $textAlt, $placeholder);
        }
        $readonly = in_array('readonly', $attributes) ? 'readonly' : '';
        $validado = in_array('readonly', $attributes) ? 'true' : 'false';
        if(!isset($attributes['data-main'])){
            $attributes['data-main'] = '.input-consulta';
            $attributesId['data-main'] = '.input-consulta';
        }
        $attributesId = ['campoId' => $model->getKeyName(), 'class' => 'flexdatalist-id', 'validado' => $validado, 'data-target' => '#' . $textAlt, $readonly,'data-main'=>$attributes['data-main']];
        if(isset($attributes['data-vindicate'])){
            $attributesId['data-vindicate'] = $attributes['data-vindicate']. '|format:numeric';
            if(strpos($attributes['data-vindicate'],'required') === 0){
                $attributes['data-vindicate'] = 'requiredField:'.$id;
            }
//            unset($attributes['data-vindicate']);
        } 
        $colId = isset($attributes['colid']) ? $attributes['colid'] : '2';
        $colText = isset($attributes['coltext']) ? $attributes['coltext'] : '10';
        $this->html->addClassAttributes($attributesId,'col-'.$colId);
        $this->html->addClassAttributes($attributes,'col-'.$colText);
        $inputId = $this->input('text', $id, $attributes['value-id'], $attributesId);
        $modalId = 'modal-consulta-fr-'.$modulo.'-'.$rotina.'-'.rand(1,999);
        $btnSearch = $this->button('',['class'=>'btn-input-consulta','data-url'=>url(Request::segment(1).'/modulo/'.$modulo.'/rotina/'.$rotina.'/model'),'color'=>'secondary','icon'=>'fa fa-search','tabindex'=>'-1','data-toggle'=>'modal','data-target'=>'#'.$modalId,'data-data'=>'camporetorno='.$id]);
        $modal = '<div class="modal fade mymodal modal-consulta" id="'.$modalId.'" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static"><div class="modal-dialog modal-xl" role="document"></div></div>';
        $modal .= '<script>$("#'.$modalId.'").appendTo($("#'.$modalId.'").closest(".modal"));</script>';
        return $this->toHtmlString($modal.$this->validate($this->inputAddon($inputId . $this->input('text', $textAlt, $attributes['value'], $attributes),$btnSearch,true,true),$labelText,['class'=>'input-consulta']));
    }

    public function dropdownButton($value, $items,$attributes = []){
        $attributes = array_merge($attributes,['data-toggle'=>'dropdown','aria-haspopup'=>'true','aria-expanded'=>'false']);
        $this->html->addClassAttributes($attributes,'dropdown-toggle btn-sm');
        $button = $this->button($value,$attributes);
        $dropdownButtons = '';
        foreach($items as $item => $attributesAux){
            $this->html->addClassAttributes($attributesAux,'dropdown-item');
            $dropdownButtons .= $this->html->tag('a',$item,$attributesAux);
        }

        return $this->html->tag('div',$button . $this->html->tag('div',$dropdownButtons,['class'=>'dropdown-menu']),['class'=>'dropdown']);
    }

    public function inputAddon($input,$addon,$direita = true,$btn = false){
        $addon = $this->html->tag('span',$addon,['class'=>$btn ? 'input-group-btn' : 'input-group-addon']);
        $input = $direita ? $input . $addon : $addon . $input;

        return $this->html->tag('div',$input,['class'=>'input-group input-group-sm']);
    }

}
