@extends('layouts.app')
<?php
    $idsistema = '';
    $sisnome = '';
    if(!is_null($record->sistema())){
        $idsistema = $record->sistema()->idsistema;
        $sisnome = $record->sistema()->sisnome;
    }

?>

@section('content')
    {{Form::open(array('url'=>Request::url(),'class'=>'form-horizontal'))}}
    <div class="form-group">
        <label for="idsistema" class="control-label">Sistema</label>
        {{Form::text('idsistema',$idsistema,['class'=>'form-control','required'=>'true'])}}
    </div>
    <div class="form-group">
        <label for="sisnome" class="control-label">Nome Sistema</label>
        {{Form::text('sisnome',$sisnome,['class'=>'form-control'])}}
    </div>
    <div class="form-group">
        <label for="idrotina" class="control-label">Código</label>
        {{Form::text('idrotina',$record->idrotina,['class'=>'form-control','required'=>'true','readonly'=>'true'])}}
    </div>
    <div class="form-group">
        <label for="rotnome" class="control-label">Nome</label>
        {{Form::text('rotnome',$record->rotnome,['class'=>'form-control','required'=>'true'])}}
    </div>
    <div class="form-group">
        <label for="rotpath" class="control-label">Path</label>
        {{Form::text('rotpath',$record->rotpath,['class'=>'form-control','required'=>'true'])}}
    </div>
    <div class="form-group">
        <label for="roticone" class="control-label">Ícone</label>
        {{Form::text('roticone',$record->roticone,['class'=>'form-control'])}}
    </div>
    @include('layouts.buttons-form')
    {{Form::close()}}
@endsection