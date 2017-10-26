<!DOCTYPE html>
<html>
    <head>
        <title>{{config('app.cliente')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('layouts.assets')
        <?php $auth = Auth::check();?>
    </head>
    <body>
        @section('main-menu')
            @if ($auth)
                @include('layouts.menus.menu-sistema')
            @endif
        @show
        @if((isset($rotina) && $rotina->rotpath) || isset($subrotina))
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
        @endif
        <div class="container-fluid">
            {{Html::listGroup($errors->all(),'danger')}}
            @if (!$auth && Request::url() != 'login')
                @include('layouts.form-login')
            @else
                @yield('content')
            @endif
        </div>
        @if($auth)
            @include('layouts.footer')
        @endif
    </body>
</html>
