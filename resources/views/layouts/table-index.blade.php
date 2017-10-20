@php
    $table = Request::segment(3).'-'.Request::segment(5);
@endphp

@extends('layouts.app')

@section('content')
    <ol class="breadcrumb bg-light">
        <li class="breadcrumb-item"><a href="{{url($entidadeSelecionada->identidade.'/modulo'.$moduloSelecionado->modpath)}}">{{$moduloSelecionado->modnome}}</a></li>
        @if($rotina)
            @if($subrotina)
                @if($rotina->rotpath)
                    <li class="breadcrumb-item"><a href="{{url($entidadeSelecionada->identidade.'/modulo'.$moduloSelecionado->modpath.'/rotina'.$rotina->rotpath)}}">{{$rotina->rotnome}}</a></li>
                @else
                    <span class="breadcrumb-item active">{{$rotina->rotnome}}</span>
                @endif
                <span class="breadcrumb-item active">{{$subrotina->sbrnome}}</span>
            @else
                <span class="breadcrumb-item active">{{$rotina->rotnome}}</span>
            @endif
        @endif
    </ol>
    @include('layouts.table')
@overwrite


