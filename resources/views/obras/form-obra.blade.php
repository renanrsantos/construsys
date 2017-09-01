@extends('layouts.modal',['size'=>'modal-lg'])

@section('header')
    Obra
@endsection
@section('body')
    {{Form::hidden('idobra',$record->idobra)}}
    {{Form::formGroup([
        Form::inputConsulta('cadastros','cliente',['value-id'=>$record->idcliente,
          'value'=>$record->pessoa ? $record->pessoa->pesnome : ''])
      ])
    }}
    {{Form::formGroup([
        Form::textarea('obrdescricao',$record->obrdescricao,['label'=>'Descrição'])
      ])
    }}
    {{Form::formGroup([
        Form::text('obrvalororcado',$record->obrvalororcado,['label'=>'Valor Orçado'])
      ])
    }}
    {{Form::formGroup([
        Form::date('obrdatainicio',$record->obrdatainicio,['label'=>'Data Início'])
      ])  
    }}
    {{Form::formGroup([
        Form::text('obrprevisao',$record->obrprevisao,['label'=>'Previsão Entrega']),
        Form::select('obrtipoprevisao',$record->getTiposPrevisao(),$record->obrtipoprevisao)
      ])  
    }}
    {{Form::formGroup([
        Form::text('obrtamanho',$record->obrtamanho,['label'=>'Tamanho total'])
      ])
    }}
    
    
    
    
@endsection
