@extends('layouts.modal')

@section('header')
    Módulo
@endsection
@section('body')
    {{Form::hidden('idmodulo',$record->idmodulo)}}
    {{Form::formGroup([
        Html::col(
            Form::validate(Form::text('modnome',$record->modnome,["data-vindicate"=>"required|format:alpha"]),
                Form::label('modnome','Nome'))
        ,'5'),
        Html::col(
            Form::validate(Form::text('modpath',$record->modpath,["data-vindicate"=>"required"]),
                Form::label('modpath','Caminho Execução'))
        ,'4'),    
        Html::col(
            Form::label('modicone','Ícone') . Form::text('modicone',$record->modicone)
        ,'3')
      ])
    }}
@endsection
