@php
    $table = Request::segment(3) . '-' . Request::segment(5);
@endphp
<div class="modal-content" id="content-{{$table}}">
    <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">{{$acao}} @yield('header')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&nbsp;&times;&nbsp;</span></button>
    </div>
    <div class="modal-body">
        <div id="msg-fr-modal"></div>
        @section('modal-size')
            <div id="modal-size" class="sr-only">{{isset($modalSize) ? $modalSize : 'modal-xl'}}</div>
        @show
        @yield('body')
    </div>
    <div class="modal-footer">
        @yield('footer')
    </div>   
</div>
@section('scripts')
    @include('scripts.modal',['content'=>'#content-'.$table])
@show
