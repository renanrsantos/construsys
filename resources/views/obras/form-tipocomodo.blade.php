@extends('layouts.modal')

@section('header')
    Tipos de Cômodos
@endsection
@section('body')
    {{Form::hidden('idtipocomodo',$record->idtipocomodo)}}
    {{Form::formGroup([
        Html::col(
            Form::validate(
                Form::text('tconome',$record->tconome,['data-vindicate'=>'required|format:alpha']),
                Form::label('tconome','Tipo')
            )
        ,'12')
      ])
    }}
@endsection
