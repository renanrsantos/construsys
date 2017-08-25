@extends('layouts.modal')

@section('header')
Rotina
@endsection

@section('body')
    {{Form::formGroup([
        Form::text('idrotina',$record->idrotina,['required','readonly','label'=>'Rotina','size'=>'sm']),
        Form::text('rotnome',$record->rotnome,['required','label'=>'','size'=>'md'])
    ])}}
    {{Form::formGroup([
        Form::inputConsulta('estrutura','modulo',['required',
            'value-id'=>$record->modulo ? $record->modulo->idmodulo : '',
            'value'=>$record->modulo ? $record->modulo->modnome : ''],true)
    ])}}
    {{Form::formGroup([
        Form::text('rotpath',$record->rotpath,['required','label'=>'Path','size'=>'md1'])
    ])}}
    {{Form::formGroup([
    Form::text('roticone',$record->roticone,['label'=>'Ícone','size'=>'md1'])        
    ])}}
@endsection