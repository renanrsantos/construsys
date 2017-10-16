@extends('layouts.modal')

@section('header')
	Produto
@endsection

@section('body')
	{{
		Form::hidden('idproduto',$record->idproduto)
	}}
	{{
		Form::formGroup([
			Html::col(
				''
			,'2')
		])
	}}
@endsection
