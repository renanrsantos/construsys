<?php
    $sistema = Html::navItem(url($identidade.'/home'),'Sistema',['icon'=>Html::icon('fa fa-desktop')]);
    $login =  Html::navItem(url('/login'),'Login',['icon'=>Html::icon('fa fa-sign-in')]);
    if(Auth::check()){
        $list[] = $sistema;
    } else {
        $list[] = $login;
    }
    $list[] = Html::userMenu();
?>

    {{Html::navBar('navbar-menu-home','',[Html::nav($list,[],true)])}}
