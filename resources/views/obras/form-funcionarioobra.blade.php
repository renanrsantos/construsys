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
                'value-id'=>$record ? $record->idfuncionario : '','data-vindicate'=>'required'])
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
                Form::select('idcargo',App\Http\Models\RH\Cargo::getCargos(),$record->idcargo ? $record->idcargo : $record->funcionario ? $record->funcionario->idcargo : ''),
                Form::label('idcargo','Cargo')
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