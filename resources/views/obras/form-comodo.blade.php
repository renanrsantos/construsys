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
            Form::select('idtipocomodo',App\Http\Models\Obras\Tipocomodo::getTiposComodo(),$record->idtipocomodo,['data-vindicate'=>'required']),
            Form::label('idtipocomodo','Tipo')
        )
    ,'2'),
    Html::col(
        Form::validate(
            Form::text('comdescricao',$record->comdescricao,['data-vindicate'=>'required']),
            Form::label('comdescricao','Descrição')
        )
    ,'8'),
    Html::col(
        Form::validate(
            Form::text('comtamanho',$record->comtamanho,['data-vindicate'=>'required|format:decimal']),
            Form::label('comtamanho','Tamanho (m²)')
        )
    ,'2')
  ])
}}
@endsection