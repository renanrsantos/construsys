@extends('layouts.modal')

@section('header')
    Funcionário
@endsection

@section('body')
{{
    Form::formGroup([
        Form::hidden('idfuncionario',$record->idfuncionario),
        Html::col(
            Form::validate(
                Form::inputConsulta('cadastros','pessoa',['value'=>$record->pessoa ? $record->pessoa->pesnome : '',
                    'value-id'=>$record->idpessoa,'data-vindicate'=>'required'])
            )
        ,'12')
    ])
}}
{{
    Form::formGroup([
        Html::col(
            Form::validate(
                Form::inputConsulta('rh','cargo',[
                    'value-id'=>$record->idcargo,
                    'value'=>$record->cargo ? $record->cargo->carnome : '',
                    'data-vindicate'=>'required'
                ])
            )
        ,'4'),
        Html::col(
            Form::validate(
                Form::date('fundataadmissao',$record->fundataadmissao,['data-vindicate'=>'required|format:date']),
                Form::label('fundataadmissao','Data admissão')
            )
        ,'4'),
        Html::col(
            Form::validate(
                Form::text('funsalariobase',$record->funsalariobase,['data-vindicate'=>'required|format:decimal|minVal:0']),
                Form::label('funsalariobase','Salário Base')
            )    
        ,'4')
    ])
}}
@endsection