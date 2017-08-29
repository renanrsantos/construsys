@extends('layouts.modal',['size'=>'modal-lg'])

@section('header')
    Obra
@endsection
@section('body')
    {{Form::hidden('idobra',$record->idobra)}}
@endsection
