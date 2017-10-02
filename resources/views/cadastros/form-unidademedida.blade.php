@extends('layouts.modal')

@section('header')
    Unidade de Medida
@endsection
@section('body')
    {{Form::hidden('idunidademedida',$record->idunidademedida,['label'=>'Código','required','readonly'])}}
    {{Form::formGroup([
        Html::col(
            Form::validate(
                Form::text('unmsigla',$record->unmsigla,['data-vindicate'=>'required']),
                Form::label('unmsigla','Sigla')
            )
        ,'4'),
        Html::col(
            Form::validate(
                Form::text('unmdescricao',$record->unmdescricao,['data-vindicate'=>'required']),
                Form::label('unmdescricao','Descrição')
            )
        ,'8')
      ])
    }}
@endsection
