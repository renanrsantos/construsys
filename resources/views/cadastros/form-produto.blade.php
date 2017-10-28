@extends('layouts.modal')

@section('header')
	Produto
@endsection

@section('body')
{{Form::hidden('idproduto',$record->idproduto)}}
{{
    Form::formGroup([
        Html::col(
            Form::validate(
                Form::inputConsulta('cadastros','categoriaproduto',
                    ['value-id'=>$record->idcategoriaproduto,
                     'value'=>$record->categoria ? $record->categoria->catdescricao : '',
                     'data-vindicate'=>'required'])
            )
        ,'6'),
        Html::col(
            Form::validate(
                Form::inputConsulta('cadastros','subcategoriaproduto',
                    ['value-id'=>$record->idsubcategoriaproduto,
                     'value'=>$record->subcategoria ? $record->subcategoria->sbcdescricao : ''])
            )
        ,'6')
        
    ])
}}
{{
    Form::formGroup([
        Html::col(
            Form::validate(
                Form::text('prddescricao',$record->prddescricao,['data-vindicate'=>'required']),
                Form::label('prddescricao','Descrição')
            )
        ,'12')
    ])
}}
{{
    Form::formGroup([
        Html::col(
            Form::validate(
                Form::textarea('prddescdet',$record->prddescdet,['rows'=>3]),
                Form::label('prddescdet','Descrição Detalhada')
            )
        ,'12')
    ])
}}
{{
    Form::formGroup([
        Html::col(
            Form::validate(
                Form::inputConsulta('cadastros','unidademedida',
                    ['value-id'=>$record->idunidademedida,
                     'value'=>$record->unidadeMedida ? $record->unidadeMedida->unmdescricao : ''])
            )
        ,'5'),
        Html::col(
            Form::validate(
                Form::text('prdcodigobarras',$record->prdcodigobarras),
                Form::label('prdcodigobarras','Código de Barras')
            )
        ,'4'),
        Html::col(
            Form::validate(
                Form::text('prdvalorunitario',$record->prdvalorunitario,['data-vindicate'=>'required|format:decimal']),
                Form::label('prdvalorunitario','Valor Unitário')
            )
        ,'3')
    ])
}}
@endsection
