@extends('layouts.modal')

@section('header')
    Tipos de Cômodos
@endsection
@section('body')
    {{Form::hidden('idtipocomodo',$record->idtipocomodo,['label'=>'Código','required','readonly'])}}
    {{Form::formGroup([
        Form::text('tconome',$record->tconome,['label'=>'Tipo','required'])
      ])
    }}
@endsection
