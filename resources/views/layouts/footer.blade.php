<?php
$valida = Request::segment(1) && Auth::check();
if ($valida) {
    $disabled = '';
    if (count($entidades) == 0) {
        $disabled = ' disabled';
    }
}
?>
@if($valida)
<div class="fixed-bottom container-fluid bg-light">
    <div class="row">
        <div class="col-10 col-md-10 col-sm-8 col-xs-4">
            <div class="dropup">
                <button class="btn btn-light dropdown-toggle{{$disabled}}" type="button" id="dropdown-entidades" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$entidadeSelecionada->pessoa->pesnome}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdown-entidades">
                    @foreach($entidades as $entidade)
                        {{Html::dropDownItem(url($entidade->identidade . '/home'), $entidade->pessoa->pesnome)}}
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col col-sm-2 col-xs-3">
            {{Html::userMenu()}}
        </div>
    </div>
</div>
@endif
