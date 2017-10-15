@extends('layouts.menus.menu')

@section('menu')
<ul class="nav navbar-nav navbar-right">
    @if (Auth::check())
        <li class="links"><a href="{{url('/home')}}"><i class="fa fa-desktop">&nbsp;</i>Sistema</a></li>
    @else
        <li class="links"><a href="{{url('/login')}}"><i class="fa fa-sign-in">&nbsp;</i>Login</a></li>
    @endif
</ul>
@endsection