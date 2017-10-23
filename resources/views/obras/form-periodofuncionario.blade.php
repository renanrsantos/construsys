@extends('layouts.modal')

@section('header')
    Período
@endsection

@section('body')
{{
    Form::formGroup([
        Form::hidden('idperiodofuncionario',$record->idperiodofuncionario),
        Form::hidden('idfuncionarioobra',$funcionarioObra->idfuncionarioobra),
        Html::col(
            Form::validate(
                Form::date('pefdatainicio',$record->pefdatainicio,['data-vindicate'=>'required|format:date']),
                Form::label('pefdatainicio','Data início')
            )
        ,'6'),
        Html::col(
            Form::validate(
                Form::date('pefdatafim',$record->pefdatafim,['data-vindicate'=>'format:date']),
                Form::label('pefdatafim','Data fim')
            )
        ,'6')        
    ])
}}
@endsection