@php
    $table = Request::segment(3).'-'.Request::segment(5);
@endphp

@extends('layouts.app')

@section('content')
    @include('layouts.table')
@overwrite


