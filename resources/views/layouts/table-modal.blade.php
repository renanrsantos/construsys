@extends('layouts.modal')

@section('header')
	{{$titulo}}
@endsection
@section('body')
    {{Html::tag('div',$headerPai)}}
    @include('layouts.table')
@endsection

@section('footer')

@overwrite