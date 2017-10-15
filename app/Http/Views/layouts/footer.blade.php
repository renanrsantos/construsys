<nav class="navbar navbar-default info navbar-fixed-bottom">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a class="navbar-brand">Entidade</a></li>
            <li class="dropdown dropup">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{config('app.cliente')}} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('config/entidade/2')}}">Filial 1 - Demonstração</a></li>
                </ul>
            </li>
            <li><a class="navbar-brand">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</a></li>
            <li><a class="navbar-brand">Ano</a></li>
            <li class="dropdown dropup">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">2017 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('config/ano/2016')}}">2016</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>