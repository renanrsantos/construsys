@extends('layouts.modal',['size'=>'modal-lg'])

@section('header')
    Obra
@endsection
@section('body')
    {{Html::navTabs([
      [
        'link'=>'obra',
        'label'=>'Obra',
        'tab'=>  
          Form::hidden('idobra',$record->idobra) .
          Form::formGroup([
            Html::col(
              Form::validate(
                Form::inputConsulta('cadastros','cliente',['value-id'=>$record->idcliente,
                  'value'=>$record->cliente ? $record->cliente->pessoa->pesnome : '','data-vindicate'=>'required'])
              )
            ,'8'),
            Html::col(
              Form::validate(
                Form::select('obrtipo',$record->getTiposObra(),$record->obrtipo,['data-vindicate'=>'required'],[''=>['disabled','selected']]),
                Form::label('obrtipo','Tipo da Obra')
              )
            ,'2'),
            Html::col(
              Form::validate(
                Form::date('obrdatainicio',$record->obrdatainicio,['data-vindicate'=>'required|format:date']),
                Form::label('obrdatainicio','Data Início')
              )
            ,'2')
          ]) .
          Form::formGroup([
            Html::col(
              Form::validate(
                Form::textarea('obrdescricao',$record->obrdescricao,['rows'=>3,'data-vindicate'=>'required']),
                Form::label('obdescricao','Descrição')
              )
            ,'12')
          ]) .
          Form::formGroup([
            Html::col(
              Form::validate(
                Form::text('obrvalororcado',$record->obrvalororcado,['data-vindicate'=>'required|format:decimal']),
                Form::label('obrvalororcado','Valor Orçado (R$)')
              )
            ,'3'),
            Html::col(
              Form::validate(
                Form::text('obrprevisao',$record->obrprevisao,['data-vindicate'=>'required|format:numeric']),
                Form::label('obrprevisao','Prev. de Entrega')
              ) 
            ,'3'),
            Html::col(
              Form::validate(
                Form::select('obrtipoprevisao',$record->getTiposPrevisao(),$record->obrtipoprevisao,['data-vindicate'=>'required'],[''=>['selected','disabled']]),
                Form::label('obrtipoprevisao','Tipo da Previsão')
              )  
            ,'3'),
            Html::col(
              Form::validate(
                Form::text('obrtamanho',$record->obrtamanho,['data-vindicate'=>'required|format:decimal']),
                Form::label('obrtamanho','Tamanho total (m²)')
              )
            ,'3')
          ])
        ],
        [
          'link'=>'fases',
          'label'=>'Fases da Obra',
          'tab'=>View::make('obras.form-faseobra',['record'=>$record])->render()
        ],
        [
          'link'=>'comodos',
          'label'=>'Divisões da Obra',
          'tab'=> View::make('obras.form-comodo',['record'=>$record])->render()
        ]
      ])   
    }}
@include('scripts.obras.obra')
@endsection
