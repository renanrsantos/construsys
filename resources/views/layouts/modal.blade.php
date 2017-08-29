<?php
    $disableAll = ($acao == 'Visualizar');
    $table = Request::segment(3).'-'.Request::segment(5);
    if(!isset($size)){
        $size = "";
    }
?>
<div class="modal-dialog {{$size}}" role="document">
    <div class="modal-content">
        {{Form::open(['url'=>Request::url(),'class'=>'form-horizontal','id'=>'fr-'.$table])}}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&nbsp;&times;&nbsp;</span></button>
            <button type="button" class="close modalMinimize" aria-label="Minimizar"><span aria-hidden="true">&nbsp;&minus;&nbsp;</span></button>
            <h4 class="modal-title" id="myModalLabel">{{$acao}} @yield('header')</h4>
        </div>
        <div class="modal-body">
            <div id="msg-fr-modal"></div>
            <div class="{{$disableAll ? 'disable-all' : 'enable-all'}}">
                @yield('body')
            </div>
        </div>
        <div class="modal-footer">
            <div class="{{$disableAll ? 'disable-all' : 'enable-all'}}">
                @include('layouts.buttons-form')
            </div>
        </div>
    </div>
    {{Form::close()}}
</div>