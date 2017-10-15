<!DOCTYPE html>
<?php
    $usuario = Auth::user()->pessoa()->pesnome;
    if(strpos($usuario,' ') > 0){
        $length = strpos($usuario,' ');
    } else {
        $length = strlen($usuario);
    }
    $usuario = substr($usuario, 0, $length).' ['.Auth::user()->usulogin.']';
?>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" 
           data-toggle="dropdown" role="button" aria-haspopup="true" 
           aria-expanded="false"><i class="fa fa-user"></i> {{$usuario}}
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{url('/preferences')}}"><i class="fa fa-cogs"></i> Preferências</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{url('/logout')}}"><i class="fa fa-sign-out"></i> Sair</a></li>
        </ul>
    </li>
</ul>