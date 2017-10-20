@extends('layouts.modal')

@section('header')
    Cronograma
@endsection

@section('body')
<div class='gantt' url="{{$url}}" id='cronograma'>
    
</div>
<script>
    var url = $('#cronograma').attr('url');
    $(".gantt").gantt({
        source: url,
        scale: "days",
        navigate: "scroll",
        dow: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
        months: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        waitText: "<i class='fa fa-circle-o-notch fa-spin fa-fw'></i> Carregando",                
    });
</script>
@endsection

@section('footer')
@endsection