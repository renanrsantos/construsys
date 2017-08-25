@php
    $table = Request::segment(3).'-'.Request::segment(5);
@endphp

@extends('layouts.app')

@section('content')
{{Html::tag('div','',['class'=>'modal fade mymodal', 'id'=>'modal-fr-'.$table, 'tabindex'=>'-1','role'=>'dialog','data-keyboard'=>'false', 'data-backdrop'=>'static'])}}
{{Html::tag('div','',['id'=>'msg-global'])}}
<div class="row">
    {{Form::tableFilter($filters,$table)}}
</div><br>
<div class="row">
    {{Form::open(array('url'=>Request::url(),'class'=>'form-horizontal','id'=>'form-registros'))}}
        <div class="btn-group-from">
            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-primary" data-action="novo" data-toggle="modal" data-target="#modal-fr-{{$table}}"><i class="fa fa-plus">&nbsp;</i> Inserir</button>
                <button type="button" class="btn btn-primary btn-single" data-action="alterar" data-toggle="modal" data-target="#modal-fr-{{$table}}"><i class="fa fa-pencil">&nbsp;</i> Alterar</button>
                <button type="button" class="btn btn-primary btn-excluir btn-multi"><i class="fa fa-trash">&nbsp;</i> Excluir</button>
                <button type="button" class="btn btn-primary btn-single" data-action="visualizar" data-toggle="modal" data-target="#modal-fr-{{$table}}"><i class="fa fa-eye">&nbsp;</i> Visualizar</button>
            </div> 
            @if($btns)
            <div class="btn-group btn-group-sm">
                @foreach($btns as $btn)
                    <{{$btn['type']}} type="button" 
                        href="{{$btn['url']}}" 
                        class="btn btn-primary btn-extra {{$btn['type']}}">
                        <i class="fa fa-{{$btn['icon']}}">&nbsp;</i> 
                        {{$btn['label']}}
                    </{{$btn['type']}}>
                @endforeach
            </div>
            @endif
        </div>
        <div class="form-group">
            <table id="{{$table}}" scrollY="{{$scrollY}}" class="table table-bordered table-striped table-hover table-condensed" url="{{Request::url()}}/data"></table>
        </div>
    {{Form::close()}}
    <div class="minmaxCon" style="margin-bottom: 50px;"></div>
</div>
@overwrite


