@extends('layouts.modal')

@section('header')
Módulo x Empresa
@endsection

@section('body')
    {{Form::hidden('idmoduloinstalado',$record->idmoduloinstalado,['required','readonly','label'=>'Id'])}}
    {{Form::formGroup([
        Form::text('identidade',$entidadeSelecionada->identidade,['required','readonly','label'=>'Empresa','size'=>'sm']),
        Form::text('pesnome',$entidadeSelecionada->pessoa->pesnome,['required','readonly','label'=>''])        
    ])}}
    {{Form::formGroup([
            Form::inputConsulta('estrutura','modulo',[$acao!='Inserir'?'readonly':null,
                'value-id'=>$record->modulo ? $record->modulo->idmodulo : '',
                'value'=>$record->modulo ? $record->modulo->modnome : ''])
        ])
    }}
    {{Form::hidden('mdiativo',$record->mdiativo)}}
@endsection