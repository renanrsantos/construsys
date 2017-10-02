@extends('layouts.modal')

@section('header')
    Categoria
@endsection
@section('body')
    {{Form::hidden('idcategoriaproduto',$record->idcategoriaproduto)}}
    {{Form::formGroup([
    	Html::col(
    		Form::validate(
    			Form::text('catdescricao',$record->catdescricao,['data-vindicate'=>'required']),
    			Form::label('catdescricao','Descrição')
    		)
    	,'12')
      ])
    }}
@endsection
