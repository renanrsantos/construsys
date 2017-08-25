@extends('layouts.modal')

@section('header')
    Categoria
@endsection
@section('body')
    {{Form::hidden('idcategoriaproduto',$record->idcategoriaproduto)}}
    {{Form::formGroup([
        Form::text('catdescricao',$record->catdescricao,['label'=>'Descrição','required'])
      ])
    }}
@endsection
