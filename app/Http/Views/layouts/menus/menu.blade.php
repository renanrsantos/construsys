<!DOCTYPE html>
<div class="top-right">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="links navbar-brand">{{config('app.cliente')}}</a>
                </div>

                @if(Auth::check())
                    @include('layouts.menus.usuario')
                @endif
                @yield('menu')
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>