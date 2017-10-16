@extends('layouts.modal')

@section('header')
    Pessoa
@endsection
@section('body')
	@php
            if(!$record instanceof App\Http\Models\Cadastros\Pessoa){
                $record = $record->pessoa;
            }
		
            $tiposPessoa = $record->tiposPessoa();
	@endphp
	@include('cadastros.form-pessoa-pattern',compact('tiposPessoa','record'))
@endsection

@section('scripts')
	@parent
	<script type="text/javascript"> formataCampoCpfCnpj($('[name="pestipo"]'));</script>
@endsection