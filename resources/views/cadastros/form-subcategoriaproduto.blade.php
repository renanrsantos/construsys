@extends('layouts.modal')

@section('header')
    Sub Categoria
@endsection
@section('body')
    {{Form::hidden('idsubcategoriaproduto',$record->idsubcategoriaproduto)}}
    {{Form::formGroup([
    	Html::col(
    		Form::validate(
    			Form::text('sbcdescricao',$record->catdescricao,['data-vindicate'=>'required']),
    			Form::label('sbcdescricao','Descrição')
    		)
    	,'12')
      ])
    }}
@endsection
