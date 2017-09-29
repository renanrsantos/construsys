<?php
    $disableAll = ($acao == 'Visualizar');
    $table = Request::segment(3).'-'.Request::segment(5);
    if(!isset($size)){
        $size = "modal-md";
    }
?>
<div class="modal-dialog {{$size}}">
    <div class="modal-content" role="document">
        {{Form::open(['url'=>Request::url(),'class'=>'form-horizontal','id'=>'fr-'.$table])}}
        <div class="modal-header">
            <h5 class="modal-title" id="modal-label">{{$acao}} @yield('header')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
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

@include('layouts.modal-script')