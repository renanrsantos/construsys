@extends('layouts.modal')

@section('header')
	{{$titulo}}
@endsection
@section('body')
    {{Html::tag('div',$headerPai)}}
    @section('modal-size')
        <div id="modal-size" class="sr-only">modal-xl</div>
    @overwrite
    @include('layouts.table')
@endsection

@section('footer')

@overwrite

@if(isset($consulta))
    @section('scripts')
    @overwrite
@endif