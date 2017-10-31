@extends('layouts.modal')

@section('header')
    Cômodo
@endsection

@section('body')

@php
    $obra = $obra ? $obra : $record->obra;
@endphp
{{Form::formGroup([
    Form::hidden('idcomodo',$record->idcomodo),
    Form::hidden('idobra',$obra->idobra),
    Html::col(
        Form::validate(
            Form::inputConsulta('obras','tipocomodo',[
                'value-id'=>$record->tipoComodo ? $record->idtipocomodo : '',
                'value'=>$record->tipoComodo ? $record->tipoComodo->tconome : '',
                'data-vindicate'=>'required'
            ])
        )
    ,'4'),
    Html::col(
        Form::validate(
            Form::text('comdescricao',$record->comdescricao,['data-vindicate'=>'required']),
            Form::label('comdescricao','Descrição')
        )
    ,'6'),
    Html::col(
        Form::validate(
            Form::text('comtamanho',$record->comtamanho,['data-vindicate'=>'required|format:decimal']),
            Form::label('comtamanho','Tam. (m²)')
        )
    ,'2')
  ])
}}
@endsection