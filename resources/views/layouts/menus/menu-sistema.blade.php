<?php
    foreach ($modulosEntidade as $moduloEntidade){
        $modulo = $moduloEntidade->modulo;
        if(!in_array($modulo->idmodulo,[1])){
            $urlModulo = url($entidadeSelecionada->identidade.'/modulo'.$modulo->modpath);
            $tituloModulo = $modulo->modnome;
            $dropDownModulos[] = Html::dropDownItem($urlModulo,$tituloModulo,['icon'=>Html::icon($modulo->modicone)]);
        }
    }
    $dropDownModulos[] = Html::dropDownDivider();
    $dropDownModulos[] = Html::dropDownItem(url($entidadeSelecionada->identidade.'/modulo/estrutura'),'Estrutura',['icon'=>Html::icon('fa fa-cog')]);

    $brand = Html::navItemDropDown('Construsys',$dropDownModulos,false,[],true,true);
    $items = [];
    foreach($moduloSelecionado->rotinas as $rotina){
        $active = '/'.Request::segment(5) == $rotina->rotpath ? 'active': '';
        $url = url($entidadeSelecionada->identidade.'/modulo'.$moduloSelecionado->modpath.'/rotina'.$rotina->rotpath);
        $subrotinas = $rotina->subrotinas;
        if(!$subrotinas->isEmpty()){
            $aux = $rotina->rotpath != "";
            foreach($subrotinas as $subrotina){
                if(!$active){
                    $active = '/'.Request::segment(5) == $subrotina->sbrpath ? 'active': '';
                }
                $url = url($entidadeSelecionada->identidade.'/modulo'.$rotina->modulo->modpath.'/rotina'.$subrotina->sbrpath);
                $dropDownSubRotinas[] = Html::dropDownItem(url($url),$subrotina->sbrnome,['icon'=>Html::icon($subrotina->sbricone)]);
//                if($rotina->rotpath === $subrotina->sbrpath){
//                    $aux = false;
//                }
            }
            if($aux){
                $url = url($entidadeSelecionada->identidade.'/modulo'.$rotina->modulo->modpath.'/rotina'.$rotina->rotpath);
                $dropDownSubRotinas[] = Html::dropDownItem(url($url),$rotina->rotnome,['icon'=>Html::icon($rotina->roticone)]);
            }
            $items[] = Html::navItemDropDown(Html::icon($rotina->roticone).$rotina->rotnome,$dropDownSubRotinas,false,['class'=>$active]);
        } else {
            $items[] = Html::navItem($url,$rotina->rotnome,['icon'=>Html::icon($rotina->roticone),'class'=>$active]);
        }
    }
?>

{{
    Html::navBarTop('navbar-menu-sistema',$brand,[Html::nav($items),Html::userMenu()])

}}