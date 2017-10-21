@extends('layouts.modal')

@section('header')
    Cargo
@endsection

@section('body')
{{
    Form::formGroup([
        Form::hidden('idcargo',$record->idcargo),
        Html::col(
            Form::validate(
                Form::text('carnome',$record->carnome,['data-vindicate'=>'required']),
                Form::label('carnome','Cargo')
            )
        ,'12')
    ])
}}
@endsection