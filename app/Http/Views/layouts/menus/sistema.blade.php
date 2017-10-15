<!DOCTYPE html>
@extends('layouts.menus.menu')

@section('menu')
<ul class="nav navbar-nav">
    @if(isset($sistemasEntidade))
    @foreach ($sistemasEntidade as $sistemaEntidade)
        <?php $sistema = $sistemaEntidade->sistema();?>
        <li class="dropdown">
            <a class="dropdown-toggle" 
               data-toggle="dropdown" role="button" aria-haspopup="true" 
               aria-expanded="false"><i class="{{$sistema->sisicone}}">&nbsp;</i> {{$sistema->sisnome}}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                @foreach ($sistema->rotinas() as $rotina)
                    <li>
                        <a href="{{url('/sistema'.$sistema->sispath.'/rotina'.$rotina->rotpath)}}">
                            <i class="{{$rotina->roticone}}">&nbsp;</i>{{$rotina->rotnome}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
    @endif
</ul>
@endsection