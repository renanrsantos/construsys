@extends('layouts.modal')

@section('header')
Sub Rotina
@endsection

@section('body')
    {{Form::formGroup([
        Form::text('idsubrotina',$record->idsubrotina,['required','readonly','label'=>'Sub Rotina','size'=>'sm']),
        Form::text('sbrnome',$record->sbrnome,['required','label'=>'','size'=>'md'])
    ])}}
    {{Form::formGroup([
        Form::inputConsulta('estrutura','rotina',['required',
            'value-id'=>$record->rotina ? $record->rotina->idrotina : '',
            'value'=>$record->rotina ? $record->rotina->rotnome : ''])
    ])}}
    {{Form::formGroup([
        Form::text('sbrpath',$record->sbrpath,['required','label'=>'Path','size'=>'md1'])
    ])}}
    {{Form::formGroup([
    Form::text('sbricone',$record->sbricone,['label'=>'Ícone','size'=>'md1'])        
    ])}}
@endsection