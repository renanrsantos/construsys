{{
    Form::formGroup([
        Html::col(
            Form::validate(
                Form::input('text','dsovalortotal',$despesa->dsovalortotal,['disabled','data-vindicate'=>'format:decimal']),
                Form::label('dsovalortotal','Valor Total')
            )
        ,'3')
    ])
}}
@include('obras.form-itemdespesa-pattern',['item'=>null,'pattern'=>true])
@foreach($despesa->itens as $item)
    @include('obras.form-itemdespesa-pattern',['item'=>$item,'pattern'=>false])
@endforeach
@include('obras.form-itemdespesa-pattern',['item'=>null,'pattern'=>false])

@if($despesa->dsotipo ==2)
<script>calcValorTotal('[name="itdvalorunitario[]"]','[name="itdquantidade[]"]','[name="dsovalortotal"]');</script>
@endif
