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
            Form::inputConsulta('obras','fase',[
                'value-id'=>$record ? $record->idfase : '',
                'value'=>$record->fase ? $record->fase->fsedescricao : '',
                'data-vindicate'=>'required'
            ])
        )
    ,'6'),
    Html::col(
        Form::validate(
            Form::date('fsodatainicio',$record->fsodatainicio,['data-vindicate'=>'required']),
            Form::label('fsodatainicio','Data início')
        )
    ,'3'),
    Html::col(
        Form::validate(
            Form::date('fsodataprevistafim',$record->fsodataprevistafim,['data-vindicate'=>'function:validaDataFaseObra(this)']),
            Form::label('fsodataprevistafim','Data prev. fim')
        )
    ,'3')
])
}}
{{
Form::formGroup([
    Html::col(
    	Form::validate(
    		Form::textarea('fsoobservacao',$record->fsoobservacao,['rows'=>2]),
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