@extends('layouts.app')

@section('content')
    {{Form::open(array('url'=>Request::url(),'class'=>'form-horizontal'))}}
    <div class="form-group">
        <label for="idsistema" class="control-label">Código</label>
        {{Form::text('idsistema',$record->idsistema,['class'=>'form-control','required'=>'true','readonly'=>'true'])}}
    </div>
    <div class="form-group">
        <label for="sisnome" class="control-label">Nome</label>
        {{Form::text('sisnome',$record->sisnome,['class'=>'form-control','required'=>'true'])}}
    </div>
    <div class="form-group">
        <label for="sispath" class="control-label">Path</label>
        {{Form::text('sispath',$record->sispath,['class'=>'form-control','required'=>'true'])}}
    </div>
    <div class="form-group">
        <label for="sisicone" class="control-label">Ícone</label>
        {{Form::text('sisicone',$record->sisicone,['class'=>'form-control'])}}
    </div>
    @include('layouts.buttons-form')
    {{Form::close()}}
@endsection