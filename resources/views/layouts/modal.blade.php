<?php
    $disableAll = !isset($disableAll) ? ($acao == 'Visualizar') : $disableAll;
    $table = Request::segment(3) . '-' . Request::segment(5);
?>
<div class="modal-content" id="content-{{$table}}">
    {{Form::open(['url'=>isset($urlAlt) ? $urlAlt : Request::url(),'class'=>'form-horizontal','id'=>'fr-'.$table],true)}}
    <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">{{$acao}} @yield('header')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&nbsp;&times;&nbsp;</span></button>
    </div>
    <div class="modal-body">
        <div id="msg-fr-modal"></div>
        @section('modal-size')
            <div id="modal-size" class="sr-only">{{isset($modalSize) ? $modalSize : 'modal-xl'}}</div>
        @show
        <div class="{{$disableAll ? 'disable-all' : 'enable-all'}}">
            @yield('body')
        </div>
    </div>
    <div class="modal-footer">
        @section('footer')
        <div class="{{$disableAll ? 'disable-all' : 'enable-all'}}">
            @include('layouts.buttons-form',['table'=>'fr-'.$table])
        </div>
        @show
    </div>
</div>
{{Form::close()}}

@section('scripts')
    @include('scripts.modal',['content'=>'#content-'.$table])
@show
