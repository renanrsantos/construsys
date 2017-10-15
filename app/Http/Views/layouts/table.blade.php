@extends('layouts.app')

@section('content')
<div class="row">
    {{Form::open(array('url'=>Request::url(),'class'=>'form-inline'))}}
        <div class="form-group form-group-sm">
            <select name="campo-filtro[]" class="form-control">
                @foreach($filters as $filter)
                <option value="{{$filter['name']}}" type="{{$filter['type']}}">{{$filter['label']}}</option>
                @endforeach
            </select>
            <select name="operador-filtro[]" class="form-control">
                <option value="=">Igual</option>
                <option value="%%">Contém</option>
            </select>
            <input type="text" name="valor-filtro[]" class="form-control" placeholder="Pesquisar..."/>
            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-sm btn-info"><i class="fa fa-search">&nbsp;</i> Filtrar</button>
                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a><i class="fa fa-search-plus">&nbsp;</i> Adicionar Filtro</a></li>
                    <li><a><i class="fa fa-recycle">&nbsp;</i> Limpar Filtros</a></li>
                    <li><a><i class="fa fa-search-minus">&nbsp;</i> Excluir Filtros</a></li>
                </ul>
            </div>
        </div>
    {{Form::close()}}
</div>
&nbsp;
<div class="row">
    {{Form::open(array('url'=>Request::url(),'class'=>'form-horizontal','id'=>'form-registros'))}}
        <div class="form-group">
            <div class="btn-group btn-group-sm">
                <a href="{{url(Request::url().'/novo')}}" class="btn btn-primary"><i class="fa fa-plus" id="btn-incluir">&nbsp;</i> Inserir</a>
                <button type="button" class="btn btn-primary btn-alterar btn-single"><i class="fa fa-edit">&nbsp;</i> Alterar</button>
                <button type="button" class="btn btn-primary btn-exlcuir btn-multi"><i class="fa fa-remove">&nbsp;</i> Excluir</button>
                <button type="button" class="btn btn-primary btn-visualizar btn-single"><i class="fa fa-eye">&nbsp;</i> Visualizar</button>
            </div> 
        </div>
        <div class="form-group">
            <table class="table table-condensed table-striped table-bordered table-hover" style="background-color:white;">
                <tr style="background-color: #a4aaae;">
                    <th class="text-center" style="width: 5%;"><input type="checkbox" title="Selecionar todos" id="chk-all"/></th>
                    @foreach($columns as $column)
                        <th style="width: {{$column['width']}}%;">{{$column['label']}}</th>
                    @endforeach
                </tr>
                @foreach($records as $record)
                <tr>
                    <td class="text-center"><input class="chk-acao" name="id[]" type="checkbox" value="{{$record->getAttributeValue($record->getKeyName())}}"/></td>
                    @foreach($columns as $column)
                    <?php 
                        $name = $column['name']; 
                        if(is_array($name)){
                            $objeto = $record;
                            for($i=0; $i < count($name)-1; $i++){
                                $metodo = $name[$i];
                                $objeto = $objeto->$metodo();
                            }
                            $name = $name[count($name)-1];
                            $valor = $objeto->$name;
                        } else {
                            $valor = $record->$name;
                        }
                    ?>
                    <td>{{$valor}}</td>
                    @endforeach
                </tr>
                @endforeach
            </table>
        </div>
    {{Form::close()}}
</div>
@overwrite


