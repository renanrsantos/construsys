<?php
    $valida = Request::segment(1) && Auth::check();
    if($valida){
        $dropDownEntidades = [];
        foreach($entidades as $entidade){
            $dropDownEntidades[] = Html::dropDownItem(url($entidade->identidade.'/home'),$entidade->pessoa->pesnome);
        }
        if(count($dropDownEntidades) == 0){
            $attributes = ['disabled'=>true];
        } else {
            $attributes = [];
        }
    }

?>
@if($valida)
    {{
        Html::navBarBottom('navbar-footer','',
            [Html::nav([
                Html::navItemDropDown($entidadeSelecionada->pessoa->pesnome,
                    $dropDownEntidades,
                    true,$attributes)
            ])]
        )
    }}
@endif
