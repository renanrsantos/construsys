@extends('layouts.modal')

@section('header')
    Pessoa
@endsection
@section('body')
	@php
            if(!$record instanceof App\Http\Models\Cadastros\Pessoa){
                $record = $record->pessoa;
                echo '<script>alert("a")</script>';
            }
		
            $tiposPessoa = $record->tiposPessoa();
	@endphp
	@include('cadastros.form-pessoa-pattern',compact('tiposPessoa','record'))
@endsection