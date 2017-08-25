<!DOCTYPE html>
<html>
    <head>
        <title>{{config('app.cliente')}}</title>
        
        @include('layouts.assets')
        <?php $auth = Auth::check();?>
    </head>
    <body>
        @section('main-menu')
            @if ($auth)
                @include('layouts.menus.menu-sistema')
            @endif
        @show
        <div class="container" style="margin-top: 60px;">
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
