@extends('layouts.modal')

@section('header')
    Fase da Obra
@endsection

@section('body')
@php
    $obra = $obra ? $obra : $record->obra;
@endphp
{{
Form::formGroup([
    Form::hidden('idfaseobra',$record->idfaseobra),
    Form::hidden('idobra',$obra->idobra),
    Html::col(
    	Form::validate(
    		Form::select('idfase',App\Http\Models\Obras\Fase::getFases(),$record->idfase,['data-vindicate'=>'required']),
    		Form::label('idfase','Fase')
    	)
    ,'4'),
    Html::col(
        Form::validate(
            Form::date('fsodatainicio',$record->fsodatainicio,['data-vindicate'=>'required']),
            Form::label('fsodatainicio','Data início')
        )
    ,'4'),
    Html::col(
        Form::validate(
            Form::date('fsodataprevistafim',$record->fsodataprevistafim),
            Form::label('fsodataprevistafim','Data prev. fim')
        )
    ,'4')
])
}}
{{
Form::formGroup([
    Html::col(
    	Form::validate(
    		Form::text('fsoobservacao',$record->fsoobservacao),
    		Form::label('fsoobservacao','Observação')
    	)
    ,'8'),
    Html::col(
    	Form::validate(
    		Form::select('fsostatus',App\Http\Models\Obras\Faseobra::getStatusFase(),$record->fsostatus),
    		Form::label('fsostatus','Status')
    	)
    ,'4')
  ])
}}
@endsection