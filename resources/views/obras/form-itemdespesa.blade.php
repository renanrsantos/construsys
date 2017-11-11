@extends('layouts.modal')

@section('header')
Item Despesa
@endsection
@section('body')
{{Form::hidden('iddespesaobra',$despesa->iddespesaobra)}}
{{Form::hidden('iditemdespesa',$record->iditemdespesa)}}
{{Form::formGroup([
    Html::col(
        Form::validate(
            Form::inputConsulta('cadastros','produto',
            ['value-id'=>$record->idproduto,
             'value'=> $record->produto ? $record->produto->prddescricao : '',
             'data-vindicate'=>'required',
             'data-main'=>'form'
            ],['props'=>'idproduto,prddescricao,unmsigla,prdvalorunitario',
               'propsAlt'=>'idproduto,prddescricao,unmsigla,itdvalorunitario'])
        )
    ,'12')
])}}
{{Form::formGroup([
    Html::col(
        Form::validate(
            Form::text('itdquantidade',$record->itdquantidade,['data-vindicate'=>'required|format:decimal']),
            Form::label('itdquantidade','Quantidade')
        )
    ,'6'),
    Html::col(
        Form::validate(
            Form::text('itdvalorunitario',$record->itdvalorunitario,['data-vindicate'=>'required|format:decimal']),
            Form::label('itdvalorunitario','Valor Unitário')
        )
    ,'6')
    
])}}
{{Form::formGroup([
    Html::col(
        Form::validate(
            Form::textarea('itdcomplemento',$record->itdcomplemento,['rows'=>3]),
            Form::label('itdcomplemento','Complemento')
        )
    ,'12')
])}}
@endsection