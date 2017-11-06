@extends('layouts.modal')

@section('header')
    Funcionário
@endsection
@section('body')
{{Form::formGroup([
    Form::hidden('idfuncionarioobra',$record->idfuncionarioobra),
    Form::hidden('idobra',$obra->idobra),
    Html::col(
        Form::validate(
            Form::inputConsulta('rh','funcionario',['value'=>$record->funcionario ? $record->funcionario->pessoa->pesnome : '',
                'value-id'=>$record ? $record->idfuncionario : '','data-vindicate'=>'required',
                'data-main'=>'form'],['props'=>'idfuncionario,pesnome,idcargo,carnome'])
        )
    ,'12')
])
}}
{{
    Form::formGroup([
        Html::col(
            Form::validate(
                Form::select('idfaseobra',$obra->fasesObraAsArray(),$record->idfaseobra),
                Form::label('idfaseobra','Fase da Obra')
            )
        ,'6'),
        Html::col(
            Form::validate(
                Form::inputConsulta('rh','cargo',['value-id'=>$record->funcionario ? $record->funcionario->idcargo : '',
                    'value'=>$record->funcionario ? $record->funcionario->cargo->carnome : '','data-vindicate'=>'required'])
            )
        ,'6')
    ])
}}
{{
    Form::formGroup([
        Html::col(
            Form::validate(
                Form::textarea('fuoobs',$record->fuoobs,['rows'=>'4']),
                Form::label('fuoobs','Observação')
            )
        ,'12')
    ])
}}
@endsection