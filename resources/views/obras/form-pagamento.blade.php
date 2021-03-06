@extends('layouts.modal')

@section('header')
    Pagamento
@endsection
@section('body')
    @php
        $obra = $obra ? $obra : $record->obra;
    @endphp
    {{
        Form::formGroup([
            Form::hidden('idpagamento',$record->idpagamento),
            Form::hidden('idobra',$obra->idobra),
            Html::col(
                Form::validate(
                    Form::text('pagobs',$record->pagobs),
                    Form::label('pagobs','Observação')
                )
            ,'6'),
            Html::col(
                Form::validate(
                    Form::date('pagdata',$record->pagdata,['data-vindicate'=>'required|format:date']),
                    Form::label('pagdata','Data')
                )
            ,'3'),
            Html::col(
                Form::validate(
                    Form::text('pagvalor',$record->pagvalor,['data-vindicate'=>'required|format:decimal']),
                    Form::label('pagvalor','Valor')
                )
            ,'3')
        ])
    }}
@endsection
