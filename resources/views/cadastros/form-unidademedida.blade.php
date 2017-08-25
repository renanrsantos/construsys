@extends('layouts.modal')

@section('header')
    Unidade de Medida
@endsection
@section('body')
    {{Form::hidden('idunidademedida',$record->idunidademedida,['label'=>'Código','required','readonly'])}}
    {{Form::formGroup([
        Form::text('unmsigla',$record->unmsigla,['label'=>'Sigla','required'])
      ])
    }}
    {{Form::formGroup([
        Form::text('unmdescricao',$record->unmdescricao,['label'=>'Descrição','required'])
      ])
    }}
@endsection
