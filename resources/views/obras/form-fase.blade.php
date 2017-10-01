@extends('layouts.modal')

@section('header')
    Fases da Obra
@endsection
@section('body')
    {{Form::hidden('idfase',$record->idfase)}}
    {{Form::formGroup([
        Html::col(
            Form::validate(
                Form::text('fsedescricao',$record->fsedescricao,['data-vindicate'=>'required|format:alpha']),
                Form::label('Fase','Fase')
            )
        ,'12')
      ])
    }}
@endsection
