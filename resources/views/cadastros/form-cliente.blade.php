@extends('layouts.modal')

@section('header')
    Cliente
@endsection

@section('body')
    {{
        Form::formGroup([
            Html::col(
                Form::inputConsulta('cadastros','pessoa',
                 ['value-id'=>$record->idpessoa,
                  'value'=>$record->pessoa ? $record->pessoa>pesnome : ''])
            ,'12')
        ])
    }}
@endsection