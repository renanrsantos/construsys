@php
    $table = Request::segment(3).'-'.Request::segment(5);
@endphp

@extends('layouts.app')

@section('content')
    <p>{{$titulo}}</p>
    @include('layouts.table')
@overwrite


