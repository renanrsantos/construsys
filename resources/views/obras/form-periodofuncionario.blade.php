@extends('layouts.modal')

@section('header')
    Período
@endsection

@section('body')
@php 
    $acaoAlt = isset($acaoAlt) ? $acaoAlt : 'novo';
    $dvDF = 'format:date';
    $valDI = $record->pefdatainicio;
    $valDF = $record->pefdatafim;
    $colDI = '12';
    $colDF = '12';
    if($acaoAlt === 'saida'){
        $dvDF = 'required|'.$dvDF;
        $valDF = date('Y-m-d');
        $colDI .= ' sr-only';
        $colDF = '12';
    } else if($acaoAlt === 'entrada'){
        $valDI = date('Y-m-d');
        $colDF .= ' sr-only'; 
        $colDI = '12';
    }
@endphp
{{
    Form::formGroup([
        Form::hidden('idperiodofuncionario',$record->idperiodofuncionario),
        Form::hidden('idfuncionarioobra',$funcionarioObra->idfuncionarioobra),
        Html::col(
            Form::validate(
                Form::date('pefdatainicio',$valDI,['data-vindicate'=>'required|format:date']),
                Form::label('pefdatainicio','Data início')
            )
        ,$colDI)
    ])
}}
{{
    Form::formGroup([  
        Html::col(
            Form::validate(
                Form::date('pefdatafim',$valDF,['data-vindicate'=>$dvDF]),
                Form::label('pefdatafim','Data fim')
            )
        ,$colDF)        
    ])
}}
@endsection