@extends('layouts.modal')

@section('header')
Módulo x Empresa
@endsection

@section('body')
    {{Form::hidden('idmoduloinstalado',$record->idmoduloinstalado)}}
    {{Form::formGroup([
        Html::col(
            Form::label('identidade','Cod. Empresa').
            Form::text('identidade',$entidadeSelecionada->identidade,['readonly'])
        ,'3'),
        Html::col(
            Form::label('pesnome','Empresa') .
            Form::text('pesnome',$entidadeSelecionada->pessoa->pesnome,['readonly'])
        ,'9')
    ])}}
    {{Form::formGroup([
        Html::col(
            Form::inputConsulta('estrutura','modulo',['data-vindicate'=>'required|format:numeric',
                'value-id'=>$record->modulo ? $record->modulo->idmodulo : '',
                'value'=>$record->modulo ? $record->modulo->modnome : ''],true)
        ,'8'),
        Html::col('<br/>'.Form::checkbox('mdiativo',$record->mdiativo,$record->mdiativo,['label'=>'Módulo Ativo']),'4')
      ])
    }}
@endsection