@extends('layouts.modal')

@section('header')
Rotina
@endsection

@section('body')
    {{Form::hidden('idrotina',$record->idrotina)}}
    {{Form::formGroup([
        Html::col(
            Form::inputConsulta('estrutura','modulo',['data-vindicate'=>'required|format:numeric',
                'value-id'=>$record->modulo ? $record->modulo->idmodulo : '',
                'value'=>$record->modulo ? $record->modulo->modnome : ''],true)
        ,'12')    
    ])}}
    {{Form::formGroup([
        Html::col(
            Form::validate(Form::text('rotnome',$record->rotnome,["data-vindicate"=>"required|format:alpha"]),
                Form::label('rotnome','Nome'))
        ,'4'),
        Html::col(
            Form::validate(Form::text('rotpath',$record->rotpath,[]),
                Form::label('rotpath','Caminho Execução'))
        ,'5'),
        Html::col(
            Form::validate(Form::text('roticone',$record->roticone),
                Form::label('roticone','Ícone'))
        ,'3')
    ])}}
@endsection