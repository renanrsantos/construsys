@extends('layouts.modal')

@section('header')
Sub Rotina
@endsection

@section('body')
    {{Form::hidden('idsubrotina',$record->idsubrotina)}}
    {{Form::formGroup([
        Html::col(
            Form::inputConsulta('estrutura','rotina',['data-vindicate'=>'required',
                'value-id'=>$record->rotina ? $record->rotina->idrotina : '',
                'value'=>$record->rotina ? $record->rotina->rotnome : ''])
        ,'12')    
    ])}}
    {{Form::formGroup([
        Html::col(
            Form::validate(    
                Form::text('sbrnome',$record->sbrnome,['data-vindicate'=>'required|format:alpha']),
                Form::label('sbrnome','Subrotina') 
            )
        ,'4'),
        Html::col(        
            Form::validate(    
                Form::text('sbrpath',$record->sbrpath,['data-vindicate'=>'required']),
                Form::label('sbrpath','Caminho Execução')
            )
        ,'5'),
        Html::col(
            Form::validate(    
                Form::text('sbricone',$record->sbricone),
                Form::label('sbricone','Ícone')
            )
        ,'3')
    ])}}
@endsection